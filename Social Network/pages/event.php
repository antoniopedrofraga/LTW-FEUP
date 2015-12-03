<?php

session_start();
if(!isset($_SESSION["email"])) {
	if(!isset($_POST["email"])) {
		header('Location: ../index.php');
    	die();
	} else {
		$_SESSION["email"] = $_POST["email"];
	}
}

if(!isset($_GET["eventId"])) {
	header('Location: ../index.php');
    die();
}

?>




<!DOCTYPE html>
	<html>
		<head>
    		<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
    		<link rel="stylesheet" type="text/css" href="../css/event.css">
    		<link rel="shortcut icon" href="../res/images/logo.png">
    		<title>Crasher</title> <!-- Color: #172626 -->
 		</head>
 		<?php include '../templates/header.php'; ?>

		<?php

				$currDate = date('Y-m-d h:i:s', time());

				$eventId = $_GET["eventId"];

				$sqlCmd = "SELECT * FROM event WHERE id = " . $eventId;

				$stmt = $db->prepare($sqlCmd);
				$stmt->execute();
				$result = $stmt->fetchAll();

				$event = $result[0];

				$goingCmd = "SELECT * FROM attendance WHERE email = '" . $_SESSION["email"] . "' AND eventId = " . $event["id"];
				$goingStmt = $db->prepare($goingCmd);
				$goingStmt->execute();
				$goingResult = $goingStmt->fetchAll();

				if (empty($goingResult)) {
						$goStyle = "";
						$dgoStyle = "box-shadow: 0 0 5px 1px #172626;";
				} else {
						$dgoStyle = "";
						$goStyle = "box-shadow: 0 0 5px 1px #172626;";
				}

				switch($event["type"]) {
						case "Party":
						$path = "../res/images/events/party.png";
						break;
						case "Conference":
						$path = "../res/images/events/conference.png";
						break;
						case "Concert":
						$path = "../res/images/events/concert.png";
						break;
						case "Reunion":
						$path = "../res/images/events/reunion.png";
						break;
						default:
						$path = "";
						break;
					}

					$crtDateTime = strtotime($event["createDate"]);
					$crtDate = date('Y/m/d h:i:s', $crtDateTime);

					$diff = abs(strtotime($currDate) - strtotime($crtDate));

					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

					if($years > 0) {
						$timeAgo = "Created ". $years . " years ago";
					} else if ( $months > 0 ) {
						$timeAgo = "Created ". $months . " months ago";
					} else if ( $days > 0 ) {
						$timeAgo = "Created ". $days . " days ago";
					} else {
						$timeAgo = "Created today";
					}

					$eventDateTime = strtotime($event["eventDate"]);
					$eventHour = date('G:i', $eventDateTime);
					$eventDate = date('d/m/Y', $eventDateTime);

					$imagePath = "../upload/" . $event["photoPath"];

					$id = $event["id"];
		?>
		<body>
			<div class="top">

				<div class="eventTitle" id ="<?php echo $id ?>">
					<img class="icon" src=<?php echo $path ?> height="64" width="64">
					<a class = "title"> <?php echo $event["name"]; ?></a>
				</div>

				<div class="background" style="background-image: url(<?php echo $imagePath ?>);">
				</div>

			</div>

			<div class="topmiddle">
				<div class="eventDate">
					<img class="icon" src="../res/images/events/calendar-dark.png" height="24" width="24">
					<a> <?php echo $eventDate; ?> </a>
					<img class="icon" id="watch" src="../res/images/events/clock.png" height="24" width="24">
					<a> <?php echo $eventHour; ?> </a>
				</div>

				<div class="eventAttendance" id=<?php echo $id; ?>>
				<?php 
					if (empty($goingResult)) {
				?>
					<button id="go">Go</button>
					<button id="dgo">Not going</button>
				<?php
					} else {
				?>
					<button id="go">Going</button>
					<button id="dgo">Don't Go</button>

				<?php
					}
				?>
				</div>


			</div>

			<div class="middle">
				<div class="description">
					<img class="icon" src="../res/images/info-dark.png" height="32" width="32">
					<a> <?php echo $event["description"]; ?> </a>
				</div>
			</div>

			<div class="comments">
				<div class="commentText">
					<input type="text" id="commentTextBox" placeholder="New Comment..." autocomplete="off"/>
					<input type="button" id="commentButton" value="Comment"/>
				</div>
				<?php
					
				?>
			</div>

		</body>

		<footer>
    		<div class="title" id="cont">
      			<a href="../index.php"><img src="../res/images/home.png" height="50" width="50"></a>
      			<a target="_blank" href="https://github.com/pedrofraga05/LTW-FEUP/tree/master/Social%20Network"><img src="../res/images/git.png" height="50" width="50"></a>
      			<a href="../about.html"><img src="../res/images/info.png" height="50" width="50"></a>
    		</div>

    		<div class="buttons" id="cont">
      			<a href="../index.php">HOME</a>
      			<a>|</a>
      			<a target="_blank" href="https://github.com/pedrofraga/LTW-FEUP/tree/master/Social%20Network">SOURCE</a>
      			<a>|</a>
      			<a href="../about.html">ABOUT</a>
    		</div>

  		</footer>

  		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  		<script src="../libs/dropdown.js"></script>
  		<script src="eventScript.js"></script>
  		
		<!--using sweet alert-->
 		<script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

</html>