<?php
session_start();

$$user["name"] = null;
$mysqli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {

  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

  $sqlPost = "SELECT id, title, text, date, name FROM post ORDER BY date DESC, date ASC";
  $resultPost = $mysqli->query($sqlPost);
  $posts = $resultPost->fetch_all();
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
						<li class="menu-user"><a class="btn-primary" href="<?= htmlspecialchars('http://' . $_SERVER["SERVER_NAME"] . '/php-homework/src/post/create-post.php') ?>">New post</a></li>
						<li><a class="menu-item btn-primary" href="<?= htmlspecialchars('http://' . $_SERVER["SERVER_NAME"] . '/php-homework/src/auth/logout.php') ?>">Log out</a></li>

						<?php else: ?>
							
					<li><a class="menu-item btn-primary" href="<?= htmlspecialchars('http://' . $_SERVER["SERVER_NAME"] . '/php-homework/src/auth/login.php') ?>">Login</a>
					</li>
					<li><a class="menu-item btn-primary" href="<?= htmlspecialchars('http://' . $_SERVER["SERVER_NAME"] . '/php-homework/src/auth/register.php') ?>">Register</a>
					</li>

					<?php endif; ?>

				</ul>
			</nav>
		</header>
		<main>
			<div class="section">
				<h1 class="main-title">Posts</h1>
				<div class='post-box'>

							<?php foreach ($posts as $post) { ?>
								<div class='post-item'>
									<?php
									if($user["name"] === $post[4]){
										echo '<a class="post-edit" href="http://' . $_SERVER["SERVER_NAME"] . '/php-homework/src/post/post-edit.php/index?id='.$post[0].'">edit</a>';
									}
									?>

									<h2 class='post-title'><?= htmlspecialchars($post[1]) ?></h2>
									<p class='post-info'><?= htmlspecialchars($post[4]) ?> | <?= htmlspecialchars($post[3]) ?></p>

									<?php 
									$string = strip_tags($post[2]);
										if (strlen($string) > 500) {

											$stringCut = substr($string, 0, 500);
											$endPoint = strrpos($stringCut, ' ');

											$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
											$string .= '... <a class="post-link" href="http://' . $_SERVER["SERVER_NAME"] . '/php-homework/src/post/post.php/index?id='.$post[0].'">Read More</a>';
										}
										echo $string;
										?>
						
								</div>

							<?php } ?>

				</div>
			</div>
		</main>
	</div>
</body>
</html>
