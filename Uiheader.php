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
</body>