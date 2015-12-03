 		<?php
 			$db = new PDO('sqlite:../database/database.db');

 			$userCmd = "SELECT * FROM user WHERE email = '" . $_SESSION["email"] . "'";


			$stmt2 = $db->prepare($userCmd);
			$stmt2->execute();
			$user = $stmt2->fetchAll();

			$photo = $user[0]["photoPath"];
			$profilePath = "../upload/" . $photo;

 		?>

 		<header>

			<div id="logo">
				<img src="../res/images/logo.png">
			</div>

			<h1><a href="../index.php">Crasher</a></h1>

			<form action="../actions/logout.php" id="loutForm">
				<img id="profilePic" src=<?php echo $profilePath; ?> height="50" width="50">
				<a id="user"><?php echo $_SESSION["email"]; ?></a>
    			<input id="lout" type="image" src="../res/images/events/log-out.png" border="0" alt="Submit" />
			</form>

		</header>