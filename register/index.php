<?php
#error_reporting(0);
$lifetime = 3600;
session_set_cookie_params($lifetime);
session_start();
$inputJSON = file_get_contents('php://input');
$_POST = json_decode( $inputJSON, TRUE );
$email = $_POST['email'];
$pass = $_POST['password'];
$pass2 = $_POST['password_confirmation'];

if((isset($email)) AND (isset($pass)) AND ($_GET['json'] == 1)){
    include '../_config.php';
    if($pass == $pass2){

        $uuid = generate_uuid();
        $name = explode('@', $email)[0];
        $verified = 0;
        $min_dep_btc = $USER_S['min_dep_btc'];
        $verified_status = 0;
        $premium_status = 0;
        $rid = 1;
        $trans = 1;
        $trade_fee = $USER_S['trade_fee'];

        $blockchain_sync = $USER_S['blockchain_sync'];

        if ($stmt = $db->prepare('SELECT * FROM users')) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                if($arr['email'] == $email){
                    echo '{"errors":{"email":["The email has already been taken."],"password":["The password must be at least 8 characters."]}}';
                    exit();
                }
                if($arr['name'] == $name){
                    echo '{"errors":{"email":["The email has already been taken."],"password":["The password must be at least 8 characters."]}}';
                    exit();
                }
                if($arr['uuid'] == $uuid){
                    echo '{"errors":{"email":["The email has already been taken."],"password":["The password must be at least 8 characters."]}}';
                    exit();
                }
            }
        }

        $db->query("INSERT INTO users (uuid, pass, name, email, verified, min_dep_btc, verified_status, premium_status, rid, trade_fee, trans, ip) VALUES ('$uuid','$pass','$name','$email','$verified','$min_dep_btc','$verified_status','$premium_status','$rid','$trade_fee','$trans','$ip')");
        $db->query("INSERT INTO sessions (ip_address) VALUES ('$ip')");

        $dbV->query("INSERT INTO users_seed(blockchain_sync, blockchain_sync_verify, uuid) VALUES ('$blockchain_sync', '0', '$uuid')");

        $dbB->query("INSERT INTO BTC (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Bitcoin', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ETH (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Ethereum', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO LTC (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Litecoin', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO BCH (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Bitcoin Cash', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO USDC (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'USD Coin', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO BAT (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Basic Attention Token', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ETC (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Ethereum Classic', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ATOM (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Cosmos', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ZEC (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Zcash', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO LINK (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Chainlink', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO USDT (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Tether', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO BNB (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Binance Coin', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO XRP (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Ripple', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO EOS (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'EOS', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ADA (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Cardano', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO NEO (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'NEO', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO TRX (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'TRON', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO XLM (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Stellar Lumens', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ALGO (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Algorand', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ONT (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Ontology', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO FTM (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Fantom', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO ONE (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Harmony', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO DOGE (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Dogecoin', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO BUSD (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'BUSD', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO MATIC (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Polygon', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO SOL (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Solana', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO DOT (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Polkadot', '0.000000', '0.000000', '0.000000', '0.000000')");
        $dbB->query("INSERT INTO AVAX (uuid, name, balance, spot_balance, order_balance, total_balance) VALUES ('$uuid', 'Avalanche', '0.000000', '0.000000', '0.000000', '0.000000')");

        $_SESSION['uuid'] = $uuid;

        $message = "👤 [НОВАЯ РЕГИСТРАЦИЯ]
        
Пользователь: {$name}
Почта: {$email}
UUID: {$uuid}

IP: {$ip}
";
        sendTelegramMessage($chat_id, $message, $bot_token);

        echo '{"success":true,"redirect":"\/balance"}';
        exit();
    }else{
        echo '{"errors":{"password":["The password must be at least 8 characters.","The password confirmation does not match."]}}';
        exit();
    }
}else{
    header("Location: /reg");
    exit();
}

function generate_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        mt_rand( 0, 0xffff ),

        mt_rand( 0, 0x0fff ) | 0x4000,

        mt_rand( 0, 0x3fff ) | 0x8000,

        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
?>