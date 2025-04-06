<?php
error_reporting(0);
session_start();
include '../_config.php';
$email = $_POST['email'];
$pass = $_POST['password'];
$pass2 = $_POST['password_confirmation'];

if((isset($email)) AND (isset($pass))){
    if($pass == $pass2){

        $ip = '';

        $uuid = generate_uuid();
        $name = explode('@', $email)[0];
        $verified = 0;
        $min_dep_btc = "0.00500";
        $verified_status = 0;
        $premium_status = 0;
        $rid = 1;
        $trade_fee = "0.05";

        $id_db = "_228";
        $id_db_balance = "B_228";
        $dbB = new SQLite3("../db".$id_db_balance.".db");
        $db = new SQLite3("../db".$id_db.".db");

        if ($stmt = $db->prepare('SELECT * FROM users')) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                if($arr['email'] == $email){
                    header("Location: /register?error=5");
                    exit();
                }
                if($arr['name'] == $name){
                    header("Location: /register?error=4");
                    exit();
                }
                if($arr['uuid'] == $uuid){
                    header("Location: /register?error=3");
                    exit();
                }
            }
        }

        $db->query("INSERT INTO users (uuid, pass, name, email, verified, min_dep_btc, verified_status, premium_status, rid, trade_fee) VALUES ('$uuid','$pass','$name','$email','$verified','$min_dep_btc','$verified_status','$premium_status','$rid','$trade_fee')");
        $db->query("INSERT INTO sessions (ip_address) VALUES ('$ip')");

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

        echo 'ok';

        header("Location: /balance");
        exit();
    }else{
        header("Location: /register?error=2");
        exit();
    }
}else{
    header("Location: /register?error=1");
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