<!DOCTYPE html>
	<html>
		<head>

    		<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    		<link rel="stylesheet" type="text/css" href="./css/index.css">
    		<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
    		<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    		<link rel="shortcut icon" href="../res/images/logo.png">
    		<title>Wired In</title> <!-- Color: #172626 -->
 		</head>

		<body>
		<h1>Result</h1><br>
		<?php
		session_start();
		if(!isset($_SESSION["email"])) {

			if(isset($_POST["email"])) {
				$_SESSION["email"] = $_POST["email"];
				echo 'session initialized '. $_SESSION["email"];
			} else {
				echo 'dont try to fool me';
			} 

		} else {
			echo 'session already initialized '. $_SESSION["email"];
		} 
		?>
		</br>
		</br>
		</body>
	</html>