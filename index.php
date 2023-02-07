<?php
session_start();

if (isset($_SESSION["user_id"])) {
  $mysqli = require __DIR__ . "/database.php";

  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

//    $sql = "SELECT * FROM post WHERE id = {$_SESSION["user_id"]}";
//   $result = $mysqli->query($sql);
//   $user = $result->fetch_assoc();

}
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/index.css">
	<title>Home</title>
</head>
<body>
	<div class="container">
		<header>
			<nav class="menu">
				<ul class="menu-items">

					<?php if (isset($user)): ?>
						<li class="menu-user">Hello, <?= htmlspecialchars($user["name"]) ?></li>
						<li class="menu-user"><a class="btn-primary" href="create-post.php">New post</a></li>
						<li><a class="menu-item btn-primary" href="logout.php">Log out</a></li>

						<?php else: ?>
							
					<li><a class="menu-item btn-primary" href="login.php">Login</a>
					</li>
					<li><a class="menu-item btn-primary" href="register.php">Register</a>
					</li>

					<?php endif; ?>

				</ul>
			</nav>
		</header>
		<main>
			<div class="section">
				<h1 class="main-title">Posts</h1>
			</div>
		</main>
	</div>
</body>
</html>
