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
    		<title>Event Crasher</title> <!-- Color: #172626 -->
 		</head>

 		<header>

			<div id="logo">
				<img src="../res/images/logo.png">
			</div>

			<h1><a href="../index.php">Event Crasher</a></h1>

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

					<input type="date" id="event-date" placeholder="Event Date">

				</form>

			</div>
		</body>

  		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

  		<script src="../libs/dropdown.js"></script>
  		<script src="feedScript.js"></script>
  		
		<!--using sweet alert-->
 		<script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

	</html>