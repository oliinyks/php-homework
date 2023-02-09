<?php
session_start();
session_destroy();

header(
  "Location: http://" . $_SERVER["SERVER_NAME"] . "/php-homework/src/index.php"
);
exit();