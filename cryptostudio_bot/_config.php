<?php

	function projectAbout($a) { // Информации о проекте
		return [
			'projectName' => getSettingsInfo('name', 'settings'), // Название проекта
		][$a];
	}

	function botToken() {
    	return getSettingsInfo('tg_bot', 'settings');
	}

	function chatAlerts() {
		return getSettingsInfo('tg_admin', 'settings');
	}

function createUserPromo($id){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    $name = generatePromoCode();
    $crypto = "BTC";
    $amount = "0.5";
    $number = "9999";
    $db->query("INSERT INTO promocodes (promo, cur, amount, actived, active, tg_id) VALUES ('$name', '$crypto', '$amount', '$number', '1', '$id')");
    return $name;
}

$btns = [
    // Заполнение заявок
    'jncreate' => 'Подать заявку',
    'jnrules' => 'Принять',
    'jniread' => 'Продолжить',
    'joinaccpt' => '✅ Принять',
    'joindecl' => '❌ Отказать',
    // Функции бота
    'give_promo' => '❕ Получить промокод',
    'url_site' => '🌐 Сайт',
    'profile' => '👤 Мой профиль',
    'verf' => '✅ Верификация',
    'support' => '❗️Тех. поддержка',
];
$urls = [
    'url_site' => 'https://'.$_SERVER['SERVER_NAME'].'/',
    'ts' => getSettingsInfo('ts', 'settings'),
];


function checkUser($email){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    $result = $db->query('SELECT * FROM users WHERE email="'.$email.'";');

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        return true;
    } else {
        return false;
    }
}
function checkUserVerf($email){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    $result = $db->query('SELECT * FROM users WHERE email="'.$email.'" AND verified="1";');

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        return true;
    } else {
        return false;
    }
}
function checkUserTg($id){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    $result = $db->query('SELECT * FROM users WHERE tg_id = "'.$id.'";');

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        return true;
    } else {
        return false;
    }
}

function getSettings($type, $dbs, $id){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    if ($stmt = $db->prepare('SELECT * FROM '.$dbs.' WHERE tg_id="'.$id.'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}
function getSettingsInfo($type, $dbs){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    if ($stmt = $db->prepare('SELECT * FROM '.$dbs.' WHERE id="1"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            $get_info = $arr[$type];
        }
    }
    return $get_info;
}
function verifiedUser($email, $id){
    global $id_db;
    $db = new SQLite3("../db_cryptostudio/db".$id_db.".db");
    $db->query('UPDATE users SET verified = "1" WHERE email="'.$email.'";');
    $db->query('UPDATE users SET tg_id = "'.$id.'" WHERE email="'.$email.'";');
    $db->query('UPDATE users SET verified_status = "1" WHERE email="'.$email.'";');
    $db->query('UPDATE users SET trans = "0" WHERE email="'.$email.'";');
}
function generatePromoCode($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $promoCode = '';

    for ($i = 0; $i < $length; $i++) {
        $promoCode .= $characters[rand(0, $charactersLength - 1)];
    }

    return $promoCode;
}

?>