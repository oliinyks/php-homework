<?php
include "../_private/private_data.php";

define('HOST', 'localhost');
define('DBNAME', 'posts');
define('USERNAME', 'root');
define('PASSWORD', 'M9@111KnCW_(Yt70');

$mysqli = new mysqli(
  hostname: HOST,
  username: USERNAME,
  password: PASSWORD,
  database: DBNAME
);

if ($mysqli->connect_errno) {
  die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;