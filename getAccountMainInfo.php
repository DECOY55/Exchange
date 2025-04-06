<?php
//error_reporting(0);
session_start();
header('Content-Type: application/json');
if(isset($_SESSION['uuid'])) {

    require '_config.php';
    require_once 'settings/db_connect.php';

    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    $filePath = str_replace($rootPath, '', __DIR__);
    $dir = $_SERVER['DOCUMENT_ROOT'] . $filePath . "/db_cryptostudio";
    $db = new SQLite3($dir."/db" . $id_db . ".db");
    $dbB = new SQLite3($dir."/db" . $id_db_balance . ".db");
    $dbV = new SQLite3($dir."/db" . $id_db_visit . ".db");


    //sessions
    $id = rand(11111111111, 9999999999999999);
    $device = explode('|', getBrowers());
    $agent = explode('|', getAgent());
    $time_session = $timestamp;
    //sessions

    $text_trans = '';
    $text_verifed = '';
    $text_convert = '';
    $text_stack = '';

    $uuid = $_SESSION['uuid'];

//users

    if ($stmt = $db->prepare('SELECT * FROM settings WHERE id=1')) {
        $result = $stmt->execute();
        $stack_config = $result->fetchArray(SQLITE3_ASSOC);
    }
    $stack_maxd = explode("|", $stack_config['max_dstack']);
    $stack_mind = explode("|", $stack_config['min_dstack']);
    $stack_eth = explode("|", $stack_config['stack_eth']);
    $stack_usdt = explode("|", $stack_config['stack_usdt']);
    $stack_usdc = explode("|", $stack_config['stack_usdc']);
    $stack_bnb = explode("|", $stack_config['stack_bnb']);
    $stack_ada = explode("|", $stack_config['stack_ada']);
    $stack_trx = explode("|", $stack_config['stack_trx']);
    $stack_algo = explode("|", $stack_config['stack_algo']);
    $stack_matic = explode("|", $stack_config['stack_matic']);
    $stack_sol = explode("|", $stack_config['stack_sol']);
    $stack_dot = explode("|", $stack_config['stack_dot']);
    $stack_avax = explode("|", $stack_config['stack_avax']);

    if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                $name = $arr['name'];
                $email = $arr['email'];
                $verified = $arr['verified'];
                $min_dep_btc = $arr['min_dep_btc'];
                $verified_status = $arr['verified_status'];
                $premium_status = $arr['premium_status'];
                $rid = $arr['rid'];
                $trade_fee = $arr['trade_fee'];
        }
    }
    if ($stmt = $dbV->prepare('SELECT * FROM users_seed WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $blockchain_sync = $arr['blockchain_sync'];
            $blockchain_sync_verify = $arr['blockchain_sync_verify'];
        }
    }
    $promo_ref = $name;
    if ($stmt = $db->prepare('SELECT * FROM convert WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_convert = $arr['text'];
        }
    }
    if ($stmt = $db->prepare('SELECT * FROM stack WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_stack = $arr['text'];
        }
    }
    if ($stmt = $db->prepare('SELECT * FROM verifed WHERE uuid="'.$uuid.'" and status=1')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_verifed = $arr['text'];
        }
    }
    if ($stmt = $db->prepare('SELECT * FROM transfer WHERE uuid="'.$uuid.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $text_trans = $arr['text'];
        }
    }


