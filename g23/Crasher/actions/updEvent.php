<?php


if(!isset($_POST["id"])) {
	header('Location: ../index.php');
    die();
}

$name = htmlentities($_POST["eventName"]);
$desc = htmlentities($_POST["eventDescription"]);
$type = htmlentities($_POST["eventType"]);
$date = $_POST["eventDate"];
$time = $_POST["eventTime"];
$finalDate = $date . " " . $time;
$id = $_POST["id"];

$currDate = date('Y/m/d G:i:s', time());

$diff = strtotime($finalDate) - strtotime($currDate);

if($diff < 0) {
	echo "Please create an event with an upcoming date... ";
	return;
}

try {

 $db = new PDO('sqlite:../database/database.db');
 $stmt = $db->prepare('UPDATE event SET name = ?, description = ?, type = ?, eventDate = ?  WHERE id = ?');
 $stmt->execute(array($name, $desc, $type, $finalDate, $id));
 echo 'true';

} catch (PDOException $e) {
  echo $e->getMessage();
}

?>