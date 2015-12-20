<?php

$db = new PDO('sqlite:../database/database.db'); 


if(!isset($_POST["email"]) || !isset($_POST["id"])) {
	header('Location: ../index.php');
    die();
}

$email = $_POST["email"];
$id = $_POST["id"];



try {
  	$stmt = $db->prepare('DELETE FROM attendance WHERE eventId = ? AND email = ?');
  	$stmt->execute(array($id, $email));
  	echo 'true';
} catch (PDOException $e) {
  	echo 'Error removing going from database! Please try again later...';
}

?>