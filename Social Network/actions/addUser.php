<?php 

$db = new PDO('sqlite:../database/database.db');


$date = $_POST["eventDate"];
$time = $_POST["eventTime"];
$finalDate = $date . " " . $time;
$currDate = date('Y/m/d G:i:s', time());
$firstName = htmlentities($_POST["firstName"]);
$lastName = htmlentities($_POST["lastName"]);
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);
$photoPath = "default-user.png";

try {
  	$stmt = $db->prepare('INSERT INTO user (firstName, lastName, photoPath, email, password) VALUES (?, ?, ?, ?, ?)');
  	$stmt->execute(array($firstName, $lastName, $photoPath, $email, $password));
  	echo 'true';
} catch (PDOException $e) {
  	die;
}

?>