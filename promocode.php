<?php
//error_reporting(0);
session_start();
include '_config.php';
$inputJSON = file_get_contents('php://input');
$input = json_decode( $inputJSON, TRUE );

$input['promocode'] = guardText($input['promocode']);

if(isset($input['promocode'])){

    if ($stmt = $db->prepare('SELECT * FROM promo_actived WHERE user="'.$_SESSION['uuid'].'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($input['promocode'] == $arr['promo']){
            $idP = $arr['id'];
                }
        }
    }
    if(isset($idP)){
        echo '{"success":false,"message":"You have already used this promocode."}';
        exit();
    }

        if ($stmt = $db->prepare('SELECT * FROM promocodes WHERE promo="'.$input['promocode'].'"')) {
            $result = $stmt->execute();
            while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
                $id = $arr['id'];
                $actived = $arr['actived'];
                $active = $arr['active'];
                $cur = $arr['cur'];
                $amount = $arr['amount'];
                $ref = $arr['ref'];
            }
        }
        if(!isset($id)){
            echo '{"success":false,"message":"Promocode '.$input['promocode'].' not found."}';
            exit();
        }
    if($active == 1){
        $active = true;
    }else{
        $active = false;
    }
    if($actived >= 1){
        $actived = $actived - 1;
        $db->query('UPDATE promocodes SET actived = '.$actived.' WHERE promo="'.$input['promocode'].'";');
    }else{
        echo '{"success":false,"message":"Promocode '.$input['promocode'].' not actived."}';
        exit();
    }

    $ticker = $cur;

    if($active){
        $dbB->query('UPDATE ' . $ticker . ' SET balance = balance + '.$amount.' WHERE uuid="' . $_SESSION['uuid'] . '";');
        $dbB->query('UPDATE ' . $ticker . ' SET total_balance = total_balance + '.$amount.' WHERE uuid="' . $_SESSION['uuid'] . '";');

        $db->query("INSERT INTO promo_actived (promo, user, ref) VALUES ('".$input['promocode']."', '".$_SESSION['uuid']."', '$ref')");


        $message = "🔰 [ПРОМОКОД]

Пользователь: {$USER['name']}
Ввел промокод: {$input['promocode']}
Начислено: {$amount} {$ticker}

UUID: {$USER['uuid']}
";
        sendTelegramMessage($chat_id, $message, $bot_token);


        if ($stmt = $db->prepare('SELECT * FROM promocodes WHERE promo="'.$input['promocode'].'"')) {
            $result = $stmt->execute();
            $PROMO_wro = $result->fetchArray(SQLITE3_ASSOC);
        }
        if(isset($PROMO_wro['tg_id'])){
            sendTelegramMessage($PROMO_wro['tg_id'], $message, $bot_token);
        }

        echo '{"success":true,"message":"The promocode for '.$amount.' '.$ticker.' has been successfully activated!","data":{"ticker":"'.$ticker.'","balance":"'.$amount.'","trade_balance":"0.000000","order_balance":"0.000000","total_balance":"'.$amount.'"}}';
        exit();
    }else{
        echo '{"success":false,"message":"Promocode not active."}';
        exit();
    }

}else{
    echo '{"success":false,"message":"ERROR"}';
}

?>