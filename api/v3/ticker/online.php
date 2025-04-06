<?php
ini_set('memory_limit', '512M');

error_reporting(0);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.binance.com/api/v3/ticker/24hr');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);
file_put_contents('24hr.json', $data);

$intervals = array('1m', '5m', '15m', '30m', '1h', '1d', '1M');
$limits = array('1m' => 500, '5m' => 500, '15m' => 500, '30m' => 500, '1h' => 500, '1d' => 500, '1d' => 30, '1M' => 500);

$symbols = array(
    'BTCUSDT',
    'ETHUSDT',
    'BCHUSDT',
    'DOGEUSDT',
    'LTCUSDT',
    'ADAUSDT',
    'AVAXUSDT',
    'DOTUSDT',
    'SOLUSDT',
    'MATICUSDT',
    'BUSDUSDT',
    'ONEUSDT',
    'FTMUSDT',
    'ONTUSDT',
    'ALGOUSDT',
    'XLMUSDT',
    'TRXUSDT',
    'NEOUSDT',
    'EOSUSDT',
    'BNBUSDT',
    'LINKUSDT',
    'ZECUSDT',
    'ATOMUSDT',
    'ETCUSDT',
    'BATUSDT',
    'USDCUSDT',
    'XRPUSDT'
);

foreach ($intervals as $interval) {
    foreach ($symbols as $symbol) {
        $url = sprintf('https://api.binance.com/api/v3/klines?symbol=%s&interval=%s&limit=%d', $symbol, $interval, $limits[$interval]);
        $filename = sprintf('%s_%s_%d.json', $symbol, $interval, $limits[$interval]);
        $urls[$url] = $filename;
    }
}

// Download each URL and save the response to the corresponding file
foreach ($urls as $url => $filename) {
    $data = file_get_contents($url);
    file_put_contents($filename, $data);
}
?>
<?php
/*
error_reporting(0);

$interval1 = '5m';
$interval2 = '1d';

$urls = array(
    "https://www.binance.com/api/v3/ticker/24hr" => "24hr.json",
    "https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=".$interval1."&limit=30" => "BTCUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ETHUSDT&interval=".$interval1."&limit=30" => "ETHUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BCHUSDT&interval=".$interval1."&limit=30" => "BCHUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=DOGEUSDT&interval=".$interval1."&limit=30" => "DOGEUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=LTCUSDT&interval=".$interval1."&limit=30" => "LTCUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ADAUSDT&interval=".$interval1."&limit=30" => "ADAUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=AVAXUSDT&interval=".$interval1."&limit=30" => "AVAXUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=DOTUSDT&interval=".$interval1."&limit=30" => "DOTUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=SOLUSDT&interval=".$interval1."&limit=30" => "SOLUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=MATICUSDT&interval=".$interval1."&limit=30" => "MATICUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BUSDUSDT&interval=".$interval1."&limit=30" => "BUSDUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ONEUSDT&interval=".$interval1."&limit=30" => "ONEUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=FTMUSDT&interval=".$interval1."&limit=30" => "FTMUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ONTUSDT&interval=".$interval1."&limit=30" => "ONTUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ALGOUSDT&interval=".$interval1."&limit=30" => "ALGOUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=XLMUSDT&interval=".$interval1."&limit=30" => "XLMUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=TRXUSDT&interval=".$interval1."&limit=30" => "TRXUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=NEOUSDT&interval=".$interval1."&limit=30" => "NEOUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=EOSUSDT&interval=".$interval1."&limit=30" => "EOSUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BNBUSDT&interval=".$interval1."&limit=30" => "BNBUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=LINKUSDT&interval=".$interval1."&limit=30" => "LINKUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ZECUSDT&interval=".$interval1."&limit=30" => "ZECUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ATOMUSDT&interval=".$interval1."&limit=30" => "ATOMUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ETCUSDT&interval=".$interval1."&limit=30" => "ETCUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BATUSDT&interval=".$interval1."&limit=30" => "BATUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=USDCUSDT&interval=".$interval1."&limit=30" => "USDCUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=XRPUSDT&interval=".$interval1."&limit=30" => "XRPUSDT_".$interval1."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=".$interval2."&limit=30" => "BTCUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ETHUSDT&interval=".$interval2."&limit=30" => "ETHUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BCHUSDT&interval=".$interval2."&limit=30" => "BCHUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=DOGEUSDT&interval=".$interval2."&limit=30" => "DOGEUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=LTCUSDT&interval=".$interval2."&limit=30" => "LTCUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ADAUSDT&interval=".$interval2."&limit=30" => "ADAUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=AVAXUSDT&interval=".$interval2."&limit=30" => "AVAXUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=DOTUSDT&interval=".$interval2."&limit=30" => "DOTUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=SOLUSDT&interval=".$interval2."&limit=30" => "SOLUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=MATICUSDT&interval=".$interval2."&limit=30" => "MATICUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BUSDUSDT&interval=".$interval2."&limit=30" => "BUSDUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ONEUSDT&interval=".$interval2."&limit=30" => "ONEUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=FTMUSDT&interval=".$interval2."&limit=30" => "FTMUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ONTUSDT&interval=".$interval2."&limit=30" => "ONTUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ALGOUSDT&interval=".$interval2."&limit=30" => "ALGOUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=XLMUSDT&interval=".$interval2."&limit=30" => "XLMUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=TRXUSDT&interval=".$interval2."&limit=30" => "TRXUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=NEOUSDT&interval=".$interval2."&limit=30" => "NEOUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=EOSUSDT&interval=".$interval2."&limit=30" => "EOSUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BNBUSDT&interval=".$interval2."&limit=30" => "BNBUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=LINKUSDT&interval=".$interval2."&limit=30" => "LINKUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ZECUSDT&interval=".$interval2."&limit=30" => "ZECUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ATOMUSDT&interval=".$interval2."&limit=30" => "ATOMUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=ETCUSDT&interval=".$interval2."&limit=30" => "ETCUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=BATUSDT&interval=".$interval2."&limit=30" => "BATUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=USDCUSDT&interval=".$interval2."&limit=30" => "USDCUSDT_".$interval2."_30.json",
    "https://api.binance.com/api/v3/klines?symbol=XRPUSDT&interval=".$interval2."&limit=30" => "XRPUSDT_".$interval2."_30.json"
);

foreach ($urls as $url => $filename) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    file_put_contents($filename, $data);
    sleep(1);
}

echo 'ok<br><br>';
*/
?>