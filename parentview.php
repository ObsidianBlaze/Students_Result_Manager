<?php
include 'actions.php';
$usernames = $_SESSION["username"];
$passwords = $_SESSION["password"];

//return user to home page if user routes to a page without logging in
if ($passwords == "" && $usernames == "") {
    header('Location:index.php');
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/ttty.png">

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
                    <a class="nav-link" href="adminpage.php">Students Information</a>
                    <a class="nav-link" href="parentview.php">Parents Information</a>
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
                <h3 class="text-center text-primary mt-3">STELL-NEL ADMIN PARENT INFORMATION SYSTEM</h3>

                <hr>
                <!-- Alert Message and the res_type change if it success or danger -->
                <?php if (isset($_SESSION['response'])) { ?>
                    <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION['response']; ?></b>
                    </div>
                <?php }
                unset($_SESSION['response']); ?>
            </div>
        </div>
        <!--  -->
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-center text-info ">Add Records</h3>
                <form method="post" action="actions.php" enctype="multipart/form-data">
                    <input type="hidden" name="parentID" value="<?= $parentID; ?>">
                    <div class="form-group">
                        <input class="form-control" type="text" name="user" value="<?= $user; ?>" placeholder="Enter Username" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" name="pass" value="<?= $pass; ?>" placeholder="Enter Password" required>
                    </div>

                    <div class="form-group">
                        <?php if ($update == true) { ?>
                            <input type="submit" class="btn btn-success btn-block" name="update" value="Update Record">
                        <?php } else { ?>
                            <input type="submit" class="btn btn-primary btn-block" name="add" value="Add Record">
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="div col-md-8">
                <!-- FATCH DATA -->
                <?php
                $query = "SELECT * from parents";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
                <h3 class="text-center text-info">STELL-NEL PARENTS Records</h3>
                <div class="container">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- FETCH DATA -->
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['ParentsNumber']; ?></td>
                                    <td><?= $row['password']; ?></td>
                                    <td>
                                        <a href="parentview.php?edit=<?= $row['parentID']; ?>" class="badge badge-success p-2">Edit</a>
                                    </td>

                                    <td>
                                        <a href="actions.php?delete=<?= $row['parentID']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want to delete this Record?');">Delete</a>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>