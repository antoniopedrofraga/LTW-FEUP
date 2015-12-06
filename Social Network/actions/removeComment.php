<?php

$db = new PDO('sqlite:../database/database.db'); 

$id = $_POST["id"];

try {
  	$stmt = $db->prepare('DELETE FROM comment WHERE id = ?');
  	$stmt->execute(array($id));

    echo "true";

} catch (PDOException $e) {
  	echo 'Error removing event from database! Please try again later...';
}