<?php
session_start();
include 'databaseConnection.php';

$update = false;

$user = "";
$pass = "";
$parentID = "";


if (isset($_POST['add'])) {

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "INSERT INTO parents(ParentsNumber, password)VALUES(?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    //alert on homepage
    header('location:parentview.php');
    $_SESSION['response'] = "Parent Record Successfully Inserted to the Database!";
    $_SESSION['res_type'] = "success";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "SELECT password FROM parents WHERE  parentID=?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row = $result2->fetch_assoc();

    $query = "DELETE from parents WHERE parentID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    //alert on homepage
    header('location:parentview.php');
    $_SESSION['response'] = "Successfully Deleted!";
    $_SESSION['res_type'] = "danger";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = "SELECT * FROM parents WHERE parentID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $parentID = $row['parentID'];
    $user = $row['ParentsNumber'];
    $pass = $row['password'];
    $update = true;
}

if (isset($_POST['update'])) {

    $parentID = $_POST['parentID'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "UPDATE parents SET ParentsNumber=?, password=? WHERE parentID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $user, $pass, $parentID);
    $stmt->execute();

    $_SESSION['response'] = "Updated Successfully";
    $_SESSION['res_type'] = "primary";
    header('location:parentview.php');
}
