<?php
#error_reporting(0);
$lifetime = 3600;
session_set_cookie_params($lifetime);
session_start();
include '../_config.php';
$inputJSON = file_get_contents('php://input');
$_POST = json_decode( $inputJSON, TRUE );
$email = $_POST['email'];
$pass = $_POST['password'];
if((isset($email)) AND (isset($pass))){

    if ($stmt = $db->prepare('SELECT * FROM users WHERE email = :email')) {
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        $arr = $result->fetchArray(SQLITE3_ASSOC);
        if ($arr) {
            if ($arr['pass'] == $pass) {
                $_SESSION['uuid'] = $arr['uuid'];
                if ($arr['premium_status'] == 1) {
                    $message = "❗️ [ADMIN LOG]
Администратор авторизовался.
Пользователь: {$arr['name']}
UUID: {$arr['uuid']}
";
                    sendTelegramMessage($chat_id, $message, $bot_token);
                }
                echo '{"success":true,"redirect":"\/balance"}';
                exit();
            } else {
                echo '{"errors":{"password":["The password is entered incorrectly."]}}';
                exit();
            }
        } else {
            echo '{"errors":{"email":["These credentials do not match our records."]}}';
            exit();
        }
    } else {
        echo '{"errors":{"email":["Error db, BY @cryptostudio_dev"]}}';
        exit();
    }

}else{
    header("Location: /");
    exit();
}

?>
