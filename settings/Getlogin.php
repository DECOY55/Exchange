<?php

error_reporting(0);
session_start();
include '../_config.php';
$email = $_POST['email'];
$pass = $_POST['password'];
if((isset($email)) AND (isset($pass))){

    if ($stmt = $db->prepare('SELECT * FROM users')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['email'] == $email){
                if($arr['pass'] == $pass){
                    $_SESSION['uuid'] = $arr['uuid'];
                    echo 'ok';
                    header("Location: /balance");
                    exit();
                }else{
                    echo 'pass no valid | '.$pass;
                    header("Location: /login?error=3");
                    exit();
                }
            }else{
                echo 'email no found | '.$email;
                header("Location: /login?error=2");
                exit();
            }
        }
    }

}else{
    header("Location: /login?error=1");
    exit();
}

?>