<?php

$db = new PDO('sqlite:../database/database.db'); 

$id = $_POST["id"];



try {
  	$stmt = $db->prepare('DELETE FROM event WHERE id = ?');
  	$stmt->execute(array($id));

  	$stmt2 = $db->prepare('DELETE FROM comment WHERE eventId = ?');
  	$stmt2->execute(array($id));


  	$stmt3 = $db->prepare('DELETE FROM attendance WHERE eventId = ?');
  	$stmt3->execute(array($id));

  	$stmt4 = $db->prepare('DELETE FROM owner WHERE eventId = ?');
  	$stmt4->execute(array($id));

    echo "true";

} catch (PDOException $e) {
  	echo 'Error removing event from database! Please try again later...';
}

?>