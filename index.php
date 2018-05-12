
<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

include_once(__DIR__.'/config/main.php');
//require_once __DIR__.'/config/main.php';

include_once(__DIR__.'/vendor/bootstrap/autoload.php');
//require_once __DIR__.'/vendor/bootstrap/autoload.php';

include_once(__DIR__.'/vendor/bootstrap/app.php');
//require_once __DIR__.'/vendor/bootstrap/app.php';
?>
