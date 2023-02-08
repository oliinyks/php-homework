<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT title, text, date, name FROM post WHERE id = {$_GET["id"]}";
$result = $mysqli->query($sql);
$onePost = $result->fetch_all();
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/index.css">
	<title>Post</title>
</head>
<body>
	<div class="container">
		<main>
			<div class="section">
				<div class='post-box'>

						<?php foreach ($onePost as $post) { ?>
								<div class='post-item'>
									<h2 class='post-title'><?= htmlspecialchars($post[0]) ?></h2>
									<p class='post-info'><?= htmlspecialchars($post[3]) ?> | <?= htmlspecialchars($post[2]) ?></p>
									<p class='post-text'><?= htmlspecialchars($post[1]) ?></p>
						
								</div>
							<?php } ?>
				</div>
			</div>
		</main>
	</div>
</body>
</html>
