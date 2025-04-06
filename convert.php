<?php
error_reporting(0);
session_start();
include '_config.php';
$inputJSON = file_get_contents('php://input');
$_POST = json_decode( $inputJSON, TRUE );

header("Content-Type: application/json");
if(isset($_SESSION['uuid'])) {
    $amount = $_POST['amount'];
    $from = $_POST['from']; // отдаю
    $to = $_POST['to']; // получаю

    if($amount == 0){
        echo '{"success":false,"message":"The amount must be greater than 0."}';
        exit();
    }

    $stmt = $dbB->prepare('SELECT balance, total_balance FROM ' . $to . ' WHERE uuid = :uuid');
    $stmt->bindParam(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
    $result = $stmt->execute();
    if($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        $balance_to = $arr['balance'];
        $balance_to_total = $arr['total_balance'];
    }

    $stmt = $dbB->prepare('SELECT balance, total_balance FROM ' . $from . ' WHERE uuid = :uuid');
    $stmt->bindParam(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
    $result = $stmt->execute();
    if($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        $balance_from = $arr['balance'];
        $balance_from_total = $arr['total_balance'];
    }

    if($amount > $balance_from){
        echo '{"success":false,"message":"Max. amount: '.$balance_from.'"}';
        exit();
    }
    if($amount > $balance_from_total){
        echo '{"success":false,"message":"Max. total amount: '.$balance_from_total.'"}';
        exit();
    }
    /*
    $convert = json_decode(file_get_contents("https://min-api.cryptocompare.com/data/pricemulti?fsyms=".$from."&tsyms=".$to), true);
    $convert_good = $convert[$from][$to];
    $convert_get = $convert_good * $amount;
    */
    $convert_get = $_POST['to_amount'];

    $dbB->query('UPDATE ' . $from . ' SET balance = balance - ' . $amount . ', total_balance = total_balance - ' . $amount . ' WHERE uuid="' . $_SESSION['uuid'] . '";');
    $dbB->query('UPDATE ' . $to . ' SET balance = balance + ' . $convert_get . ', total_balance = total_balance + ' . $convert_get. ' WHERE uuid="' . $_SESSION['uuid'] . '";');
    if ($stmt = $db->prepare('SELECT * FROM convert WHERE uuid="'.$_SESSION['uuid'].'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_convert = $arr['text'];
        }
    }

    if($text_convert == ''){
        $convert_text = '{
         "from":"'.$from.'",
         "to":"'.$to.'",
         "amount":"'.$amount.'",
         "result":"'.$convert_get.'",
         "created_time":'.time().'
      }';
    }else{
        $convert_text = $text_convert.',
        {
         "from":"'.$from.'",
         "to":"'.$to.'",
         "amount":"'.$amount.'",
         "result":"'.$convert_get.'",
         "created_time":'.time().'
        }';
    }

    $db->query("INSERT INTO convert (text, uuid) VALUES ('$convert_text', '".$_SESSION['uuid']."')");

    if(!isset($USER_PROMO['promo'])){
        $USER_PROMO['promo'] = 'Не введен';
    }
    $message = "♻️ [SWAP]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Отдал: {$amount} {$from} 
Получил: {$_POST['to_amount']} {$to} 

UUID: {$USER['uuid']}
";
   /*

balance: {$balance_to}
total : {$balance_to_total}

   */
    sendTelegramMessage($chat_id, $message, $bot_token);

    echo '{"success":true,"message":"The convert was successful."}';
    exit();
}
?>