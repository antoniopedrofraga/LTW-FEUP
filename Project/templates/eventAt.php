<?php

session_start();

$db = new PDO('sqlite:../database/database.db');

$id = $_POST["id"];

$atCmd = "SELECT * FROM attendance WHERE eventId = '" . $id . "'";
$atStmt = $db->prepare($atCmd);
$atStmt->execute();
$at = $atStmt->fetchAll();
$atNumber = count($at);

$linCmd = "SELECT * FROM user WHERE email = '" . $_SESSION["email"] . "'";
$linStmt = $db->prepare($linCmd);
$linStmt->execute();
$lin = $linStmt->fetchAll();
$lin = $lin[0];



echo "<div class=\"owner\">";
echo "<a class=\"number\" >" . $atNumber . "</a>";
echo "<a class=\"text\" > going</a>";
echo "</div>";

$it = 0;
foreach($at as $attendance) {
	if($it < 5) {
		$it++;
		$userCmd = "SELECT * FROM user WHERE email = '" . $attendance["email"] . "'";
		$userStmt = $db->prepare($userCmd);
		$userStmt->execute();
		$user = $userStmt->fetchAll();
		$user = $user[0];
		echo "<img class='goingImg' href='/profile.php?id=" . $user['id'] ."' src='../upload/" . $user['photoPath'] . "' width ='50' height='50' style='display: inline-block; object-fit: cover;'>";
	}
}

?>