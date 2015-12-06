<?php
$db = new PDO('sqlite:../database/database.db');

$string = $_POST["text"];


if ( strlen($string) > 0 ) {
	$searchCmd = "SELECT * FROM event WHERE name LIKE '%" . $string . "%'";
	$stmt3 = $db->prepare($searchCmd);
	$stmt3->execute();
	$searchResult = $stmt3->fetchAll();

	$userCmd = "SELECT * FROM user WHERE firstName LIKE '%" . $string . "%' OR email LIKE '%" . $string . "%' OR lastName LIKE '%" . $string . "%'";
	$stmt = $db->prepare($userCmd);
	$stmt->execute();
	$userResult = $stmt->fetchAll();

	$it = 0;

	foreach ($searchResult as $evnt) {
		if ($it < 6) {
			echo "<li>";
			echo "<div onclick=\"window.location = 'event.php?eventId=" . $evnt["id"] . "'\">";
			echo "<div class=\"image\"><img src=\"../upload/" . $evnt["photoPath"] . "\"></div>";
			echo "<div class=\"text\" id=" . $evnt["id"] . ">";
			echo "<p class=\"name\">" . $evnt["name"] . "</p>";
			echo "<p class=\"description\">" . $evnt["type"] . " - " . $evnt["description"] . "</p>";
			echo "</div>";
			echo "</div>";
			echo "</li>";
			$it = $it + 1;
		}
	}


	foreach ($userResult as $user) {
		if ($it < 6) {
			$name =  $user["firstName"] . " " . $user["lastName"];
			echo "<li>";
			echo "<div onclick=\"window.location = 'profile.php?id=" . $user["id"] . "'\">";
			echo "<div class=\"image\"><img src=\"../upload/" . $user["photoPath"] . "\"></div>";
			echo "<div class=\"text\" id=" . $user["id"] . ">";
			echo "<p class=\"name\">" . $name . "</p>";
			echo "<p class=\"description\">" . $user["email"] . "</p>";
			echo "</div>";
			echo "</div>";
			echo "</li>";
			$it = $it + 1;
		}
	}

if (empty($searchResult) && empty($userResult)) {
	echo "<li><a>No events or users were found..</a></li>";
}
}
?>