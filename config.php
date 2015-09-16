<?php
ob_start();

if(!session_id())	session_start();

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'renault1234');

define('DB_PASSWORD', 'renault1234');

define('DB_DATABASE', 'renault123');

mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

mysql_select_db(DB_DATABASE);

define('ROOT_DIR', str_replace("\\", "/", dirname(__FILE__)));

$ROOT_FOLDER	= str_replace($_SERVER['DOCUMENT_ROOT'], "", ROOT_DIR);

define('ROOT_URL', (isset($_SERVER["REQUEST_SCHEME"])? $_SERVER["REQUEST_SCHEME"]: "http") . "://$_SERVER[HTTP_HOST]$ROOT_FOLDER", true);

define('METHOD', $_SERVER["REQUEST_METHOD"]);

define('SELF', $_SERVER["PHP_SELF"]);

foreach($_REQUEST as $key => $value) {

	$$key = is_array($value)? $value: trim($value);

}
error_reporting(E_ERROR | E_PARSE);
?>