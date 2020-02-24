<?php
session_start();
include 'config.php';

$update = false;

$id = "";
$name = "";
$email = "";
$phone = "";
$photo = "";

$student_id = "";
$firstName = "";
$middleName = "";
$lastName = "";
$dateOfBirth = "";
$class = "";
$address = "";
$phoneNumber = "";
$passport = "";


if (isset($_POST['add'])) {
    // $name=$_POST['name'];
    // $email=$_POST['email'];
    // $phone=$_POST['phone'];

    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];

    $passport = $_FILES['passport']['name'];
    $upload = "passports/" . $passport;
    $query = "INSERT INTO students(FirstName,MiddleName,LastName,DateOfBirth,Class,HomeAddress,ParentsNumber,Passport)VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $firstName, $middleName, $lastName, $dateOfBirth, $class, $address, $phoneNumber, $upload);
    $stmt->execute();
    // storage location
    move_uploaded_file($_FILES['passport']['tmp_name'], $upload);
    //alert on homepage
    header('location:adminpage.php');
    $_SESSION['response'] = "Student Record Successfully Inserted to the Database!";
    $_SESSION['res_type'] = "success";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "SELECT Passport FROM students WHERE  student_id=?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row = $result2->fetch_assoc();

    $imagepath = $row['Passport'];
    unlink($imagepath);



    $query = "DELETE from students WHERE student_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    //alert on homepage
    header('location:adminpage.php');
    $_SESSION['response'] = "Successfully Deleted!";
    $_SESSION['res_type'] = "danger";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = "SELECT * FROM students WHERE student_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // $id = $row['id'];
    // $name = $row['name'];
    // $email = $row['email'];
    // $phone = $row['phone'];
    // $photo = $row['photo'];

    $student_id = $row['student_id'];
    $firstName = $row['FirstName'];
    $middleName = $row['MiddleName'];
    $lastName = $row['LastName'];
    $dateOfBirth = $row['DateOfBirth'];
    $class = $row['Class'];
    $address = $row['HomeAddress'];
    $phoneNumber = $row['ParentsNumber'];
    $passport = $row['Passport'];

    $update = true;
}

if (isset($_POST['update'])) {

    $student_id = $_POST['student_id'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];

    // $id = $_POST['id'];
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $phone = $_POST['phone'];

    $oldimage = $_POST['oldimage'];

    if (isset($_FILES['passport']['name']) && ($_FILES['passport']['name'] != "")) {
        $newimage = "passports/" . $_FILES['passport']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['passport']['tmp_name'], $newimage);
    } else {
        $newimage = $oldimage;
    }

    $query = "UPDATE students SET FirstName=?, MiddleName=?, LastName=?,DateOfBirth=?,Class=?,HomeAddress=?,ParentsNumber=?,Passport=? WHERE student_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssi", $firstName, $middleName, $lastName,$dateOfBirth,$class,$address,$phoneNumber, $newimage, $student_id);
    $stmt->execute();

    $_SESSION['response'] = "Updated Successfully";
    $_SESSION['res_type'] = "primary";
    header('location:adminpage.php');
}
