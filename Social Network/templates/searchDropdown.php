<?php
$db = new PDO('sqlite:../database/database.db');

$string = $_POST["text"];


if ( strlen($string) > 0 ) {
	$searchCmd = "SELECT * FROM event WHERE name LIKE '%" . $string . "%'";
	$stmt3 = $db->prepare($searchCmd);
	$stmt3->execute();
	$searchResult = $stmt3->fetchAll();

	$it = 0;

	foreach ($searchResult as $evnt) {
		if ($it <= 5) {
			echo "<li>";
			echo "<div onclick=\"window.location = 'event.php?eventId=" . $evnt["id"] . "'\">";
			echo "<div class=\"image\"><img src=\"../upload/" . $evnt["photoPath"] . "\"></div>";
			echo "<div class=\"text\" id=" . $evnt["id"] . ">";
			echo "<p class=\"name\">" . $evnt["name"] . "</p>";
			echo "<p class=\"description\">" . $evnt["type"] . " - " . $evnt["description"] . "</p>";
			echo "</span>";
			echo "</div>";
			echo "</li>";
			$it = $it + 1;
		}
	}

if (empty($searchResult)) {
	echo "<li><a>No events were found..</a></li>";
}
}
?>