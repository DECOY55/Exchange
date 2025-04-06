<?php
//error_reporting(0);
session_start();
include '_config.php';
$inputJSON = file_get_contents('php://input');
$_POST = json_decode( $inputJSON, TRUE );

if(isset($_SESSION['uuid'])) {
    $amount = guardText($_POST['amount']);
    $from = guardText($_POST['ticker']); // отдаю
    $days = guardText($_POST['days']); // получаю

    if($amount == 0){
        echo '{"success":false,"message":"The amount must be greater than 0."}';
        exit();
    }

    if ($stmt = $dbB->prepare('SELECT * FROM ' . $from . ' WHERE uuid="' . $_SESSION['uuid'] . '"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $balance_from = $arr['balance'];
            $balance_from_total = $arr['total_balance'];
        }
    }

    if($amount > $balance_from){
        echo '{"success":false,"message":"Max. amount: '.$balance_from.'"}';
        exit();
    }
    if($amount > $balance_from_total){
        echo '{"success":false,"message":"Max. total amount: '.$balance_from_total.'"}';
        exit();
    }

    $balance_from = $balance_from - $amount;
    $balance_from_total = $balance_from_total - $amount;

    $dbB->query('UPDATE ' . $from . ' SET balance = ' . $balance_from . ',total_balance = ' . $balance_from_total . ' WHERE uuid="' . $_SESSION['uuid'] . '";');

    if ($stmt = $db->prepare('SELECT * FROM stack WHERE uuid="'.$_SESSION['uuid'].'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_convert = $arr['text'];
        }
    }

    if($text_convert == ''){
        $convert_text = '{
            "ticker":"'.$from.'",
            "percent":5,
            "days":'.$days.',
            "amount":'.$amount.',
            "income":0,
            "created_time":'.time().'
      }';
    }else{
        $convert_text = $text_convert.',
        {
            "ticker":"'.$from.'",
            "percent":5,
            "days":'.$days.',
            "amount":'.$amount.',
            "income":0,
            "created_time":'.time().'
        }';
    }

    $db->query("INSERT INTO stack (text, uuid) VALUES ('$convert_text', '".$_SESSION['uuid']."')");


    if(!isset($USER_PROMO['promo'])){
        $USER_PROMO['promo'] = 'Не введен';
    }

    $message = "⏳ [STACK]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Сумма: {$amount} {$from}
Дни: {$days}

UUID: {$USER['uuid']}
";
    sendTelegramMessage($chat_id, $message, $bot_token);

    echo '{"success":true,"message":"The staking was successful."}';
    exit();
}
?>