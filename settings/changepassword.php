<?
error_reporting(0);
session_start();
include '../_config.php';
$inputJSON = file_get_contents('php://input');
$input = json_decode( $inputJSON, TRUE );
if(isset($input['current_password'])){

    if(!$input['new_confirm_password'] == $input['new_password']){
        echo '{"success":false,"message":"Password is already taken.."}';
        exit();
    }

    if ($stmt = $db->prepare('SELECT * FROM users WHERE uuid="' . $_SESSION['uuid'] . '";')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['pass'] == $input['current_password']) {
                $check = false;
                break;
            }else{
                $check = true;
            }
        }
    }

    if($check){
        echo '{"success":false,"message":"Password is already taken.."}';
        exit();
    }else{
        $db->query('UPDATE users SET pass = "' . $input['new_password'] . '" WHERE uuid="' . $_SESSION['uuid'] . '";');
        echo '{"success":true,"message":"Password change successfully."}';
        exit();
    }

}else{
    echo '{"success":false,"message":"ERROR"}';
}

?>