<?php

$target_dir = "C:\Users\Pedro\Documents\GitHub\LTW-FEUP\Social Network\upload" . DIRECTORY_SEPARATOR; /*é preciso resolver caminhos absolutos,*/
$target_file = $target_dir . basename($_FILES["file-to-upload"]["name"]);							  /* a culpa é do wamp */
$uploadOk = 1;


if (move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file)) {
		try {
			$db = new PDO('sqlite:../database/database.db');

			$name = $_POST["name"];
			$desc = $_POST["description"];
			$date = $_POST["date"];
			$time = $_POST["time"];
			$privacy = $_POST["privacySpan"];
			$type = $_POST["typeSpan"];
			$photoPath = basename($_FILES["file-to-upload"]["name"]);


  			/*$stmt = $db->prepare('INSERT INTO user (firstName, lastName, email, password) VALUES (?, ?, ?, ?)');
  			$stmt->execute(array($firstName, $lastName, $email, $password));*/
  			echo $name . "\n" . $desc . "\n" . $date . "\n" . $time . "\n" . $privacy . "\n" . $type . "\n" . $photoPath;
		} catch (PDOException $e) {
  			echo "Sorry, it was not possible to write on db";
		}
} else {
        echo "Sorry, there was an error uploading your file. We could not move the file from a tmp directory.";
}

?>