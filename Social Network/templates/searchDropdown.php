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
								echo "<li>
								<img src=\"../upload/" . $evnt["photoPath"] . "\">
								<a href=\"event.php?eventId=" . $evnt["id"] . "\">" . $evnt["name"] . "</a>
								</li>";
								$it++;
							}
						}

						if (empty($searchResult)) {
							echo "<li><a href=\"#\">No events were found..</a></li>";
						}
					}
				?>