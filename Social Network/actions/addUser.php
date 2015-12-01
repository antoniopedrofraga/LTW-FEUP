<?php 

$db = new PDO('sqlite:../database/database.db'); 

$firstName = htmlentities($_POST["firstName"]);
$lastName = htmlentities($_POST["lastName"]);
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);

try {
  	$stmt = $db->prepare('INSERT INTO user (firstName, lastName, email, password) VALUES (?, ?, ?, ?)');
  	$stmt->execute(array($firstName, $lastName, $email, $password));
  	echo 'true';
} catch (PDOException $e) {
  	die;
}

?>