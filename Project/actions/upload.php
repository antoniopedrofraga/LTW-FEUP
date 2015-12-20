<?php

if(!isset($_FILES["fileToUpload"]["name"])) {
  header('Location: ../index.php');
    die();
}

$target_dir = ".." . DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$repeated = 0;
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
    $target_file = $target_dir . "v2" . basename($_FILES["fileToUpload"]["name"]);
    $repeated = 1;
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

	$date = $_POST["eventDate"];
    $time = $_POST["eventTime"];
    $finalDate = $date . " " . $time;
	$currDate = date('Y/m/d G:i:s', time());

	$diff = strtotime($finalDate) - strtotime($currDate);

	if($diff < 0) {
    		echo "Please create an event with an upcoming date... " . $diff;
    		return;
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        if($repeated == 0) echo "true";
        else echo "repeated";
    } else {
        echo "Sorry, there was an error uploading your file. ";
    }
}
?>
