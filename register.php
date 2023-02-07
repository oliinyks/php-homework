<?php

if (isset($_POST["register_btn"])) {
  $name = $_POST["name"];
  $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
  $password = strip_tags($_POST["password"]);

  if (empty($name)) {
    $errorMsg[0][] = "Name is required";
  }

  if (empty($email)) {
    $errorMsg[1][] = "Email is required";
  }

  if (strlen($password) < 6) {
    $errorMsg[2][] = "Password must be at least 6 characters";
  }

  if (empty($errorMsg)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $mysqli = require __DIR__ . "/database.php";

    $sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";

    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
      die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
      header("Location: login.php");
      exit();

    } else {
      if ($mysqli->errno === 1062) {
        $errorMsg[1][] = "Email is already taken";
      } else {
        die($mysqli->error . " " . $mysqli->errno);
      }
    }
  }
} ?>

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

				<?php if (isset($errorMsg[0])) {
      foreach ($errorMsg[0] as $nameError) {
        echo " <p class='error'>" . $nameError . "</p>";
      }
    } ?>

					<input type="text" name="name" class="form-control" placeholder="Jane Doe"  value="<?= htmlspecialchars($name ?? '') ?>">
					<label for="email" class="form-label">Email address</label>

						<?php if (isset($errorMsg[1])) {
        foreach ($errorMsg[1] as $emailError) {
          echo " <p class='error'>" . $emailError . "</p>";
        }
      } ?>

					<input type="email" name="email" class="form-control" placeholder="jane@doe.com"  value="<?= htmlspecialchars($email ?? '') ?>">
					<label for="password" class="form-label">Password</label>

						<?php if (isset($errorMsg[2])) {
        foreach ($errorMsg[2] as $passwordError) {
          echo " <p class='error'>" . $passwordError . "</p>";
        }
      } ?>

					<input type="password" name="password" class="form-control" placeholder="">
					
				<button type="submit" name="register_btn" class="btn btn-primary">Register Account</button>
			</form>
			Already Have an Account? <a class="link" href="login.php">Login Instead</a>
		</div>
	</div>
</body>

</html>