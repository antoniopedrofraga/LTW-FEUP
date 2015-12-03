<?php 

$db = new PDO('sqlite:../database/database.db'); 

$firstName = htmlentities($_POST["firstName"]);
$lastName = htmlentities($_POST["lastName"]);
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);
$photoPath = "default-profile.png";

try {
  	$stmt = $db->prepare('INSERT INTO user (firstName, lastName, photoPath, email, password) VALUES (?, ?, ?, ?)');
  	$stmt->execute(array($firstName, $lastName, $photoPath, $email, $password));
  	echo 'true';
} catch (PDOException $e) {
  	die;
}

?>