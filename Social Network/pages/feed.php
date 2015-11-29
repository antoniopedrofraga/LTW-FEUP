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
    		<link rel="stylesheet" type="text/css" href="../css/feed.css">
    		<link rel="shortcut icon" href="../res/images/logo.png">
    		<title>Crasher</title> <!-- Color: #172626 -->
 		</head>

 		<header>

			<div id="logo">
				<img src="../res/images/logo.png">
			</div>

			<h1><a href="../index.php">Crasher</a></h1>

			<form action="../actions/logout.php" id="loutForm">
				<a id="user"><?php echo $_SESSION["email"]; ?></a>
    			<input type="submit" value="Log Out" id="lout">
			</form>

		</header>

		<body>
			<div id="eventfeed">
				<form action="../actions/createEvent.php" id="eventForm" method="post">
					<input type="text" id="eventTextBox" placeholder="Say something about the new event..." autocomplete="off"/>
					<input type="submit" value="Create" id="crtEvent">
					
					<div id="privacy-dd" class="dropdown-div" tabindex="1">
						<span>Public</span>
						<ul class="dropdown">
							<li><a href="#">Private</a></li>
							<li><a href="#">Public</a></li>
						</ul>
					</div>

					<div id="type-dd" class="dropdown-div" tabindex="1">
						<span>Type</span>
						<ul class="dropdown">
							<li><a href="#">Conference</a></li>
							<li><a href="#">Party</a></li>
							<li><a href="#">Reunion</a></li>
							<li><a href="#">Concert</a></li>
							<li><a href="#">Other</a></li>
						</ul>
					</div>

					<input type="date" id="event-date" placeholder="Date:">

				</form>
			</div>

			<?php
				$db = new PDO('sqlite:../database/database.db');
				$stmt = $db->prepare('SELECT * FROM event');
				$stmt->execute();  
				$result = $stmt->fetchAll();

  
				foreach( $result as $row) {

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
					$currDate = date('Y/m/d h:i:s', time());

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
					$eventHour = date('h:i', $eventDateTime);
					$eventDate = date('d/m/Y', $eventDateTime);

			?>
			<div class="event">
				<p><img class="icon" src=<?php echo $path ?> height="64" width="64">
				<a class="eventType"> <?php echo $row["type"]; ?> </a>
				<a class="createdTime"> <?php echo $timeAgo; ?> </a> </p>
				<br>
				<div class="eventDate">
					<img class="icon" src="../res/images/events/calendar.png" height="24" width="24">
					<a> <?php echo $eventDate; ?> </a>
					<img class="icon" src="../res/images/events/clock.png" height="24" width="24">
					<a> <?php echo $eventHour; ?> </a>
				</div>
				<br>
				<div class="description">
					<img class="icon" src="../res/images/info.png" height="32" width="32">
					<a> <?php echo $row["description"]; ?> </a>
				</div>
				<br>
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

  		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

  		<script src="../libs/dropdown.js"></script>
  		<script src="feedScript.js"></script>
  		
		<!--using sweet alert-->
 		<script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

	</html>