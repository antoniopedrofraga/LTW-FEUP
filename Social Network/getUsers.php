<?php 
$db = new PDO('sqlite:./database/database.db'); 
$stmt = $db->prepare('SELECT * FROM user'); 
$stmt->execute();  
$result = $stmt->fetchAll();
echo json_encode($result);
?>