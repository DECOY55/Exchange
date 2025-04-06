<?php
echo "Loading.... By @cryptostudio_dev<br>";
if(!file_exists('db_228.db')){
    echo "Вы уже генерировали уникальный ключ для базы. Не стоит тыкать сто раз.";
}else {

    $db_guard = explode('-', generate_uuid());
    $db_filename = "db_228.db";
    $dbB_filename = "dbB_228.db";
    $dbV_filename = "dbV_228.db";

    $guard = $db_guard[4];

    echo "<br>ID: ".$guard."<br>";

    if (rename($db_filename, 'db_' . $guard . '.db') &&
        rename($dbB_filename, 'dbB_' . $guard . '.db') &&
        rename($dbV_filename, 'dbV_' . $guard . '.db')) {
        echo "<br>Файлы успешно созданы.";
    } else {
        echo "<br>Ошибка в защите базы. Проверьте версию php и прочие настройки..";
        exit();
    }


    $content = "<?\n";
    $content .= '$id_db = "_' . $guard . '";' . "\n";
    $content .= '$id_db_balance = "B_' . $guard . '";' . "\n";
    $content .= '$id_db_visit = "V_' . $guard . '";' . "\n\n";
    $content .= "function id_db(){\n";
    $content .= '    $rootPath = $_SERVER[\'DOCUMENT_ROOT\'];' . "\n";
    $content .= '    $filePath = str_replace($rootPath, \'\', __DIR__);' . "\n";
    $content .= '    $dir = $_SERVER[\'DOCUMENT_ROOT\'] . \'/db_cryptostudio\';' . "\n";
    $content .= '    return $dir.\'/db_' . $guard . '\';' . "\n";
    $content .= "}\n\n";
    $content .= "function id_db_balance(){\n";
    $content .= '    $rootPath = $_SERVER[\'DOCUMENT_ROOT\'];' . "\n";
    $content .= '    $filePath = str_replace($rootPath, \'\', __DIR__);' . "\n";
    $content .= '    $dir = $_SERVER[\'DOCUMENT_ROOT\'] . \'/db_cryptostudio\';' . "\n";
    $content .= '    return $dir.\'/dbB_' . $guard . '\';' . "\n";
    $content .= "}\n\n";
    $content .= "function id_db_visit(){\n";
    $content .= '    $rootPath = $_SERVER[\'DOCUMENT_ROOT\'];' . "\n";
    $content .= '    $filePath = str_replace($rootPath, \'\', __DIR__);' . "\n";
    $content .= '    $dir = $_SERVER[\'DOCUMENT_ROOT\'] . \'/db_cryptostudio\';' . "\n";
    $content .= '    return $dir.\'/dbV_' . $guard . '\';' . "\n";
    $content .= "}\n";
    $content .= "?>";

    file_put_contents("../settings/db_connect.php", $content);

    echo "Базы успешно прошли защиту, не повторяйте данное действие.<br>Через 5 секунд, вы вернетесь.";
}
echo "<br>Riderect...<br>";


function generate_uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        mt_rand(0, 0xffff),

        mt_rand(0, 0x0fff) | 0x4000,

        mt_rand(0, 0x3fff) | 0x8000,

        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
?>

<script>
    setTimeout(function() {
        window.location.href = "/";
    }, 5000);
</script>
