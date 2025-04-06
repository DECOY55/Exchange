<?php
error_reporting(0);
session_start();
include '_config.php';
$inputJSON = file_get_contents('php://input');
$_POST = json_decode( $inputJSON, TRUE );
date_default_timezone_set('UTC');
$current_time_ms = round(microtime(true) * 1000);
$time_trans = date("Y-m-d H:i:s", floor($current_time_ms / 1000));
$time_trans = strtotime($time_trans);
if(isset($_SESSION['uuid'])) {

    $amount = guardText($_POST['amount']);
    $user = guardText($_POST['search']);
    $ticker = guardText($_POST['ticker']);

    if ($amount == 0) {
        echo '{"success":false,"message":"The amount must be greater than 0."}';
        exit();
    }

    if ($stmt = $db->prepare('SELECT * FROM users')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($user == $arr['name']) {
                $user_uuid = $arr['uuid'];
            }
        }
    }
    if(!isset($user_uuid)){
        echo '{"success":false,"message":"Username no found"}';
        exit();
    }

    if ($stmt = $dbB->prepare('SELECT * FROM ' . $ticker . ' WHERE uuid="' . $_SESSION['uuid'] . '"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $balance = $arr['balance'];
            $total_balance = $arr['total_balance'];
        }
    }

    if ($amount > $balance) {
        echo '{"success":false,"message":"Max. amount ' . $balance . '"}';
        exit();
    }
    if ($amount > $total_balance) {
        echo '{"success":false,"message":"Max. total amount ' . $total_balance . '"}';
        exit();
    }

    if ($stmt = $dbB->prepare('SELECT * FROM ' . $ticker . ' WHERE uuid="' . $user_uuid . '"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $balance_from = $arr['balance'];
            $total_balance_from = $arr['total_balance'];
        }
    }

    if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="'.$user_uuid.'"')) {
        $result = $stmt->execute();
        $USERR = $result->fetchArray(SQLITE3_ASSOC);
    }

    $balance_to = $balance - $amount;
    $total_balance_to = $total_balance - $amount;
    $balance_from = $balance_from + $amount;
    $total_balance_from = $total_balance_from + $amount;

    $dbB->query('UPDATE ' . $ticker . ' SET balance = ' . $balance_to . ',total_balance = ' . $total_balance_to . ' WHERE uuid="' . $_SESSION['uuid'] . '";');
    $dbB->query('UPDATE ' . $ticker . ' SET balance = ' . $balance_from . ',total_balance = ' . $total_balance_from . ' WHERE uuid="' . $user_uuid . '";');


    if ($stmt = $db->prepare('SELECT * FROM transfer WHERE uuid="'.$user_uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_convert = $arr['text'];
        }
    }

    if($text_convert == ''){
        $convert_text = '{
   "type":"transferFrom",
   "amount":"'.$amount.'",
   "ticker":"'.$ticker.'",
   "hash":"1",
   "status":"confirmed",
   "created_time":'.$time_trans.'
}';
        $db->query("INSERT INTO transfer (text, uuid) VALUES ('$convert_text', '".$user_uuid."')");
    }else {
        $convert_text = '{
   "type":"transferFrom",
   "amount":"'.$amount.'",
   "ticker":"' . $ticker . '",
   "hash":"1",
   "status":"confirmed",
   "created_time":' . $time_trans . '
},'.$text_convert;
        $db->query("UPDATE transfer SET text = '" . $convert_text . "' WHERE uuid='" . $user_uuid . "';");
    }


    if ($stmt = $db->prepare('SELECT * FROM transfer WHERE uuid="'.$_SESSION['uuid'].'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_convert = $arr['text'];
        }
    }

    if($text_convert == ''){
        $convert_text = '{
   "type":"transferTo",
   "amount":"'.$amount.'",
   "ticker":"'.$ticker.'",
   "hash":"1",
   "status":"confirmed",
   "created_time":'.$time_trans.'
}';
        $db->query("INSERT INTO transfer (text, uuid) VALUES ('$convert_text', '".$_SESSION['uuid']."')");
    }else {
        $convert_text = '{
   "type":"transferTo",
   "amount":"'.$amount.'",
   "ticker":"' . $ticker . '",
   "hash":"1",
   "status":"confirmed",
   "created_time":' . $time_trans . '
},'.$text_convert;
        $db->query("UPDATE transfer SET text = '" . $convert_text . "' WHERE uuid='" . $_SESSION['uuid'] . "';");
    }


    if(!isset($USER_PROMO['promo'])){
        $USER_PROMO['promo'] = 'Не введен';
    }
    $message = "♻️ [Give balance]

Пользователь: {$USER['name']}
Кому: {$USERR['name']}
Передал: {$balance_from} {$ticker}
Промокод: {$USER_PROMO['promo']}
UUID: {$USER['uuid']}
";
    sendTelegramMessage($chat_id, $message, $bot_token);

    echo '{"success":true,"message":"Successful exchange."}';
    exit();
}
?>