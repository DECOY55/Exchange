<?php
if($_GET['json'] == 1){

    echo '{
"success":true,
"data":{
"title":"Support",
"tickets":[

],
"have_new_messages":false
}
}';

}else{
    echo 'error 404';
}
?>
