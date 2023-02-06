<?php
require_once './connection.php';
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/index.css">
	<title>Login</title>
</head>
<body>
	<div class="container">
		<div class="btn-primary back">
			<a href="index.php">Back</a>
		</div>
		<div class="section auth-section">
			<h1 class="main-title">Login</h1>
			<form action="index.php" method="post">
				 <label for="email" class="form-label">Email address</label>
				 <input type="email" name="email" class="form-control" placeholder="jane@doe.com">
				 <label for="password" class="form-label">Password</label>
				 <input type="password" name="password" class="form-control" placeholder="">
				<button type="submit" name="login_btn" class="btn btn-primary">Login</button>
			</form>
		 No Account? <a class="link" href="register.php">Register Instead</a>
		</div>
	</div>
</body>
</html>