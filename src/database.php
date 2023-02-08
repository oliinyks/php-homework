<?php

$host = "localhost";
$dbname = "posts";
$username = "root";
$password = "M9@111KnCW_(Yt70";

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
