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
    		<title>Wired In</title> <!-- Color: #172626 -->
 		</head>

 		<header>

			<div id="logo">
				<img src="../res/images/logo.png">
			</div>

			<h1><a href="../index.php">Wired In</a></h1>

			<form action="../actions/logout.php" id="loutForm">
				<a id="user"><?php echo $_SESSION["email"]; ?></a>
    			<input type="submit" value="Log Out" id="lout">
			</form>

		</header>

		<body>
			<div id="eventfeed">
				<form action="../actions/createEvent.php" id="eventForm" method="post">
					<input type="text" id="eventTextBox" placeholder="Create an event..." autocomplete="off"/>
					<input type="submit" value="Create Event" id="teste">
				</form>
			</div>
		</body>

  		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  		<script type="text/javascript" src="feedScript.js"></script>
		<!--using sweet alert-->
 		<script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

	</html>