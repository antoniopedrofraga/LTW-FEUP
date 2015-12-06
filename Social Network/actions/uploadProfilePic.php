<?php
$target_dir = ".." . DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_name = basename($_FILES["fileToUpload"]["name"]);
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
$version = 0;
while (file_exists($target_file)) {
    $target_file = $target_dir . $version . basename($_FILES["fileToUpload"]["name"]);
    $target_name = $version . basename($_FILES["fileToUpload"]["name"]);
    $version++;
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
        try {
        $email = $_POST["email"];
        $db = new PDO('sqlite:../database/database.db');
        $stmt = $db->prepare('UPDATE user SET photoPath = ? WHERE email = ?');
        $stmt->execute(array($target_name, $email));
        echo 'true';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    } else {
        echo "Sorry, there was an error uploading your file. ";
    }
}
?>