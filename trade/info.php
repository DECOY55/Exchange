<?php
header("Content-Type: application/json");

session_start();
$uuid = $_SESSION['uuid'];

if(isset($uuid)) {

    require_once '../settings/db_connect.php';

    $dbB = new SQLite3("../db_cryptostudio/db" . $id_db_balance . ".db");

    if ($stmt = $dbB->prepare('SELECT * FROM BTC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $btc_name = $arr['name'];
                $btc_balance = $arr['balance'];
                $btc_spot_balance = $arr['spot_balance'];
                $btc_order_balance = $arr['order_balance'];
                $btc_total_balance = $arr['total_balance'];
            }
        }
    }

    if ($stmt = $dbB->prepare('SELECT * FROM ETH')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $eth_name = $arr['name'];
                $eth_balance = $arr['balance'];
                $eth_spot_balance = $arr['spot_balance'];
                $eth_order_balance = $arr['order_balance'];
                $eth_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM LTC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $ltc_name = $arr['name'];
                $ltc_balance = $arr['balance'];
                $ltc_spot_balance = $arr['spot_balance'];
                $ltc_order_balance = $arr['order_balance'];
                $ltc_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BCH')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $bch_name = $arr['name'];
                $bch_balance = $arr['balance'];
                $bch_spot_balance = $arr['spot_balance'];
                $bch_order_balance = $arr['order_balance'];
                $bch_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM USDC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $usdc_name = $arr['name'];
                $usdc_balance = $arr['balance'];
                $usdc_spot_balance = $arr['spot_balance'];
                $usdc_order_balance = $arr['order_balance'];
                $usdc_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BAT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $bat_name = $arr['name'];
                $bat_balance = $arr['balance'];
                $bat_spot_balance = $arr['spot_balance'];
                $bat_order_balance = $arr['order_balance'];
                $bat_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ETC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $etc_name = $arr['name'];
                $etc_balance = $arr['balance'];
                $etc_spot_balance = $arr['spot_balance'];
                $etc_order_balance = $arr['order_balance'];
                $etc_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ATOM')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $atom_name = $arr['name'];
                $atom_balance = $arr['balance'];
                $atom_spot_balance = $arr['spot_balance'];
                $atom_order_balance = $arr['order_balance'];
                $atom_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ZEC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $zec_name = $arr['name'];
                $zec_balance = $arr['balance'];
                $zec_spot_balance = $arr['spot_balance'];
                $zec_order_balance = $arr['order_balance'];
                $zec_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM LINK')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $link_name = $arr['name'];
                $link_balance = $arr['balance'];
                $link_spot_balance = $arr['spot_balance'];
                $link_order_balance = $arr['order_balance'];
                $link_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM USDT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $usdt_name = $arr['name'];
                $usdt_balance = $arr['balance'];
                $usdt_spot_balance = $arr['spot_balance'];
                $usdt_order_balance = $arr['order_balance'];
                $usdt_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BNB')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $bnb_name = $arr['name'];
                $bnb_balance = $arr['balance'];
                $bnb_spot_balance = $arr['spot_balance'];
                $bnb_order_balance = $arr['order_balance'];
                $bnb_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM XRP')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $xrp_name = $arr['name'];
                $xrp_balance = $arr['balance'];
                $xrp_spot_balance = $arr['spot_balance'];
                $xrp_order_balance = $arr['order_balance'];
                $xrp_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM EOS')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $eos_name = $arr['name'];
                $eos_balance = $arr['balance'];
                $eos_spot_balance = $arr['spot_balance'];
                $eos_order_balance = $arr['order_balance'];
                $eos_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ADA')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $ada_name = $arr['name'];
                $ada_balance = $arr['balance'];
                $ada_spot_balance = $arr['spot_balance'];
                $ada_order_balance = $arr['order_balance'];
                $ada_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM NEO')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $neo_name = $arr['name'];
                $neo_balance = $arr['balance'];
                $neo_spot_balance = $arr['spot_balance'];
                $neo_order_balance = $arr['order_balance'];
                $neo_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM TRX')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $trx_name = $arr['name'];
                $trx_balance = $arr['balance'];
                $trx_spot_balance = $arr['spot_balance'];
                $trx_order_balance = $arr['order_balance'];
                $trx_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM XLM')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $xlm_name = $arr['name'];
                $xlm_balance = $arr['balance'];
                $xlm_spot_balance = $arr['spot_balance'];
                $xlm_order_balance = $arr['order_balance'];
                $xlm_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ALGO')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $algo_name = $arr['name'];
                $algo_balance = $arr['balance'];
                $algo_spot_balance = $arr['spot_balance'];
                $algo_order_balance = $arr['order_balance'];
                $algo_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ONT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $ont_name = $arr['name'];
                $ont_balance = $arr['balance'];
                $ont_spot_balance = $arr['spot_balance'];
                $ont_order_balance = $arr['order_balance'];
                $ont_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM FTM')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $ftm_name = $arr['name'];
                $ftm_balance = $arr['balance'];
                $ftm_spot_balance = $arr['spot_balance'];
                $ftm_order_balance = $arr['order_balance'];
                $ftm_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM ONE')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $one_name = $arr['name'];
                $one_balance = $arr['balance'];
                $one_spot_balance = $arr['spot_balance'];
                $one_order_balance = $arr['order_balance'];
                $one_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM DOGE')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $doge_name = $arr['name'];
                $doge_balance = $arr['balance'];
                $doge_spot_balance = $arr['spot_balance'];
                $doge_order_balance = $arr['order_balance'];
                $doge_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM BUSD')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $busd_name = $arr['name'];
                $busd_balance = $arr['balance'];
                $busd_spot_balance = $arr['spot_balance'];
                $busd_order_balance = $arr['order_balance'];
                $busd_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM MATIC')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $matic_name = $arr['name'];
                $matic_balance = $arr['balance'];
                $matic_spot_balance = $arr['spot_balance'];
                $matic_order_balance = $arr['order_balance'];
                $matic_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM SOL')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $sol_name = $arr['name'];
                $sol_balance = $arr['balance'];
                $sol_spot_balance = $arr['spot_balance'];
                $sol_order_balance = $arr['order_balance'];
                $sol_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM DOT')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $dot_name = $arr['name'];
                $dot_balance = $arr['balance'];
                $dot_spot_balance = $arr['spot_balance'];
                $dot_order_balance = $arr['order_balance'];
                $dot_total_balance = $arr['total_balance'];
            }
        }
    }
    if ($stmt = $dbB->prepare('SELECT * FROM AVAX')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['uuid'] == $uuid) {
                $avax_name = $arr['name'];
                $avax_balance = $arr['balance'];
                $avax_spot_balance = $arr['spot_balance'];
                $avax_order_balance = $arr['order_balance'];
                $avax_total_balance = $arr['total_balance'];
            }
        }
    }

    $balances = '{
      "BTC":{
         "balance":"'.$btc_balance.'",
         "order_balance":"'.$btc_order_balance.'",
         "total_balance":"'.$btc_total_balance.'"
      },
      "ETH":{
         "balance":"'.$eth_balance.'",
         "order_balance":"'.$eth_order_balance.'",
         "total_balance":"'.$eth_total_balance.'"
      },
      "LTC":{
         "balance":"'.$ltc_balance.'",
         "order_balance":"'.$ltc_order_balance.'",
         "total_balance":"'.$ltc_total_balance.'"
      },
      "BCH":{
         "balance":"'.$bch_balance.'",
         "order_balance":"'.$bch_order_balance.'",
         "total_balance":"'.$bch_total_balance.'"
      },
      "USDC":{
         "balance":"'.$usdc_balance.'",
         "order_balance":"'.$usdc_order_balance.'",
         "total_balance":"'.$usdc_total_balance.'"
      },
      "BAT":{
         "balance":"'.$bat_balance.'",
         "order_balance":"'.$bat_order_balance.'",
         "total_balance":"'.$bat_total_balance.'"
      },
      "ETC":{
         "balance":"'.$etc_balance.'",
         "order_balance":"'.$etc_order_balance.'",
         "total_balance":"'.$etc_total_balance.'"
      },
      "ATOM":{
         "balance":"'.$atom_balance.'",
         "order_balance":"'.$atom_order_balance.'",
         "total_balance":"'.$atom_total_balance.'"
      },
      "ZEC":{
         "balance":"'.$zec_balance.'",
         "order_balance":"'.$zec_order_balance.'",
         "total_balance":"'.$zec_total_balance.'"
      },
      "LINK":{
         "balance":"'.$link_balance.'",
         "order_balance":"'.$link_order_balance.'",
         "total_balance":"'.$link_total_balance.'"
      },
      "USDT":{
         "balance":"'.$usdt_balance.'",
         "order_balance":"'.$usdt_order_balance.'",
         "total_balance":"'.$usdt_total_balance.'"
      },
      "BNB":{
         "balance":"'.$bnb_balance.'",
         "order_balance":"'.$bnb_order_balance.'",
         "total_balance":"'.$bnb_total_balance.'"
      },
      "XRP":{
         "balance":"'.$xrp_balance.'",
         "order_balance":"'.$xrp_order_balance.'",
         "total_balance":"'.$xrp_total_balance.'"
      },
      "EOS":{
         "balance":"'.$eos_balance.'",
         "order_balance":"'.$eos_order_balance.'",
         "total_balance":"'.$eos_total_balance.'"
      },
      "ADA":{
         "balance":"'.$ada_balance.'",
         "order_balance":"'.$ada_order_balance.'",
         "total_balance":"'.$ada_total_balance.'"
      },
      "NEO":{
         "balance":"'.$neo_balance.'",
         "order_balance":"'.$neo_order_balance.'",
         "total_balance":"'.$neo_total_balance.'"
      },
      "TRX":{
         "balance":"'.$trx_balance.'",
         "order_balance":"'.$trx_order_balance.'",
         "total_balance":"'.$trx_total_balance.'"
      },
      "XLM":{
         "balance":"'.$xlm_balance.'",
         "order_balance":"'.$xlm_order_balance.'",
         "total_balance":"'.$xlm_total_balance.'"
      },
      "ALGO":{
         "balance":"'.$algo_balance.'",
         "order_balance":"'.$algo_order_balance.'",
         "total_balance":"'.$algo_total_balance.'"
      },
      "ONT":{
         "balance":"'.$ont_balance.'",
         "order_balance":"'.$ont_order_balance.'",
         "total_balance":"'.$ont_total_balance.'"
      },
      "FTM":{
         "balance":"'.$ftm_balance.'",
         "order_balance":"'.$ftm_order_balance.'",
         "total_balance":"'.$ftm_total_balance.'"
      },
      "ONE":{
         "balance":"'.$one_balance.'",
         "order_balance":"'.$one_order_balance.'",
         "total_balance":"'.$one_total_balance.'"
      },
      "DOGE":{
         "balance":"'.$doge_balance.'",
         "order_balance":"'.$doge_order_balance.'",
         "total_balance":"'.$doge_total_balance.'"
      },
      "BUSD":{
         "balance":"'.$busd_balance.'",
         "order_balance":"'.$busd_order_balance.'",
         "total_balance":"'.$busd_total_balance.'"
      },
      "MATIC":{
         "balance":"'.$matic_balance.'",
         "order_balance":"'.$matic_order_balance.'",
         "total_balance":"'.$matic_total_balance.'"
      },
      "SOL":{
         "balance":"'.$sol_balance.'",
         "order_balance":"'.$sol_order_balance.'",
         "total_balance":"'.$sol_total_balance.'"
      },
      "DOT":{
         "balance":"'.$dot_balance.'",
         "order_balance":"'.$dot_order_balance.'",
         "total_balance":"'.$dot_total_balance.'"
      },
      "AVAX":{
         "balance":"'.$avax_balance.'",
         "order_balance":"'.$avax_order_balance.'",
         "total_balance":"'.$avax_total_balance.'"
      }
      }';

}else{
    $balances = '[]';
}

