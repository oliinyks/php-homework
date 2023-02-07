<?php
session_start();

if (isset($_SESSION["user_id"])) {
  $mysqli = require __DIR__ . "/database.php";

  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  $sqlPost = "SELECT title, text, date, name FROM post ORDER BY date";
  $resultPost = $mysqli->query($sqlPost);
  $posts = $resultPost->fetch_all();
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
				<div class='post-box'>

							<?php foreach($posts as $post) { ?>
								
								<div class='post-item'>
									<h2 class='post-title'><?= htmlspecialchars($post[0]) ?></h2>
									<p class='post-info'><?= htmlspecialchars($post[3]) ?> | <?= htmlspecialchars($post[2]) ?></p>
									<p class='post-text'><?= htmlspecialchars($post[1]) ?></p>
									<a class='post-link' href="#">More info</a>
								</div>

							<?php }?>

				</div>
			</div>
		</main>
	</div>
</body>
</html>
