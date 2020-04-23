<?php
include 'action.php';
$usernames = $_SESSION["username"];
$passwords = $_SESSION["password"];

//return user to home page if user routes to a page without logging in
if ($passwords == "" && $usernames == "") {
    header('Location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/ttty.png">
    <title>Student Result</title>
</head>
<style>
    #passport {
        width: 50%;
    }

    #cont {
        display: flex;
    }

    @media screen and (max-width:600px) {
        #passport {
            width: 80%;
        }

        #cont {
            flex-wrap: wrap;
        }
    }
</style>

<body>
    <?php
    include "Uiheader.php";
    ?>
    <div class="container-fluid row mt-2">
        <div class="col-md-6 m-auto">
            <aside class="card-header">
                <h3></h3>
            </aside>
            <main class="card-body m-auto shadow">
                <form action="adminrest.php" method="post">
                    <div class="container">
                        <label>Term</label>
                        <select class="col-md-4 p-1" name="studterm">
                            <?php
                            $id = $_GET['viewresult'];
                            $query = "SELECT s.ParentsNumber,r.Term from students s inner join studresult r on s.student_id = r.studentId where studentId = '$id'";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($rowt = $result->fetch_assoc()) {
                            ?>
                                <option value="<?= $rowt['Term'] ?>"><?= $rowt['Term'] ?></option>
                            <?php } else {
                                echo "<option class='form-control btn btn-dark'>No Term Result Is Available</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group container mt-1">
                        <label>Class</label>
                        <select class="col-md-4 p-1" name="studclass">
                            <?php
                            $id = $_GET['viewresult'];
                            $query = "SELECT s.ParentsNumber,r.Class from students s inner join studresult r on s.student_id = r.studentId where studentId = '$id'";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($rowz = $result->fetch_assoc()) {
                            ?>
                                <option value="<?= $rowz['Class'] ?>"><?= $rowz['Class'] ?></option>
                            <?php } else {
                                echo "<option class='form-control btn btn-dark'>No Class Result</option>";
                            } ?>
                        </select>
                        <br>
                        <label style="visibility: hidden">Submi</label>
                        <button type="submit" class="col-md-3 btn btn-primary" name="view">View</button>
                    </div>
                </form>
                <div id="cont">
                    <ul class="mr-5">
                        <li>FullName : <?= $row['FirstName'] ?> <?= $row['MiddleName'] ?> <?= $row['LastName'] ?></li>
                        <li>Class : <?= $row['Class'] ?></li>
                        <li>Home Address : <?= $row['HomeAddress'] ?></li>
                        <li>Phone-Number : <?= $row['ParentsNumber'] ?></li>
                        <li>Term : <?= $row['Term'] ?></li>
                    </ul>
                    <div>
                        <img id="passport" class="mb-5 shadow-lg" src="<?= $row['Passport'] ?>" alt="Student Image" />
                    </div>
                </div>


                <img class="shadow-lg" style="width:85%;" alt="">
            </main>
            <footer class="card-footer shadow-lg">

            </footer>
        </div>
    </div>

</body>

</html>