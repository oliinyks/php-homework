<?php
session_start();

include '../partials/header.php';

$mysqli = require "../database.php";

$sql = "SELECT title, text, date, name FROM post WHERE id = {$_GET["id"]}";
$result = $mysqli->query($sql);
$onePost = $result->fetch_all();
?>

	<main>
		<div class="container">
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
		</div>
	</main>

<?php include '../partials/footer.php'; ?>