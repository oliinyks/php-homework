<?php

// require_once realpath(__DIR__ . '/vendor/autoload.php');

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

$host = "localhost";
$dbname = "posts";
$username = "root";
$password = "M9@111KnCW_(Yt70";

// $db_host = getenv('DB_HOST');
// $db_user = getenv('DB_USER');
// $db_password = getenv('DB_PASSWORD');
// $db_name = getenv('DB_NAME');

$mysqli = new mysqli(
  hostname: $host,
  username: $username,
  password: $password,
  database: $dbname
);

if ($mysqli->connect_errno) {
  die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
