<?php
require "session.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parent Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/ttty.png">
    <style>
        td,
        tr,
        th {
            color: white;
            font-size: 15px;
        }

        body {
            color: white;
            background-image: url("images/abs.png");
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <img src="images/tttyu.png">

        <a class="navbar-brand" href="#">STELL-NEL INFORMATION SYSTEM</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <a class="nav-link" href="parent.php">View Info</a>
      <a class="nav-link" href="result.php">View Result</a>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" style="display: inline;">
                <input type="submit" name="logout" id="logout" class="btn btn-primary" value="logout">
      </form>

    </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="parent.php">View Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="result.php">View Result</a>
                </li>
                
            </ul>
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" style="display: inline;">
                <input style="margin-left: 800%;" type="submit" name="logout" id="logout" class="btn btn-primary" value="logout">
            </form>
        </div>

        <?php require "logout.php" ?>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center mt-3" style="color:aqua;">STUDENTS RESULT</h3>

                <hr style="background-color:white;">
            </div>

        </div>
        <!--  -->

        <?php require "databaseConnection.php" ?>
        <div class="div col-md-8 mx-auto">
            <!-- search data -->
            <form action="resultcon.php" method="post">
                <div class="container">
                    <label>Term</label>
                    <select class="col-md-4 p-1" name="studterm">
                        <?php
                        $query = "SELECT s.MiddleName,s.ParentsNumber,r.Term from students s inner join studresult r on s.student_id = r.studentId where ParentsNumber = '$usernames'";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        while($row = $result->fetch_assoc()){
                            if ($row >= 1) {
                            ?>
                                <option value="<?= $row['Term'] ?>"> <?= $row['Term'] ?> <?= $row['MiddleName']?></option>
                            <?php } else {
                                echo "<option class='form-control btn btn-dark'>No Term Result Is Available</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group container mt-1">
                    <label>Class</label>
                    <select class="col-md-4 p-1" name="studclass">
                        <?php
                        $query = "SELECT s.MiddleName,s.ParentsNumber,r.Class from students s inner join studresult r on s.student_id = r.studentId where ParentsNumber = '$usernames'";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                            if ($row >= 1) {
                            ?>
                                <option value="<?= $row['Class'] ?>"><?= $row['Class'] ?> <?= $row['MiddleName']?> </option>
                            <?php } else {
                                echo "<option class='form-control btn btn-dark'>No Class Result</option>";
                                }
                         }?>
                    </select>
                    <br>
                    <label style="visibility: hidden">Submi</label>
                    <button type="submit" class="col-md-3 btn btn-primary" name="viewresult">View</button>
                </div>
               
            </form>
            <!-- FATCH DATA -->
                <div>
                    <a href="parent.php">
                    <button class="btn btn-primary"><=Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>