<?php
error_log("Health check accessed at " . date('Y-m-d H:i:s'));
header('Content-Type: text/plain');
echo "OK";
?>