echo '{
   "success":true,
   "data":{
      "title":"Trade",
      "balances":
      '.$balances.'
      ,
      "orders":[
         
      ],
      "allow_symbols":[
         "BTC_USDT",
         "BTC_BUSD",
         "BTC_BTC",
         "BTC_ETH",
         "ETH_USDT",
         "ETH_BUSD",
         "ETH_BTC",
         "ETH_ETH",
         "LTC_USDT",
         "LTC_BUSD",
         "LTC_BTC",
         "LTC_ETH",
         "BCH_USDT",
         "BCH_BUSD",
         "BCH_BTC",
         "BCH_ETH",
         "USDC_USDT",
         "USDC_BUSD",
         "USDC_BTC",
         "USDC_ETH",
         "BAT_USDT",
         "BAT_BUSD",
         "BAT_BTC",
         "BAT_ETH",
         "ETC_USDT",
         "ETC_BUSD",
         "ETC_BTC",
         "ETC_ETH",
         "ATOM_USDT",
         "ATOM_BUSD",
         "ATOM_BTC",
         "ATOM_ETH",
         "ZEC_USDT",
         "ZEC_BUSD",
         "ZEC_BTC",
         "ZEC_ETH",
         "LINK_USDT",
         "LINK_BUSD",
         "LINK_BTC",
         "LINK_ETH",
         "USDT_USDT",
         "USDT_BUSD",
         "USDT_BTC",
         "USDT_ETH",
         "BNB_USDT",
         "BNB_BUSD",
         "BNB_BTC",
         "BNB_ETH",
         "XRP_USDT",
         "XRP_BUSD",
         "XRP_BTC",
         "XRP_ETH",
         "EOS_USDT",
         "EOS_BUSD",
         "EOS_BTC",
         "EOS_ETH",
         "ADA_USDT",
         "ADA_BUSD",
         "ADA_BTC",
         "ADA_ETH",
         "NEO_USDT",
         "NEO_BUSD",
         "NEO_BTC",
         "NEO_ETH",
         "TRX_USDT",
         "TRX_BUSD",
         "TRX_BTC",
         "TRX_ETH",
         "XLM_USDT",
         "XLM_BUSD",
         "XLM_BTC",
         "XLM_ETH",
         "ALGO_USDT",
         "ALGO_BUSD",
         "ALGO_BTC",
         "ALGO_ETH",
         "ONT_USDT",
         "ONT_BUSD",
         "ONT_BTC",
         "ONT_ETH",
         "FTM_USDT",
         "FTM_BUSD",
         "FTM_BTC",
         "FTM_ETH",
         "ONE_USDT",
         "ONE_BUSD",
         "ONE_BTC",
         "ONE_ETH",
         "DOGE_USDT",
         "DOGE_BUSD",
         "DOGE_BTC",
         "DOGE_ETH",
         "BUSD_USDT",
         "BUSD_BUSD",
         "BUSD_BTC",
         "BUSD_ETH",
         "MATIC_USDT",
         "MATIC_BUSD",
         "MATIC_BTC",
         "MATIC_ETH",
         "SOL_USDT",
         "SOL_BUSD",
         "SOL_BTC",
         "SOL_ETH",
         "DOT_USDT",
         "DOT_BUSD",
         "DOT_BTC",
         "DOT_ETH",
         "AVAX_USDT",
         "AVAX_BUSD",
         "AVAX_BTC",
         "AVAX_ETH"
      ],
      "trade_tokens":{
         "BTC":{
            "name":"Bitcoin",
            "fee":0.0005
         },
         "ETH":{
            "name":"Ethereum",
            "fee":0.006
         },
         "LTC":{
            "name":"Litecoin",
            "fee":0.12
         },
         "BCH":{
            "name":"Bitcoin Cash",
            "fee":0.035
         },
         "USDC":{
            "name":"USD Coin",
            "fee":25
         },
         "BAT":{
            "name":"Basic Attention Token",
            "fee":27
         },
         "ETC":{
            "name":"Ethereum Classic",
            "fee":0.361
         },
         "ATOM":{
            "name":"Cosmos",
            "fee":1.032
         },
         "ZEC":{
            "name":"Zcash",
            "fee":0.154
         },
         "LINK":{
            "name":"Chainlink",
            "fee":0.825
         },
         "USDT":{
            "name":"Tether",
            "fee":25
         },
         "BNB":{
            "name":"Binance Coin",
            "fee":0.05
         },
         "XRP":{
            "name":"Ripple",
            "fee":19.953
         },
         "EOS":{
            "name":"EOS",
            "fee":4.42
         },
         "ADA":{
            "name":"Cardano",
            "fee":8.632
         },
         "NEO":{
            "name":"NEO",
            "fee":0.415
         },
         "TRX":{
            "name":"TRON",
            "fee":245.33
         },
         "XLM":{
            "name":"Stellar Lumens",
            "fee":66.08
         },
         "ALGO":{
            "name":"Algorand",
            "fee":20.763
         },
         "ONT":{
            "name":"Ontology",
            "fee":19.975
         },
         "FTM":{
            "name":"Fantom",
            "fee":22.5
         },
         "ONE":{
            "name":"Harmony",
            "fee":200
         },
         "DOGE":{
            "name":"Dogecoin",
            "fee":83.15
         },
         "BUSD":{
            "name":"BUSD",
            "fee":25
         },
         "MATIC":{
            "name":"Polygon",
            "fee":10.28
         },
         "SOL":{
            "name":"Solana",
            "fee":0.4415
         },
         "DOT":{
            "name":"Polkadot",
            "fee":1.81
         },
         "AVAX":{
            "name":"Avalanche",
            "fee":0.5
         }
      },
      "quote_tokens":[
         "USDT",
         "BUSD",
         "BTC",
         "ETH"
      ],
      "symbols":"'.$_GET['ticker'].'_'.$_GET['ticker2'].'",
      "rate_changes":[
         
      ]
   }
}';
?>
