<?
// https://api.binance.us/api/v3/klines?symbol=BTCUSDT&interval=1d&limit=30
// https://api.binance.us/api/v3/klines?symbol=ETHUSDT&interval=1d&limit=30
// https://api.binance.us/api/v3/klines?symbol=BCHUSDT&interval=1d&limit=30
// https://api.binance.us/api/v3/klines?symbol=LTCUSDT&interval=1d&limit=30
// https://api.binance.us/api/v3/klines?symbol=XRPUSDT&interval=1d&limit=30

error_reporting(0);
header('Content-Type: application/json; charset=utf-8');

$symbol = $_GET['symbol'];
$interval = $_GET['interval'];
$limit = $_GET['limit'];

echo Requset($limit, $symbol, $interval);

function Requset($limit, $symbol, $interval){
    /*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.binance.com/api/v3/klines?symbol=".$symbol."&interval=".$interval."&limit=".$limit);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    */
    $data = file_get_contents("ticker/".$symbol."_".$interval."_".$limit.".json");
    return $data;
}
?>