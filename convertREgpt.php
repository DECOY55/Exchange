<?php
error_reporting(0);
session_start();
include '_config.php';

$inputJSON = file_get_contents('php://input');
$_POST = json_decode($inputJSON, TRUE);

header("Content-Type: application/json");

if (!isset($_SESSION['uuid']) || empty($_SESSION['uuid'])) {
    echo json_encode(array('success' => false, 'message' => 'Invalid session.'));
    exit();
}

$amount = $_POST['amount'];
$from = $_POST['from']; // отдаю
$to = $_POST['to']; // получаю

if ($amount == 0) {
    echo json_encode(array('success' => false, 'message' => 'The amount must be greater than 0.'));
    exit();
}

$stmt = $dbB->prepare('SELECT balance, total_balance FROM ' . $to . ' WHERE uuid = :uuid');
$stmt->bindParam(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
$result = $stmt->execute();
if ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
    $balance_to = $arr['balance'];
    $balance_to_total = $arr['total_balance'];
}

$stmt = $dbB->prepare('SELECT balance, total_balance FROM ' . $from . ' WHERE uuid = :uuid');
$stmt->bindParam(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
$result = $stmt->execute();
if ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
    $balance_from = $arr['balance'];
    $balance_from_total = $arr['total_balance'];
}

if ($amount > $balance_from) {
    echo json_encode(array('success' => false, 'message' => 'Max. amount: ' . $balance_from));
    exit();
}

if ($amount > $balance_from_total) {
    echo json_encode(array('success' => false, 'message' => 'Max. total amount: ' . $balance_from_total));
    exit();
}

$convert_get = $_POST['to_amount'];

$stmt = $dbB->prepare('UPDATE ' . $from . ' SET balance = balance - :amount, total_balance = total_balance - :amount WHERE uuid = :uuid');
$stmt->bindValue(':amount', $amount, SQLITE3_INTEGER);
$stmt->bindValue(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
$stmt->execute();

$stmt = $dbB->prepare('UPDATE ' . $to . ' SET balance = balance + :convert_get, total_balance = total_balance + :convert_get WHERE uuid = :uuid');
$stmt->bindValue(':convert_get', $convert_get, SQLITE3_INTEGER);
$stmt->bindValue(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
$stmt->execute();

$stmt = $db->prepare('SELECT * FROM convert WHERE uuid = :uuid');
$stmt->bindParam(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
$result = $stmt->execute();
$text_convert = '';
while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
    $text_convert = $arr['text'];
}

$convert_data = array(
    'from' => $from,
    'to' => $to,
    'amount' => $amount,
    'result' => $convert_get,
    'created_time' => time()
);

if ($text_convert == '') {
    $convert_text = json_encode($convert_data);
} else {
    $previous_converts = json_decode($text_convert, true);
    $previous_converts[] = $convert_data;
    $convert_text = json_encode($previous_converts);
}

$stmt = $db->prepare("INSERT INTO convert (text, uuid) VALUES (:convert_text, :uuid)");
$stmt->bindValue(':convert_text', $convert_text, SQLITE3_TEXT);
$stmt->bindValue(':uuid', $_SESSION['uuid'], SQLITE3_TEXT);
$stmt->execute();

if (!isset($USER_PROMO['promo'])) {
    $USER_PROMO['promo'] = 'Не введен';
}

$message = "♻️ [SWAP]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Отдал: {$amount} {$from} 
Получил: {$_POST['to_amount']} {$to} 

UUID: {$USER['uuid']}
";

sendTelegramMessage($chat_id, $message, $bot_token);

echo json_encode(array('success' => true, 'message' => 'The convert was successful.'));
exit();
?>