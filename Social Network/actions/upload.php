<?php
$target_dir = "C:\Users\Pedro\Documents\GitHub\LTW-FEUP\Social Network\upload" . DIRECTORY_SEPARATOR;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image. ";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists. ";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 1048576 * 5) {
    echo "Your file should not be bigger than 5 MB. ";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
    $uploadOk = 0;
}

if ($uploadOk == 0) {

    echo "Sorry, your file was not uploaded.";

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	$name = $_POST["eventName"];
    	$desc = $_POST["eventDescription"];
    	$privacy = $_POST["eventPrivacy"];
    	$type = $_POST["eventType"];
    	$date = $_POST["eventDate"];
    	$time = $_POST["eventTime"];
    	$finalDate = $date . " " . $time;
    	$photoPath = basename($_FILES["fileToUpload"]["name"]);
    	$currDate = date('Y/m/d h:i:s', time());
        
        try {
        	$db = new PDO('sqlite:../database/database.db');
  			$stmt = $db->prepare('INSERT INTO event (name, description, type, photoPath, eventDate, createDate) VALUES (?, ?, ?, ?, ?, ?)');
  			$stmt->execute(array($name, $desc, $type, $photoPath, $finalDate, $currDate));
  			echo 'true';
		} catch (PDOException $e) {
  			die;
		}
    } else {
        echo "Sorry, there was an error uploading your file. ";
    }
}
?>