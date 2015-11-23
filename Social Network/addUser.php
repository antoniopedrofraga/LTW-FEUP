<?php 
//$db = new PDO('sqlite:./database/database.db'); 
$user =	mysql_real_escape_string($_GET['user']);
//$stmt = $db->prepare('SELECT * FROM user');
//$stmt->execute();
echo json_encode($user);
?>