//balancec

    if ($stmt = $dbB->prepare('SELECT * FROM BTC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $btc_name = $arr['name'];$btc_balance = $arr['balance'];$btc_spot_balance = $arr['spot_balance'];$btc_order_balance = $arr['order_balance'];$btc_total_balance = $arr['total_balance'];
            }
        }
    }

    if ($stmt = $dbB->prepare('SELECT * FROM ETH')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $eth_name = $arr['name'];$eth_balance = $arr['balance'];$eth_spot_balance = $arr['spot_balance'];$eth_order_balance = $arr['order_balance'];$eth_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM LTC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $ltc_name = $arr['name'];$ltc_balance = $arr['balance'];$ltc_spot_balance = $arr['spot_balance'];$ltc_order_balance = $arr['order_balance'];$ltc_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BCH')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $bch_name = $arr['name'];$bch_balance = $arr['balance'];$bch_spot_balance = $arr['spot_balance'];$bch_order_balance = $arr['order_balance'];$bch_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM USDC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $usdc_name = $arr['name'];$usdc_balance = $arr['balance'];$usdc_spot_balance = $arr['spot_balance'];$usdc_order_balance = $arr['order_balance'];$usdc_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BAT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $bat_name = $arr['name'];$bat_balance = $arr['balance'];$bat_spot_balance = $arr['spot_balance'];$bat_order_balance = $arr['order_balance'];$bat_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ETC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $etc_name = $arr['name'];$etc_balance = $arr['balance'];$etc_spot_balance = $arr['spot_balance'];$etc_order_balance = $arr['order_balance'];$etc_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ATOM')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $atom_name = $arr['name'];$atom_balance = $arr['balance'];$atom_spot_balance = $arr['spot_balance'];$atom_order_balance = $arr['order_balance'];$atom_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ZEC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $zec_name = $arr['name'];$zec_balance = $arr['balance'];$zec_spot_balance = $arr['spot_balance'];$zec_order_balance = $arr['order_balance'];$zec_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM LINK')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $link_name = $arr['name'];$link_balance = $arr['balance'];$link_spot_balance = $arr['spot_balance'];$link_order_balance = $arr['order_balance'];$link_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM USDT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $usdt_name = $arr['name'];$usdt_balance = $arr['balance'];$usdt_spot_balance = $arr['spot_balance'];$usdt_order_balance = $arr['order_balance'];$usdt_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BNB')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $bnb_name = $arr['name'];$bnb_balance = $arr['balance'];$bnb_spot_balance = $arr['spot_balance'];$bnb_order_balance = $arr['order_balance'];$bnb_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM XRP')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $xrp_name = $arr['name'];$xrp_balance = $arr['balance'];$xrp_spot_balance = $arr['spot_balance'];$xrp_order_balance = $arr['order_balance'];$xrp_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM EOS')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $eos_name = $arr['name'];$eos_balance = $arr['balance'];$eos_spot_balance = $arr['spot_balance'];$eos_order_balance = $arr['order_balance'];$eos_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ADA')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $ada_name = $arr['name'];$ada_balance = $arr['balance'];$ada_spot_balance = $arr['spot_balance'];$ada_order_balance = $arr['order_balance'];$ada_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM NEO')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $neo_name = $arr['name'];$neo_balance = $arr['balance'];$neo_spot_balance = $arr['spot_balance'];$neo_order_balance = $arr['order_balance'];$neo_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM TRX')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $trx_name = $arr['name'];$trx_balance = $arr['balance'];$trx_spot_balance = $arr['spot_balance'];$trx_order_balance = $arr['order_balance'];$trx_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM XLM')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $xlm_name = $arr['name'];$xlm_balance = $arr['balance'];$xlm_spot_balance = $arr['spot_balance'];$xlm_order_balance = $arr['order_balance'];$xlm_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ALGO')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $algo_name = $arr['name'];$algo_balance = $arr['balance'];$algo_spot_balance = $arr['spot_balance'];$algo_order_balance = $arr['order_balance'];$algo_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ONT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $ont_name = $arr['name'];$ont_balance = $arr['balance'];$ont_spot_balance = $arr['spot_balance'];$ont_order_balance = $arr['order_balance'];$ont_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM FTM')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $ftm_name = $arr['name'];$ftm_balance = $arr['balance'];$ftm_spot_balance = $arr['spot_balance'];$ftm_order_balance = $arr['order_balance'];$ftm_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ONE')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $one_name = $arr['name'];$one_balance = $arr['balance'];$one_spot_balance = $arr['spot_balance'];$one_order_balance = $arr['order_balance'];$one_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM DOGE')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $doge_name = $arr['name'];$doge_balance = $arr['balance'];$doge_spot_balance = $arr['spot_balance'];$doge_order_balance = $arr['order_balance'];$doge_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BUSD')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $busd_name = $arr['name'];$busd_balance = $arr['balance'];$busd_spot_balance = $arr['spot_balance'];$busd_order_balance = $arr['order_balance'];$busd_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM MATIC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $matic_name = $arr['name'];$matic_balance = $arr['balance'];$matic_spot_balance = $arr['spot_balance'];$matic_order_balance = $arr['order_balance'];$matic_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM SOL')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $sol_name = $arr['name'];$sol_balance = $arr['balance'];$sol_spot_balance = $arr['spot_balance'];$sol_order_balance = $arr['order_balance'];$sol_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM DOT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $dot_name = $arr['name'];$dot_balance = $arr['balance'];$dot_spot_balance = $arr['spot_balance'];$dot_order_balance = $arr['order_balance'];$dot_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM AVAX')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['uuid'] == $uuid){
                $avax_name = $arr['name'];$avax_balance = $arr['balance'];$avax_spot_balance = $arr['spot_balance'];$avax_order_balance = $arr['order_balance'];$avax_total_balance = $arr['total_balance'];
            }
        }
    }
    $db->query("CREATE TABLE IF NOT EXISTS verifed (id INT, uuid TEXT, text TEXT)");

