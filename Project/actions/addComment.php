<?php 

$db = new PDO('sqlite:../database/database.db'); 

if(!isset($_POST["email"]) || !isset($_POST["id"])) {
	header('Location: ../index.php');
    die();
}

$email = htmlentities($_POST["email"]);
$id = $_POST["id"];
$text = htmlentities($_POST["text"]);
try {
  	$stmt = $db->prepare('INSERT INTO comment (email, eventId, commentText) VALUES (?, ?, ?)');
  	$stmt->execute(array($email, $id, $text));
  	echo 'true';
} catch (PDOException $e) {
  	echo $e->getMessage();
}

?>