<?php
// Start the session
session_start();
?>
<?php require "header.php" ?>
<style>
    a:hover {
        text-decoration: none;
    }
    input[type= text]:focus, input[type = password]:focus{
        background-color: lightblue;
    }
</style>

<body>
    <div class="container">

        <div class="d-flex justify-content-center h-100">

            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="username" name="username" required>

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="password" name="password" required>
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group" style="padding-top: 50px;">
                            <input type="submit" name="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                    <a id="back" href="http://stell-nel.com" style="font-size:80px;"></a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <?php
    if (isset($_POST["submit"])) {
        include "databaseConnection.php";
        //Checking for parents info
        $sql = $conn->prepare("SELECT ParentsNumber, password FROM parents where ParentsNumber = ? AND password = ? ");
        $sql->bind_param("ss", $_POST['username'], $_POST['password']);
        $sql->execute();
        $sql->store_result();
        $sql->bind_result($UserName, $Password);
        if ($sql->fetch()) {
            // Set session variables for parents
            $_SESSION["username"] = $_POST['username'];
            $_SESSION["password"] = $_POST['password'];
            header('Location:parent.php');
        } else {
            //If username and or password is wrong
            echo "<style>
                    input[type=text],input[type=password]{
                        border: 2px solid red;
                        border-radius: 1px;                      
                    }
                </style>";
            echo "<span style='position: absolute; bottom:150px; color: yellow;'>Wrong UserName / Password</span>";
        }
        $sql->close();
        $conn->close();

        include "databaseConnection.php";
        //Checking for admin info
        $sql2 = $conn->prepare("SELECT admin_name, admin_password FROM admin where admin_name = ? AND admin_password = ? ");
        $sql2->bind_param("ss", $_POST['username'], $_POST['password']);
        $sql2->execute();
        $sql2->store_result();
        $sql2->bind_result($Admin_UserName, $Admin_Password);
        if ($sql2->fetch()) {
            // Set session variables for parents
            $_SESSION["username"] = $_POST['username'];
            $_SESSION["password"] = $_POST['password'];
            //Routing to the admin page.
            header('Location:adminpage.php');
            //        echo "TrueAdmin";
        }
        $sql2->close();
        $conn->close();
    }
    ?>

</body>

</html>