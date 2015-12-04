<?php

$db = new PDO('sqlite:../database/database.db');

$id = $_POST["id"];

$atCmd = "SELECT * FROM attendance WHERE eventId = '" . $id . "'";
$atStmt = $db->prepare($atCmd);
$atStmt->execute();
$at = $atStmt->fetchAll();
$atNumber = count($at);

echo "<div class=\"owner\">";
echo "<img class=\"icon\" src=\"../res/images/events/check.png\" height=\"32\" width=\"32\">";
echo "<a>Going: " . $atNumber . "</a>";
echo "</div>";

?>