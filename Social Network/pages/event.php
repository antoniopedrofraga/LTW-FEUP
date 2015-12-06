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

 		<div id="eventBack">
 		</div>

 		<div id="eventfeed">
 			<h1>Edit</h1>
 			<form action="" class="eventForm" id="submit-edit" method="post" enctype="multipart/form-data">


 				<input type="text" name="name" id="nameTextBox" placeholder="Event Name" autocomplete="off"/>

 				<input type="text" name="description" id="eventTextBox" placeholder="Say something about a new event..." autocomplete="off"/>

 				<div id="type-dd" class="dropdown-div" tabindex="1">
 					<span id="type-span" name="typeSpan">Type</span>
 					<ul class="dropdown">
 						<li><a href="#">Conference</a></li>
						<li><a href="#">Reunion</a></li>
						<li><a href="#">Party</a></li>
						<li><a href="#">Concert</a></li>
						<li><a href="#">Sports</a></li>
						<li><a href="#">Travel</a></li>
 					</ul>
 				</div>

 				<input type="date" class="placeholder" name="date" id="event-date" placeholder="Date:">

 				<br>

 				<input type="time" class="placeholder" name="time" placeholder="Hour:" id="event-hour">

 				<div id="addPhotos" class="add-photos">
 					<img class="icon" src="../res/images/events/add-photo.png" width="20" height="20">
 					<a id="photo-text">Add photo</a>
 				</div>

 				<input multiple="multiple" type="file" name="file-to-upload" id="file-to-upload">

 				<input type="submit" value="Save" name="submit" id="updEvent">

 			</form>
 		</div>

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
						case "Sports":
						$path = "../res/images/events/sports.png";
						break;
						case "Travel":
						$path = "../res/images/events/travel.png";
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
					$type = $event["type"];


					$ownerCmd = "SELECT * FROM owner WHERE eventId = '" . $id . "'";
					$ownerStmt = $db->prepare($ownerCmd);
					$ownerStmt->execute();
					$ownerResult = $ownerStmt->fetchAll();

					$ownerCmd2 = "SELECT * FROM user WHERE email = '" . $ownerResult[0]["email"] . "'";
					$ownerStmt2 = $db->prepare($ownerCmd2);
					$ownerStmt2->execute();
					$owner = $ownerStmt2->fetchAll();

					$ownerName = $owner[0]["firstName"] . " " . $owner[0]["lastName"];

					$ownerLink = "profile.php?id=" . $owner[0]["id"];

		?>
		<body>
			<div class="top">


				<div class="background" style="background-image: url(<?php echo $imagePath ?>);">
					<div class="eventTitle" id ="<?php echo $id ?>">
						<img class="icon" src=<?php echo $path; ?> id=<?php echo $type;?> height="64" width="64">
						<a class = "title"><?php echo $event["name"]; ?></a>
					</div>
				</div>

			</div>

			<div class="topmiddle">
				<div class="eventDate">
					<img class="icon" src="../res/images/events/calendar.png" height="24" width="24">
					<a id="date"><?php echo $eventDate; ?></a>
					<img class="icon" id="watch" src="../res/images/events/clock1.png" height="24" width="24">
					<a id="time"><?php echo $eventHour; ?></a>
				</div>

				<div class="eventAttendance" id=<?php echo $id; ?>>
				<?php 
					if ($owner[0]["email"] == $_SESSION["email"]) {
				?>
					<button id="go">Edit</button>
					<button id="dgo">Delete</button>
				<?php 
					} else if (empty($goingResult)) {
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
				<div class="ownerInfo"> 
					<div class="owner">
						<img class="icon" src="../res/images/events/owner1.png" height="32" width="32">
						<a>Hosted by </a><a href=<?php echo $ownerLink ?> style="color: white"><?php if ($owner[0]["email"] == $_SESSION["email"]) echo "You";	
											else echo $ownerName; ?></a>
					</div>
					<div class="description">
						<img class="icon" src="../res/images/info.png" height="32" width="32">
						<a><?php echo $event["description"]; ?> </a>
					</div>
				</div>
				<div class="attendanceInfo">
				</div>
			</div>

			<div class="comments">
				<div class="commentForm">
					<input type="text" id="commentTextBox" placeholder="New Comment..." autocomplete="off"/>
					<input type="button" id="commentButton" value="Comment"/>
				</div>
				<?php
					$cmtCmd = "SELECT * FROM comment WHERE eventId = '" . $event["id"] . "'";
					$cmtStmt = $db->prepare($cmtCmd);
					$cmtStmt->execute();
					$cmtResult = $cmtStmt->fetchAll();

					foreach($cmtResult as $comment) {

						$userCmd = "SELECT * FROM user WHERE email = '" . $comment["email"] . "'";
						$userStmt = $db->prepare($userCmd);
						$userStmt->execute();
						$userResult = $userStmt->fetchAll();
						$user = $userResult[0];
						$commentPhoto = "../upload/" . $user["photoPath"];

						$userName = $user["firstName"] . " " . $user["lastName"];
				?>
				<div <?php if($user["email"] == $_SESSION["email"] || $owner[0]["email"] == $_SESSION["email"]) { ?>
							class="myComment"
					 <?php } else { ?>
					 		class="comment"
					 <?php }?>>
					<div class="mask">
						<img class="delete" id="<?php echo $comment['id'];?>" src="../res/images/events/delete.png" width="30" heigth="30">
					</div>
					<img class="commentPhoto" src=<?php echo $commentPhoto; ?> height="32" width="32" style="object-fit:cover;">
					<a class="commentUser"><?php echo $userName; ?></a>
					<a class="commentText"><?php echo $comment["commentText"]; ?></a>
				</div>

				<?php
					}

					if(empty($cmtResult)) {
				?>
				<div class="comment" style="text-align:center">
					<a class="commentText" style="color:gray;">No comments to display</a>
				</div>
				<?php
					}
				?>

			</div>

		</body>

  		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  		<script src="../libs/dropdown.js"></script>
  		<script src="eventScript.js"></script>
  		<script src="searchScript.js"></script>
  		<script src="updEventScript.js"></script>
  		<script src="updatePic.js"></script>
  		
		<!--using sweet alert-->
 		<script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

</html>