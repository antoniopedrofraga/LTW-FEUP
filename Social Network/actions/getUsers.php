<?php 

$db = new PDO('sqlite:../database/database.db'); 
$stmt = $db->prepare('SELECT * FROM user'); 
$stmt->execute();  
$result = $stmt->fetchAll();

$email = $_POST["email"];
$password = $_POST["password"];
	
foreach( $result as $row ) {
	if($row["email"] == $email && $row["password"] == $password) {
		echo 'true';
		return;
	}
}

echo 'false';

?>