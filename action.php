<?php
session_start();
include 'config.php';

$update = false;
$studrecords = false;
$updateResult = false;

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
$resultstud = false;


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

    $query3 = "DELETE from studresult WHERE studentId=?";
    $stmt3 = $conn->prepare($query3);
    $stmt3->bind_param("i", $id);
    $stmt3->execute();

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
    $stmt->bind_param("ssssssssi", $firstName, $middleName, $lastName, $dateOfBirth, $class, $address, $phoneNumber, $newimage, $student_id);
    $stmt->execute();

    $_SESSION['response'] = "Updated Successfully";
    $_SESSION['res_type'] = "primary";
    header('location:adminpage.php');
}
// RETURN STUDENT DATA FOR RESULT INSERTION 

if (isset($_GET['result'])) {
    $query = "SELECT student_id, Class from students where student_id = ?";
    $id = $_GET['result'];

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result();
    $row = $data->fetch_assoc();

    $student_id = $row['student_id'];
    $student_id = $row['Class'];

    $studrecords = true;
}

//returning student result

if (isset($_GET['viewresult'])) {
    $query = "SELECT s.FirstName,s.MiddleName,s.LastName,s.Class, s.HomeAddress,s.ParentsNumber,s.Passport,r.Term, r.Result from students s inner join studresult r on s.student_id = r.studentId where studentId = ?";
    $id = $_GET['viewresult'];

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $studresult = $stmt->get_result();
    $row = $studresult->fetch_assoc();

    $firstname = $row['FirstName'];
    $middleName = $row['MiddleName'];
    $LastName = $row['LastName'];
    $Class = $row['Class'];
    $HomeAddress = $row['HomeAddress'];
    $ParentsNumber = $row['ParentsNumber'];
    $Passport = $row['Passport'];

    $Result = $row['Result'];
    $Term = $row['Term'];

    $resultstud = true;
}

//adding data of student result record

if (isset($_POST['addresult'])) {

    $studid = $_POST['stdresid'];
    $term = $_POST['term'] . " " . $_POST['year'];
    $class = $_POST['class'];
    $upload = $_FILES['upload']['name'];
    $result = "passports/result/" . $upload;


    $queryexist = "SELECT count(studentId) as id FROM studresult WHERE Term = '$term' AND Class = '$class' ";
    $rowCount = $conn->query($queryexist);
    $totrowcount = mysqli_fetch_assoc($rowCount);
    //Tweaking the sql code to ensure that the information enters the database.
    $tr = 999;
    echo $totrowcount['id'];

    if ($tr > 1) {
        $query = "INSERT INTO studresult(Term,Class,Result,studentId) VALUES(?,?,?,?)";
        $stmtresult = $conn->prepare($query);
        $stmtresult->bind_param("sssi", $term, $class, $result, $studid);
        if ($stmtresult->execute()) {
            move_uploaded_file($_FILES['upload']['tmp_name'], $result);

            header('location:adminpage.php');
            $_SESSION['response'] = "Student Result Has Been Added Successfully";
            $_SESSION['res_type'] = "success";
        } else {
            header('location:adminpage.php');
            $_SESSION['response'] = "Student Result Insertion Failed";
            $_SESSION['res_type'] = "danger";
        }
    } else {
        header('location:adminpage.php');
        $_SESSION['response'] = "Student Result Already Exist";
        $_SESSION['res_type'] = "danger";
    }
}
// getting student data to update 

if (isset($_GET['updateresult'])) {
    $id = $_GET['updateresult'];

    $query = "SELECT studentId,Term,Class,Result FROM studresult WHERE studentId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id = $row['studentId'];
    $term = $row['Term'];
    $class = $row['Class'];
    $result = $row['Result'];


    $updateresult = true;
}
//update result 

if (isset($_POST['updatestudresult'])) {

    $id = $_POST['studid'];

    $class = $_POST['class'];
    $term = $_POST['term'] . " " . $_POST['year'];
    $upload = $_FILES['upresult']['name'];
    $result = "passports/result/" . $upload;
    $oldimage = $_POST['oldimage'];

    if (isset($_FILES['upresult']['name']) && ($_FILES['upresult']['name'] != "")) {
        $newimage = "passports/result/" . $upload;
        unlink($oldimage);
        move_uploaded_file($_FILES['upresult']['tmp_name'], $newimage);


        $query = "UPDATE studresult SET Term=?,Class=?,Result=? WHERE studentId=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $term, $class,  $newimage, $id);
        if (file_exists($newimage)) {
            
            $stmt->execute();
            // move_uploaded_file($_FILES['upresult']['tmp_name'], $newimage);
            $_SESSION['response'] = "Updated Result Successfully";
            $_SESSION['res_type'] = "primary";
            header('location:adminpage.php');
        }else{
            $_SESSION['response'] = "Image Does not exist in folder error";
            $_SESSION['res_type'] = "danger";
            header('location:adminpage.php');
        }
    } else {
        $newimage = $oldimage;

        
        $query = "UPDATE studresult SET Term=?,Class=?,Result=? WHERE studentId=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $term, $class,  $newimage, $id);
        if($stmt->execute() && isset($_FILES['upresult']['name']) && ($_FILES['upresult']['name'] != "")){
            move_uploaded_file($_FILES['upresult']['tmp_name'], $newimage);

            $_SESSION['response'] = "Error In Result Update";
            $_SESSION['res_type'] = "danger";
            header('location:adminpage.php');
        }
    }
}
