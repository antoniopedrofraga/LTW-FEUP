<?php

if(!isset($_POST["eventName"]) || !isset($_POST["eventDescription"])) {
	header('Location: ../index.php');
    die();
}

$name = htmlentities($_POST["eventName"]);
$desc = htmlentities($_POST["eventDescription"]);
$type = htmlentities($_POST["eventType"]);
$photoPath = htmlentities(basename($_FILES["fileToUpload"]["name"]));
$date = $_POST["eventDate"];
$time = $_POST["eventTime"];
$finalDate = $date . " " . $time;
$currDate = date('Y/m/d G:i:s', time());

$email = $_POST["email"];

$replaced = $_POST["replaced"];

if($replaced == "true") {
  $photoPath = "v2" . $photoPath;
}

try {

 $db = new PDO('sqlite:../database/database.db');
 $stmt = $db->prepare('INSERT INTO event (name, description, type, photoPath, eventDate, createDate) VALUES (?, ?, ?, ?, ?, ?)');
 $stmt->execute(array($name, $desc, $type, $photoPath, $finalDate, $currDate));

 $stmt2 = $db->prepare('SELECT * FROM event');
 $stmt2->execute();
 $result = $stmt2->fetchAll();

 $id = $result[count($result) - 1]["id"];

 $stmt3 = $db->prepare('INSERT INTO owner (email, eventId) VALUES (?, ?)');
 $stmt3->execute(array($email, $id));

 echo 'true';

} catch (PDOException $e) {
  echo $e->getMessage();
}

?>