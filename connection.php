<?php

require_once realpath(__DIR__ . '/vendor/autoload.php');

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'M9@111KnCW_(Yt70';
$db_name = 'posts';

// $db_host = getenv('DB_HOST');
// $db_user = getenv('DB_USER');
// $db_password = getenv('DB_PASSWORD');
// $db_name = getenv('DB_NAME');


try{
	$db = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e){
	echo $e->getMessage();
}
