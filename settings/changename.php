<?
error_reporting(0);
session_start();
include '../_config.php';
$inputJSON = file_get_contents('php://input');
$input = json_decode( $inputJSON, TRUE );
if(isset($input['nickname'])){

    if ($stmt = $db->prepare('SELECT * FROM users')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($arr['name'] == $input['nickname']) {
                $check = true;
                break;
            }else{
                $check = false;
            }
        }
    }

    if($check){
        echo '{"success":false,"message":"Username is already taken.."}';
        exit();
    }else{
        $db->query('UPDATE users SET name = "' . $input['nickname'] . '" WHERE uuid="' . $_SESSION['uuid'] . '";');
        echo '{"success":true,"message":"Nickname change successfully."}';
        exit();
    }

}else{
    echo '{"success":false,"message":"ERROR: no found nickname"}';
}

?>
