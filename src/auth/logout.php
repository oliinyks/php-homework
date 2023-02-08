<?php
session_start();
session_destroy();

header("Location: http://localhost/php-homework/src/index.php");
exit;