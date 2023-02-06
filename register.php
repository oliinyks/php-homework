
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
					<input type="text" name="name" class="form-control" placeholder="Jane Doe">
					<label for="email" class="form-label">Email address</label>
					<input type="email" name="email" class="form-control" placeholder="jane@doe.com">
					<label for="password" class="form-label">Password</label>
					<input type="password" name="password" class="form-control" placeholder="">
					
				<button type="submit" name="register_btn" class="btn btn-primary">Register Account</button>
			</form>
			Already Have an Account? <a class="link" href="login.php">Login Instead</a>
		</div>
	</div>
</body>

</html>