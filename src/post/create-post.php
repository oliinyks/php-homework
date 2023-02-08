<?php
session_start();

if (isset($_SESSION["user_id"])) {
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
      $mysqli = require "../database.php";

      $date = new DateTime();
      $date = $date->format("Y-m-d H:i:s");

      $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
      $result = $mysqli->query($sql);
      $user = $result->fetch_assoc();
      $name = $user["name"];

      $sql =
        "INSERT INTO post (title, text, date, name) VALUES (?, ?, ?, ?)";

      $stmt = $mysqli->stmt_init();

      if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
      }

      $stmt->bind_param("ssss", $title, $text, $date, $name);

      if ($stmt->execute()) {
        header("Location: http://localhost/php-homework/src/index.php");
        exit();
      }
		else {
        die($mysqli->error . " " . $mysqli->errno);
      }
    }
  }
} else {
  header("Location: http://localhost/php-homework/src/index.php");
  exit();
}
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/index.css">
	<title>Home</title>
</head>
<body>
	<div class="container">
		<a class="btn-primary back" href="http://localhost/php-homework/src/index.php">Back</a>
		<div class="section post-section">
			<h1 class="main-title">Create a new post</h1>
			<form method="post">
				<label for="name" class="form-label">Title</label>
				
				<?php if (isset($errorMsg[0])) {
      foreach ($errorMsg[0] as $titleError) {
        echo " <p class='error'>" . $titleError . "</p>";
      }
    } ?>

				<input type="text" name="title" class="form-control" value="<?= htmlspecialchars(
      $title ?? ""
    ) ?>">
			
			<?php if (isset($errorMsg[1])) {
     foreach ($errorMsg[1] as $postError) {
       echo " <p class='error'>" . $postError . "</p>";
     }
   } ?>

				<textarea name="text" placeholder="Whats on your mind?" class="form-textarea"></textarea>
	
				<button type="submit" name="post_btn" class="btn btn-primary">Post</button>
			</form>
		</div>
	</div>
</body>
</html>