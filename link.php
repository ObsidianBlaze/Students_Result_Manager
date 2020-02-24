<style>
    #links a:hover,#logout{
        text-decoration: none;
    }
    #links a,#logout{
        color: white;
    }
    #links{
        background-color: #3c80ff;
    }
</style>

<div class="container">
    <img src="images/tttyu.png">
    <div class="container" id="links">
        <a href="admin.php" class="btn btn-link">Add Students</a>
        <a href="admin_view.php" class="btn btn-link">View Students</a>
        <a href="addParent.php" class="btn btn-link">Add Parents</a>
        <a href="viewParents.php" class="btn btn-link">View Parents</a>
        <!--adding the log out button-->
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" style="display: inline;">
            <input type="submit" name="logout" id="logout" class="btn btn-link" value="logout">
        </form>
    </div>
</div>
