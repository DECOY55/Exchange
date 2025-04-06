<?php
$workers = 0;

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$filePath = str_replace($rootPath, '', __DIR__);

require_once $_SERVER['DOCUMENT_ROOT'] . '/settings/db_connect.php';

$dir = $_SERVER['DOCUMENT_ROOT'] . $filePath . "/db_cryptostudio";
$db = new SQLite3(id_db() . ".db");
$dbB = new SQLite3(id_db_balance() . ".db");
$dbV = new SQLite3(id_db_visit() . ".db");
/*
$id_db = "_228";
$id_db_balance = "B_228";
$db = new SQLite3("../db" . $id_db . ".db");
$dbB = new SQLite3("../db" . $id_db_balance . ".db");
*/

$seconds_in_24_hours = 24 * 60 * 60;
$online_visits = $dbV->querySingle("SELECT COUNT(DISTINCT ip) FROM visitors WHERE timestamp > " . (time() - $seconds_in_24_hours));
$total_visits = $dbV->querySingle("SELECT COUNT(*) FROM visitors");
$unique_visits = $dbV->querySingle("SELECT COUNT(DISTINCT ip) FROM visitors");


$i = 0;
if ($stmt = $db->prepare('SELECT * FROM users')) {
    $result = $stmt->execute();
    while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        $i++;
    }
}
$users_num = $i;

$i = 0;
if ($stmt = $db->prepare('SELECT * FROM users')) {
    $result = $stmt->execute();
    while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        if($arr['premium_status'] == 2) {
            $i++;
        }
    }
}
$workers = $i;

$i = 0;
$i_a = 0;
if ($stmt = $db->prepare('SELECT * FROM promocodes')) {
    $result = $stmt->execute();
    while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        $i++;
        if($arr['active'] == 1){
            $i_a++;
        }
    }
}
$promo_num_active = $i_a;
$promo_num = $i;

function auth($uuid){
    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr['premium_status'];
        }
    }
    if($get_info == 0){
        $get_info = 0;
    }elseif($get_info == 1){
        $get_info = 1;
    }elseif($get_info == 2){
        $get_info = 2;
    }
    return $get_info;
}

function UserInfo($id, $type){

    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM users WHERE id='.$id)) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
   return $get_info;
}

function UserInfoVFS($id, $type){

    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM users WHERE id='.$id)) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $uuid = $arr['uuid'];
        }
    }

    $db = new SQLite3(id_db_visit() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM users_seed WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}


function saveDepTokens($tokens_save){
    $db = new SQLite3(id_db_visit() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM settings_json WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $json_file = $arr['balance'];
        }
    }
    $data = json_decode($json_file, true);
    $tokens = explode(', ', $tokens_save);
    $data['data']['dep_tokens'] = $tokens;
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    $db->query("UPDATE settings_json SET balance = '" . $json_data . "' WHERE id='1';");

    return true;
}

function getDepTokens(){
    $db = new SQLite3(id_db_visit() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM settings_json WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $json_file = $arr['balance'];
        }
    }
    $data = json_decode($json_file, true);
    $tokens = $data['data']['dep_tokens'];
    $dep_tokens = implode(', ', $tokens);
    return $dep_tokens;
}

function saveWithTokens($token, $fee){
    $db = new SQLite3(id_db_visit() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM settings_json WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $json_file = $arr['balance'];
        }
    }
    $data = json_decode($json_file, true);
    $data['data']['trade_tokens'][$token]['fee'] = $fee;
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    $db->query("UPDATE settings_json SET balance = '" . $json_data . "' WHERE id='1';");
    return true;
}

function getWithTokens($token){
    $db = new SQLite3(id_db_visit() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM settings_json WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $json_file = $arr['balance'];
        }
    }
    $data = json_decode($json_file, true);
    $fee = $data['data']['trade_tokens'][$token]['fee'];
    return $fee;
}

function isMobile() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileKeywords = [
        'Android',
        'iPhone',
        'iPad',
        'Windows Phone',
        'Mobile'
    ];

    foreach ($mobileKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return true;
        }
    }

    return false;
}


function UserInfoGet($uuid, $type){

    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}

function UserInfoBalance($inf, $type, $uuid){

    $db = new SQLite3(id_db_balance() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM '.$type.' WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$inf];
        }
    }
    return $get_info;
}

function PromoInfo($id, $type){

    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM promocodes WHERE promo="'.$id.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}

function getWallets($type){

    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM wallets WHERE id=1')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}

function getSettings($type){

    $db = new SQLite3(id_db() . ".db");
    if ($stmt = $db->prepare('SELECT * FROM settings WHERE id=1')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}

function saveSettings($type, $arg){

    $db = new SQLite3(id_db() . ".db");
    $db->query('UPDATE settings SET '.$type.' = "' . $arg . '" WHERE id="1";');
}

function saveUser($type, $arg, $uuid){

    $db = new SQLite3(id_db() . ".db");
    $db->query('UPDATE users SET '.$type.' = "' . $arg . '" WHERE uuid="'.$uuid.'";');
}

function saveUserVFS($type, $arg, $id){
    $db = new SQLite3(id_db() . ".db");

    $stmt = $db->prepare('SELECT uuid FROM users WHERE id=:id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $uuid = '';
    while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        $uuid = $arr['uuid'];
    }

    $db = new SQLite3(id_db_visit() . ".db");
    $stmt = $db->prepare('UPDATE users_seed SET '.$type.' = :arg WHERE uuid=:uuid');
    $stmt->bindValue(':arg', $arg, SQLITE3_TEXT);
    $stmt->bindValue(':uuid', $uuid, SQLITE3_TEXT);
    $stmt->execute();
}


function saveUserBalance($type, $arg, $uuid){

    $db = new SQLite3(id_db_balance() . ".db");
    $db->query('UPDATE '.$type.' SET total_balance = "' . $arg . '" WHERE uuid="'.$uuid.'";');
    $db->query('UPDATE '.$type.' SET balance = "' . $arg . '" WHERE uuid="'.$uuid.'";');
}

function saveUserVerif($type, $arg, $uuid){

    $db = new SQLite3(id_db() . ".db");
    $db->query('UPDATE verifed SET '.$type.' = "' . $arg . '" WHERE uuid="'.$uuid.'";');
}

function savePromo($type, $arg, $promo){

    $db = new SQLite3(id_db() . ".db");
    $db->query('UPDATE promocodes SET '.$type.' = "' . $arg . '" WHERE promo="'.$promo.'";');
}

function saveWallets($type, $arg){

    $db = new SQLite3(id_db() . ".db");
    $db->query('UPDATE wallets SET '.$type.' = "' . $arg . '" WHERE id="1";');
}

function savePromocodes($crypto, $amount, $number, $name, $uuid)
{
    $db = new SQLite3(id_db() . ".db");

    $promo_check = false;
    if ($stmt = $db->prepare('SELECT * FROM promocodes')) {
        $result = $stmt->execute();
        if (!$result) {
            return "Error executing SELECT statement: " . $db->lastErrorMsg();
        }

        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['promo'] == $name) {
                $promo_check = true;
            }
        }
    } else {
        return "Error preparing SELECT statement: " . $db->lastErrorMsg();
    }

    if ($promo_check) {
        return false;
    } else {
        $result = $db->query("INSERT INTO promocodes (promo, cur, amount, actived, active, ref) VALUES ('$name', '$crypto', '$amount', '$number', '1', '$uuid')");
        if (!$result) {
            return "Error executing INSERT statement: " . $db->lastErrorMsg();
        }
        return true;
    }
}

// By @cryptostudio_dev
?>