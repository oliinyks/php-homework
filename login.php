<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $mysqli = require __DIR__ . "/database.php";

  $sql = sprintf(
    "SELECT * FROM user WHERE email = '%s'",
    $mysqli->real_escape_string($_POST["email"])
  );

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();

  if ($user) {
    if (password_verify($_POST["password"], $user["password_hash"])) {
      session_start();

      session_regenerate_id();

      $_SESSION["user_id"] = $user["id"];

      header("Location: index.php");
      exit();
    }
  }

  $is_invalid = true;
}
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
			<a class="btn-primary back" href="index.php">Back</a>
		<div class="section auth-section">
			<h1 class="main-title">Login</h1>
			<form method="post">

				<?php if ($is_invalid) {
      echo " <p class='error'>Invalid email or password</p>";
    } ?>

				 <label for="email" class="form-label">Email address</label>
				 <input type="email" name="email" class="form-control" placeholder="jane@doe.com" value="<?= htmlspecialchars(
       $_POST["email"] ?? ""
     ) ?>">
				 <label for="password" class="form-label">Password</label>
				 <input type="password" name="password" class="form-control" placeholder="">
				<button type="submit" name="login_btn" class="btn btn-primary">Login</button>
			</form>
		 No Account? <a class="link" href="register.php">Register Instead</a>
		</div>
	</div>
</body>
</html>