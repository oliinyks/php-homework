<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT title, text, date, name FROM post WHERE id = {$_GET["id"]}";
$result = $mysqli->query($sql);
$onePost = $result->fetch_all();

if (isset($_POST["post_btn"])) {
  $title = $_POST["title"];
  $text = $_POST["text"];

  if (empty($title)) {
    $errorMsg[0][] = "Title is required";
  }

  if (empty($text)) {
    $errorMsg[1][] = "Text is required";
  }

  if (empty($errorMsg)) {
    $date = new DateTime();
    $date = $date->format("Y-m-d H:i:s");

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    $name = $user["name"];

    $postId = $mysqli->real_escape_string($_GET["id"]);
    $postTitle = $mysqli->real_escape_string($title);
    $postText = $mysqli->real_escape_string($text);
    $postTime = $mysqli->real_escape_string($date);
    $sql = "UPDATE post SET title = '$postTitle', text = '$postText', date = '$postTime' WHERE id = '$postId'";

    if ($mysqli->query($sql)) {
      header(require __DIR__ . "/index.php");
      exit();
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
	<title>Post edit</title>
</head>
<body>
	<div class="container">
		<main>
			<div class="section">
				<div class='post-box'>

						<?php foreach ($onePost as $post) { ?>

								<form method="post" class='post-item'>
									<?php if (isset($errorMsg[0])) {
           foreach ($errorMsg[0] as $titleError) {
             echo " <p class='error'>" . $titleError . "</p>";
           }
         } ?>

								<input type="text" name="title" class="form-control" value="<?= htmlspecialchars(
          $post[0]
        ) ?>">
								
										<?php if (isset($errorMsg[1])) {
            foreach ($errorMsg[1] as $postError) {
              echo " <p class='error'>" . $postError . "</p>";
            }
          } ?>

									<textarea name="text" class="form-textarea"><?= htmlspecialchars(
           $post[1]
         ) ?></textarea>
	
				<button type="submit" name="post_btn" class="btn btn-primary">Post</button>
								</form>
							<?php } ?>
				</div>
			</div>
		</main>
	</div>
</body>
</html>
