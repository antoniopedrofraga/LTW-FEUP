<?php 

$db = new PDO('sqlite:./database/database.db'); 

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];

try {
  	$stmt = $db->prepare('INSERT INTO user (firstName, lastName, email, password) VALUES (?, ?, ?, ?)');
  	$stmt->execute(array($firstName, $lastName, $email, $password));
  	echo 'true';
} catch (PDOException $e) {
  	die;
}

?>