<?php

$db = new PDO('sqlite:../database/database.db'); 

if(!isset($_POST["email"]) || !isset($_POST["id"])) {
	header('Location: ../index.php');
    die();
}

$email = $_POST["email"];
$id = $_POST["id"];

try {
  	$stmt = $db->prepare('INSERT INTO attendance (email, eventId) VALUES (?, ?)');
  	$stmt->execute(array($email, $id));
  	echo 'true';
} catch (PDOException $e) {
  	echo 'Error adding going to database! Please try again later...';
}

?>