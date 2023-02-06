<?php
require_once './connection.php';

session_start();

if(isset($_SESSION['user'])){
	header('location: index.php');
}

if(isset($_REQUEST['register_btn'])){
	$name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
	$password = strip_tags($_REQUEST['password']);

	if(empty($name)){
		$errorMsg[0][] = 'Name is required';
	}
	
	if(empty($email)){
		$errorMsg[1][] = 'Email is required';
	}
	
	if(strlen($password) < 6){
			$errorMsg[2][] = 'Password must be at least 6 characters';
		}
	
	if(empty($errorMsg)){
		try{
			$select_stmt = $db->prepare("SELECT name,emeil FROM users WHERE emeil = :emeil");
			$select_stmt->execute(['email' => $email]);
			$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

			if(isset($row['email']) === $email){
				$errorMsg[1][] = "Email address already exists, please choose another or login instead";
			}else{
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$created = new DateTime();
				$created = $created->format('Y-m-d H:i:s');

				$insert_stmt = $db->prepare("INSERT INTO users (name,email,password,created) VALUES(:name,:email,:password,:created)");
			
			if($insert_stmt->execute([
				':name' => $name,
				':email' => $email,
				':password' => $hashed_password,
				':created' => $created,
			])) {
				header('location: index.php');
			}
			}
		}
		catch(PDOException $e){
			$pdoError = $e->getMessage();
		}
	}
}


?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/index.css">
	<title>Register</title>
</head>

<body>
	<div class="container">
		<div class="btn-primary back">
		<a href="index.php">Back</a>
	</div>
		<div class="section auth-section">
			<h1 class="main-title">Register</h1>
			<form action="register.php" method="post">
				<label for="name" class="form-label">Name</label>

				<?php
				if(isset($errorMsg[0])){
					foreach($errorMsg[0] as $nameError){
						echo " <p class='error'>".$nameError."</p>";
					}
				}
				?>

					<input type="text" name="name" class="form-control" placeholder="Jane Doe">
					<label for="email" class="form-label">Email address</label>

						<?php
				if(isset($errorMsg[1])){
					foreach($errorMsg[1] as $emailError){
						echo " <p class='error'>".$emailError."</p>";
					}
				}
				?>

					<input type="email" name="email" class="form-control" placeholder="jane@doe.com">
					<label for="password" class="form-label">Password</label>

						<?php
				if(isset($errorMsg[2])){
					foreach($errorMsg[2] as $passwordError){
						echo " <p class='error'>".$passwordError."</p>";
					}
				}
				?>

					<input type="password" name="password" class="form-control" placeholder="">
					
				<button type="submit" name="register_btn" class="btn btn-primary">Register Account</button>
			</form>
			Already Have an Account? <a class="link" href="login.php">Login Instead</a>
		</div>
	</div>
</body>

</html>