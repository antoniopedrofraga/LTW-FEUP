<?php 

if(!isset($_POST["email"])) {
	header('Location: ../index.php');
    die();
}

$db = new PDO('sqlite:../database/database.db'); 
$stmt = $db->prepare('SELECT * FROM user'); 
$stmt->execute();  
$result = $stmt->fetchAll();

$email = $_POST["email"];
$password = $_POST["password"];
	
foreach( $result as $row ) {
	if($row["email"] == $email && hash('sha256',$password) == $row["password"]) {
		echo 'true';
		return;
	}
}

echo "false";

?>