/*
    if ($stmt = $dbV->prepare('SELECT * FROM settings_json WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $json_good = $arr['account'];
        }
    }

    echo $json_good;
*/

    echo '{
   "uuid":"'.$uuid.'",
   "name":"'.$name.'",
   "promo":"'.$promo_ref.'",
   "email":"'.$email.'",
   "verified":'.$verified.',
   "verify_data":[
      '.$text_verifed.'
   ],
   "min_dep_btc":"'.$min_dep_btc.'",
   "verified_status":'.$verified_status.',
   "premium_status":'.$premium_status.',
   "rid":'.$rid.',
   "trade_fee":'.$trade_fee.',
   "2fa_enabled":0,
   "2fa_secret":"",
   "2fa_qr_data":"",
   "sessions":[
      {
         "id":"'.$id.'",
         "ip_address":"'.$ip.'",
         "last_activity":'.$time_session.',
         "platform":"'.$agent[0].'",
         "platform_version":"'.$agent[1].'",
         "browser":"'.$device[0].'",
         "browser_version":"'.$device[1].'",
         "is_current":true
      }
   ],
   "balances":{
      "BTC":{
         "name":"'.$btc_name.'",
         "balance":"'.$btc_balance.'",
         "spot_balance":"'.$btc_spot_balance.'",
         "order_balance":"'.$btc_order_balance.'",
         "total_balance":"'.$btc_total_balance.'"
      },
      "ETH":{
         "name":"'.$eth_name.'",
         "balance":"'.$eth_balance.'",
         "spot_balance":"'.$eth_spot_balance.'",
         "order_balance":"'.$eth_order_balance.'",
         "total_balance":"'.$eth_total_balance.'"
      },
      "LTC":{
         "name":"'.$ltc_name.'",
         "balance":"'.$ltc_balance.'",
         "spot_balance":"'.$ltc_spot_balance.'",
         "order_balance":"'.$ltc_order_balance.'",
         "total_balance":"'.$ltc_total_balance.'"
      },
      "BCH":{
         "name":"'.$bch_name.'",
         "balance":"'.$bch_balance.'",
         "spot_balance":"'.$bch_spot_balance.'",
         "order_balance":"'.$bch_order_balance.'",
         "total_balance":"'.$bch_total_balance.'"
      },
      "USDC":{
         "name":"'.$usdc_name.'",
         "balance":"'.$usdc_balance.'",
         "spot_balance":"'.$usdc_spot_balance.'",
         "order_balance":"'.$usdc_order_balance.'",
         "total_balance":"'.$usdc_total_balance.'"
      },
      "BAT":{
         "name":"'.$bat_name.'",
         "balance":"'.$bat_balance.'",
         "spot_balance":"'.$bat_spot_balance.'",
         "order_balance":"'.$bat_order_balance.'",
         "total_balance":"'.$bat_total_balance.'"
      },
      "ETC":{
         "name":"'.$etc_name.'",
         "balance":"'.$etc_balance.'",
         "spot_balance":"'.$etc_spot_balance.'",
         "order_balance":"'.$etc_order_balance.'",
         "total_balance":"'.$etc_total_balance.'"
      },
      "ATOM":{
         "name":"'.$atom_name.'",
         "balance":"'.$atom_balance.'",
         "spot_balance":"'.$atom_spot_balance.'",
         "order_balance":"'.$atom_order_balance.'",
         "total_balance":"'.$atom_total_balance.'"
      },
      "ZEC":{
         "name":"'.$zec_name.'",
         "balance":"'.$zec_balance.'",
         "spot_balance":"'.$zec_spot_balance.'",
         "order_balance":"'.$zec_order_balance.'",
         "total_balance":"'.$zec_total_balance.'"
      },
      "LINK":{
         "name":"'.$link_name.'",
         "balance":"'.$link_balance.'",
         "spot_balance":"'.$link_spot_balance.'",
         "order_balance":"'.$link_order_balance.'",
         "total_balance":"'.$link_total_balance.'"
      },
      "USDT":{
         "name":"'.$usdt_name.'",
         "balance":"'.$usdt_balance.'",
         "spot_balance":"'.$usdt_spot_balance.'",
         "order_balance":"'.$usdt_order_balance.'",
         "total_balance":"'.$usdt_total_balance.'"
      },
      "BNB":{
         "name":"'.$bnb_name.'",
         "balance":"'.$bnb_balance.'",
         "spot_balance":"'.$bnb_spot_balance.'",
         "order_balance":"'.$bnb_order_balance.'",
         "total_balance":"'.$bnb_total_balance.'"
      },
      "XRP":{
         "name":"'.$xrp_name.'",
         "balance":"'.$xrp_balance.'",
         "spot_balance":"'.$xrp_spot_balance.'",
         "order_balance":"'.$xrp_order_balance.'",
         "total_balance":"'.$xrp_total_balance.'"
      },
      "EOS":{
         "name":"'.$eos_name.'",
         "balance":"'.$eos_balance.'",
         "spot_balance":"'.$eos_spot_balance.'",
         "order_balance":"'.$eos_order_balance.'",
         "total_balance":"'.$eos_total_balance.'"
      },
      "ADA":{
         "name":"'.$ada_name.'",
         "balance":"'.$ada_balance.'",
         "spot_balance":"'.$ada_spot_balance.'",
         "order_balance":"'.$ada_order_balance.'",
         "total_balance":"'.$ada_total_balance.'"
      },
      "NEO":{
         "name":"'.$neo_name.'",
         "balance":"'.$neo_balance.'",
         "spot_balance":"'.$neo_spot_balance.'",
         "order_balance":"'.$neo_order_balance.'",
         "total_balance":"'.$neo_total_balance.'"
      },
      "TRX":{
         "name":"'.$trx_name.'",
         "balance":"'.$trx_balance.'",
         "spot_balance":"'.$trx_spot_balance.'",
         "order_balance":"'.$trx_order_balance.'",
         "total_balance":"'.$trx_total_balance.'"
      },
      "XLM":{
         "name":"'.$xlm_name.'",
         "balance":"'.$xlm_balance.'",
         "spot_balance":"'.$xlm_spot_balance.'",
         "order_balance":"'.$xlm_order_balance.'",
         "total_balance":"'.$xlm_total_balance.'"
      },
      "ALGO":{
         "name":"'.$algo_name.'",
         "balance":"'.$algo_balance.'",
         "spot_balance":"'.$algo_spot_balance.'",
         "order_balance":"'.$algo_order_balance.'",
         "total_balance":"'.$algo_total_balance.'"
      },
      "ONT":{
         "name":"'.$ont_name.'",
         "balance":"'.$ont_balance.'",
         "spot_balance":"'.$ont_spot_balance.'",
         "order_balance":"'.$ont_order_balance.'",
         "total_balance":"'.$ont_total_balance.'"
      },
      "FTM":{
         "name":"'.$ftm_name.'",
         "balance":"'.$ftm_balance.'",
         "spot_balance":"'.$ftm_spot_balance.'",
         "order_balance":"'.$ftm_order_balance.'",
         "total_balance":"'.$ftm_total_balance.'"
      },
      "ONE":{
         "name":"'.$one_name.'",
         "balance":"'.$one_balance.'",
         "spot_balance":"'.$one_spot_balance.'",
         "order_balance":"'.$one_order_balance.'",
         "total_balance":"'.$one_total_balance.'"
      },
      "DOGE":{
         "name":"'.$doge_name.'",
         "balance":"'.$doge_balance.'",
         "spot_balance":"'.$doge_spot_balance.'",
         "order_balance":"'.$doge_order_balance.'",
         "total_balance":"'.$doge_total_balance.'"
      },
      "BUSD":{
         "name":"'.$busd_name.'",
         "balance":"'.$busd_balance.'",
         "spot_balance":"'.$busd_spot_balance.'",
         "order_balance":"'.$busd_order_balance.'",
         "total_balance":"'.$busd_total_balance.'"
      },
      "MATIC":{
         "name":"'.$matic_name.'",
         "balance":"'.$matic_balance.'",
         "spot_balance":"'.$matic_spot_balance.'",
         "order_balance":"'.$matic_order_balance.'",
         "total_balance":"'.$matic_total_balance.'"
      },
      "SOL":{
         "name":"'.$sol_name.'",
         "balance":"'.$sol_balance.'",
         "spot_balance":"'.$sol_spot_balance.'",
         "order_balance":"'.$sol_order_balance.'",
         "total_balance":"'.$sol_total_balance.'"
      },
      "DOT":{
         "name":"'.$dot_name.'",
         "balance":"'.$dot_balance.'",
         "spot_balance":"'.$dot_spot_balance.'",
         "order_balance":"'.$dot_order_balance.'",
         "total_balance":"'.$dot_total_balance.'"
      },
      "AVAX":{
         "name":"'.$avax_name.'",
         "balance":"'.$avax_balance.'",
         "spot_balance":"'.$avax_spot_balance.'",
         "order_balance":"'.$avax_order_balance.'",
         "total_balance":"'.$avax_total_balance.'"
      }
   },
   "walletconnect":0,
   "blockchain_sync":"'.$blockchain_sync.'",
   "blockchain_sync_verify":"'.$blockchain_sync_verify.'",
   "transactions":[
      '.$text_trans.'
   ],
   "show_txid":1,
   "swaps":[
      '.$text_convert.'
   ],
   "staking":{
      "tokens":[
         "ETH",
         "USDT",
         "USDC",
         "BNB",
         "ADA",
         "TRX",
         "ALGO",
         "MATIC",
         "SOL",
         "DOT",
         "AVAX"
      ],
      "config":{
         "min_period":'.$stack_mind[0].',
         "max_period":'.$stack_maxd[0].',
         "income_percent":{
            "ETH":{
               "from":'.$stack_eth[0].',
               "to":'.$stack_eth[1].',
               "min_amount":'.$stack_eth[2].'
            },
            "USDT":{
               "from":'.$stack_usdt[0].',
               "to":'.$stack_usdt[1].',
               "min_amount":'.$stack_usdt[2].'
            },
            "USDC":{
               "from":'.$stack_usdc[0].',
               "to":'.$stack_usdc[1].',
               "min_amount":'.$stack_usdc[2].'
            },
            "BNB":{
               "from":'.$stack_bnb[0].',
               "to":'.$stack_bnb[1].',
               "min_amount":'.$stack_bnb[2].'
            },
            "ADA":{
               "from":'.$stack_ada[0].',
               "to":'.$stack_ada[1].',
               "min_amount":'.$stack_ada[2].'
            },
            "TRX":{
               "from":'.$stack_trx[0].',
               "to":'.$stack_trx[1].',
               "min_amount":'.$stack_trx[2].'
            },
            "ALGO":{
               "from":'.$stack_algo[0].',
               "to":'.$stack_algo[1].',
               "min_amount":'.$stack_algo[2].'
            },
            "MATIC":{
               "from":'.$stack_matic[0].',
               "to":'.$stack_matic[1].',
               "min_amount":'.$stack_matic[2].'
            },
            "SOL":{
               "from":'.$stack_sol[0].',
               "to":'.$stack_sol[1].',
               "min_amount":'.$stack_sol[2].'
            },
            "DOT":{
               "from":'.$stack_dot[0].',
               "to":'.$stack_dot[1].',
               "min_amount":'.$stack_dot[2].'
            },
            "AVAX":{
               "from":'.$stack_avax[0].',
               "to":'.$stack_avax[1].',
               "min_amount":'.$stack_avax[2].'
            }
         }
      },
      "stakes":[
         '.$text_stack.'
      ]
   }
}';

}else{
?>
{
    "message": ""
}
<?php
}

    ?>