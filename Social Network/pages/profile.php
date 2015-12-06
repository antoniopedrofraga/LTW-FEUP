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

if(!isset($_GET["id"])) {
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
    		<link rel="stylesheet" type="text/css" href="../css/profile.css">
    		<link rel="shortcut icon" href="../res/images/logo.png">
    		<title>Crasher</title> <!-- Color: #172626 -->
 		</head>

 		<?php include '../templates/header.php'; 
            $id = $_GET["id"];

            $idCmd = "SELECT * FROM user WHERE id = '" . $id . "'";
            $idStmt = $db->prepare($idCmd);
            $idStmt->execute();
            $idResult = $idStmt->fetchAll();
            
            if(empty($idResult)) {
                header('Location: ../index.php');
                die();
            }

            $user = $idResult[0];
            $photoPath = "../upload/" . $user["photoPath"];
            $userName = $user["firstName"] . " " . $user["lastName"];

            $ownerCmd = "SELECT * FROM owner WHERE email = '" . $user["email"] . "'";
            $ownerStmt = $db->prepare($ownerCmd);
            $ownerStmt->execute();
            $ownerResult = $ownerStmt->fetchAll();

            $ownerCount = count($ownerResult);

            $goingCmd = "SELECT * FROM attendance WHERE email = '" . $user["email"] . "'";
            $goingStmt = $db->prepare($goingCmd);
            $goingStmt->execute();
            $goingResult = $goingStmt->fetchAll();

            $goingCount = count($goingResult);
        ?>

        <body>
            <div id="profile">
                <div id = "profileInfo">
                    <img id="profilePic" src="<?php echo $photoPath; ?>" height="200" width="200" style="object-fit:cover;">
                    <p id="name"><?php echo $userName;?></p>
                    <p id="email">
                        <img id="email-ico" src="../res/images/email.png" height="25" width="25">
                        <a><?php echo $user["email"]; ?></a>
                    </p>
                    <p id="stats">
                        <a class="number"><?php echo $ownerCount; ?></a>
                        <a class="text">hosted events</a>
                        <a class="number"><?php echo $goingCount ?></a>
                        <a class="text">attending events</a>
                    </p>
                </div>

                <div id = "attendedEvents">
                    <p>
                    <a class="title">Attending Events</a>
                    <?php foreach ($goingResult as $attendance) {

                        $eventCmd = "SELECT * FROM event WHERE id = '" . $attendance["eventId"] . "'";
                        $eventStmt = $db->prepare($eventCmd);
                        $eventStmt->execute();
                        $eventResult = $eventStmt->fetchAll();
                        $event = $eventResult[0];

                        $eventPhotoPath = "../upload/" . $event["photoPath"];

                        $location = "event.php?eventId=" . $event["id"];

                        ?>
                        <div class="eventImg" onclick="window.location='<?php echo $location?>'" style="background-image: url(<?php echo $eventPhotoPath ?>); object-fit:cover;">
                            <ul class="dropdown">
                                <li><a href="#"><?php echo $event["name"];?></a></li>
                            </ul>
                        </div>

                    <?php } 

                    if (empty($eventResult)) {
                    ?>
                        <br>
                        <br>
                        <br>
                        <a class="empty">This user has no attended events</a>
                    <?php }
                    ?>
                    </p>
                </div>

                <div id = "hostedEvents">
                    <p>
                    <a class="title">Hosted Events</a>
                    <?php foreach ($ownerResult as $hosted) {

                        $eventCmd = "SELECT * FROM event WHERE id = '" . $hosted["eventId"] . "'";
                        $eventStmt = $db->prepare($eventCmd);
                        $eventStmt->execute();
                        $eventResult = $eventStmt->fetchAll();
                        $event = $eventResult[0];

                        $eventPhotoPath = "../upload/" . $event["photoPath"];

                        $location = "event.php?eventId=" . $event["id"];

                        ?>
                        <div class="eventImg" onclick="window.location='<?php echo $location?>'" style="background-image: url(<?php echo $eventPhotoPath ?>); object-fit:cover;">
                            <ul class="dropdown">
                                <li><a href="#"><?php echo $event["name"];?></a></li>
                            </ul>
                        </div>

                    <?php } 
                    if (empty($ownerResult)) {
                    ?>
                        <br>
                        <br>
                        <br>
                        <a class="empty">This user has no hosted events</a>
                    <?php }

                    ?>
                    </p>
                </div>
            </div>
        </body>

        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <script src="../libs/dropdown.js"></script>
        <script src="profileScript.js"></script>
        <script src="searchScript.js"></script>
        <script src="updatePic.js"></script>
        
        <!--using sweet alert-->
        <script src="../sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="../sweetalert/dist/sweetalert.css">

</html>