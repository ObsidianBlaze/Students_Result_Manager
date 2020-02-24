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
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button> -->

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="parent.php">View Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">View Result</a>
                </li>
            </ul>
        </div>

        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" style="display: inline;">
            <input type="submit" name="logout" id="logout" class="btn btn-primary" value="logout">
        </form>
        <?php require "logout.php" ?>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center mt-3" style="color:aqua;">STUDENTS INFORMATION</h3>

                <hr style="background-color:white;">
            </div>

        </div>
        <!--  -->

        <?php require "databaseConnection.php" ?>
        <div class="div col-md-8">
            <!-- FATCH DATA -->
            <?php
            $query = "SELECT * from students where ParentsNumber = '$usernames'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <div class="container-fluid">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <img class="rounded-circle" src="<?= $row['Passport']; ?>" height='150' width='150' alt="">
                    <div style="position:relative; left:200px; bottom:110px;">
                        <div>
                            <?= $row['FirstName']; ?>
                            <?= $row['MiddleName']; ?>
                            <?= $row['LastName']; ?>
                        </div>
                        <div>
                            <?= $row['DateOfBirth']; ?>
                        </div>
                        <div>
                            <?= $row['Class']; ?>
                        </div>
                        <div>
                            <?= $row['HomeAddress']; ?>
                        </div>
                        <div>
                            <?= $row['ParentsNumber']; ?>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>