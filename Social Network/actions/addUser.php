<?php 

if(!isset($_POST["email"])) {
	header('Location: ../index.php');
    die();
}

$db = new PDO('sqlite:../database/database.db');

$currDate = date('Y/m/d G:i:s', time());
$firstName = htmlentities($_POST["firstName"]);
$lastName = htmlentities($_POST["lastName"]);
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);
$photoPath = "default-user.png";


$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
  	$stmt = $db->prepare('INSERT INTO user (firstName, lastName, photoPath, email, password) VALUES (?, ?, ?, ?, ?)');
  	$stmt->execute(array($firstName, $lastName, $photoPath, $email, $hashedPassword));
  	echo 'true';
} catch (PDOException $e) {
  	echo $e->getMessage();
}

?>