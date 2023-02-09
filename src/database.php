<?php
include "../_private/private_data.php";

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