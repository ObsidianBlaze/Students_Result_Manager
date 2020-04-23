<?php include "databaseConnection.php" ?>

<?php
//code to add images to a db.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "passports/";
    $target_file = $target_dir . basename($_FILES["passport"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["passport"]["tmp_name"]);
        if ($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["passport"]["size"] > 600000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file)) {
//            echo "The file " . basename($_FILES["passport"]["name"]) . " has been uploaded.";
//            echo"<span style='color:green'>File added successfully.</span>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//variables to hold the values from the form
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $date = $_POST['dateOfBirth'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $parentsNumber = $_POST['phoneNumber'];
    $passport = $target_file;

    include "insert.php";

}


?>

