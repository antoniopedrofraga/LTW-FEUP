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

?>


<!DOCTYPE html>
	<html>
		<head>
    		<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
    		<link rel="stylesheet" type="text/css" href="../css/feed.css">
    		<link rel="shortcut icon" href="../res/images/logo.png">
    		<title>Crasher</title> <!-- Color: #172626 -->
 		</head>

 		<?php include '../templates/header.php'; ?>

		<body>
			<div id="eventfeed">
				<form action="" class="eventForm" id="submit-upload" method="post" enctype="multipart/form-data">

					<input type="text" name="name" id="nameTextBox" placeholder="Event Name" autocomplete="off"/>

					<input type="text" name="description" id="eventTextBox" placeholder="Say something about a new event..." autocomplete="off"/>
					
					<div id="privacy-dd" class="dropdown-div" tabindex="1">
						<span id="privacy-span" name="privacySpan" >Public</span>
						<ul class="dropdown">
							<li><a href="#">Private</a></li>
							<li><a href="#">Public</a></li>
						</ul>
					</div>

					<div id="type-dd" class="dropdown-div" tabindex="1">
						<span id="type-span" name="typeSpan">Type</span>
						<ul class="dropdown">
							<li><a href="#">Conference</a></li>
							<li><a href="#">Party</a></li>
							<li><a href="#">Reunion</a></li>
							<li><a href="#">Concert</a></li>
						</ul>
					</div>

					<input type="date" class="placeholder" name="date" id="event-date" placeholder="Date:">
					
					<br>

					<input type="time" class="placeholder" name="time" placeholder="Hour:" id="event-hour">

					<div id="add-photos" class="add-photos">
							<img class="icon" src="../res/images/events/add-photo.png" width="20" height="20">
							<a id="photo-text">Add photo</a>
					</div>

					<input type="file" name="file-to-upload" id="file-to-upload">

					<input type="submit" value="Create" name="submit" id="crtEvent">

				</form>
			</div>

			<?php


				$currDate = date('Y-m-d h:i:s', time());

				$sqlCmd = "SELECT * FROM event WHERE eventDate > '" . $currDate . "' ORDER BY eventDate ASC";


				$stmt = $db->prepare($sqlCmd);
				$stmt->execute();  
				$result = $stmt->fetchAll();

  
				foreach( $result as $row) {

					$goingCmd = "SELECT * FROM attendance WHERE email = '" . $_SESSION["email"] . "' AND eventId = " . $row["id"];
					$goingStmt = $db->prepare($goingCmd);
					$goingStmt->execute();
					$goingResult = $goingStmt->fetchAll();

					if (empty($goingResult)) {
						$goValue = "Go";
					} else {
						$goValue = "Don't Go";
					}

					switch($row["type"]) {
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

					$crtDateTime = strtotime($row["createDate"]);
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

					$eventDateTime = strtotime($row["eventDate"]);
					$eventHour = date('G:i', $eventDateTime);
					$eventDate = date('d/m/Y', $eventDateTime);

					$imagePath = "../upload/" . $row["photoPath"];

					$id = $row["id"];

					$action = "../pages/event.php?EventId=" . $id;

			?>

			<div class="event" id ="<?php echo $id ?>">
					<form action = "../pages/event.php" class="background" style="background-image: url(<?php echo $imagePath ?>);">
                        <button type="submit" class="details" name="eventId" value="<?php echo $id ?>">More Details</button>
						<input type="button" class="going" value="<?php echo $goValue ?>">
					</form>

					<p><img class="icon" src=<?php echo $path ?> height="64" width="64">
					<a class="eventType"> <?php echo $row["type"]; ?> </a>
					<a class="createdTime"> <?php echo $timeAgo; ?> </a> </p>
					<br>
					<div class="eventDate">
						<img class="icon" src="../res/images/events/calendar-dark.png" height="24" width="24">
						<a> <?php echo $eventDate; ?> </a>
						<img class="icon" src="../res/images/events/clock.png" height="24" width="24">
						<a> <?php echo $eventHour; ?> </a>
					</div>
					<h1 class = "eventTitle"> <?php echo $row["name"]; ?></h1>
					<br>
					<div class="description">
						<img class="icon" src="../res/images/info-dark.png" height="32" width="32">
						<a> <?php echo $row["description"]; ?> </a>
					</div>
					<?php 
						if (empty($goingResult)) {
							?><h1 class = "status">Not Going</h1><?php
						} else {
							?><h1 class = "status">Going</h1><?php
						}

					?>
			</div>

			<?php } ?>

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
  		<script src="feedScript.js"></script>
  		<script src="searchScript.js"></script>
  		<script src="crtEventScript.js"></script>
  		
		<!--using sweet alert-->
 		<script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

	</html>
