<?php

include '../partials/header.php';

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $mysqli = require "../database.php";

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

      header(
        "Location: http://" . $_SERVER["SERVER_NAME"] . "/php-homework/src/index.php"
      );
      exit();
    }
  }

  $is_invalid = true;
}
?>

	<main>	
		<div class="container">
			<div class="section auth-section">
				<h1 class="main-title">Login</h1>
				<form method="post">
	
					<?php if ($is_invalid) {
			echo " <p class='error'>Invalid email or password</p>";} ?>
	
					<label for="email" class="form-label">Email address</label>
					<input type="email" name="email" class="form-control" placeholder="jane@doe.com" value="<?= htmlspecialchars(
			$_POST["email"] ?? "") ?>">
					<label for="password" class="form-label">Password</label>
					<input type="password" name="password" class="form-control" placeholder="">
					<button type="submit" name="login_btn" class="btn btn-primary">Login</button>
				</form>
				No Account? <a class="link" href="register.php">Register Instead</a>
			</div>
		</div>
		</div>
	</main>
<?php include '../partials/footer.php'; ?>