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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/ttty.png">
    <title>Student Result</title>
</head>

<body>
    <?php
         include "Uiheader.php";
    ?>
    <div class="container-fluid row mt-2">
        <div class="col-md-7 m-auto">
            <div class="card shadow mb-5">
                <aside class="card-header">
                    <h3 class="text-center">Add Student Result</h3>
                </aside>
                <form action="action.php" enctype="multipart/form-data" method="post">
                        <main class="card-body">
                            <figure class="form-group container" style="display: none" >
                                <label class="form-label">Student Id (fk)</label>
                                <input class="form-control col-md-3"  name="stdresid" required value="<?=$row['student_id']?>" type="number">
                            </figure>
                                <fieldset class="shadow-lg input-group">
                                    
                                    <figure class="form-group container mt-2" style="display: none">
                                        <label class="form-label">Class</label>
                                        <input class="form-control-file col-md-8" required name="class" value="<?=$row['Class']?>">
                                    </figure>

                                    <figure class="form-group container mt-2">
                                        <label class="form-label">Image Result</label>
                                        <input class="form-control-file col-md-8" required name="upload" type="file">
                                    </figure>
                                    <figure class="form-group" style="display: flex; padding:10px">
                                        <div class="pr-2">
                                            <label>Term</label>
                                        </div>
                                        <div class="pr-2" >
                                            <select name="term">
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                                <option value="3rd">3rd</option>
                                            </select>
                                        </div class="pr-2">
                                        <div class="pr-2">
                                            <label>Year</label>
                                        </div>
                                        <div class="pr-2" >
                                            <select name="year">
                                                <option value="2016/2017">2016/2017</option>
                                                <option value="2017/2018">2017/2018</option>
                                                <option value="2018/2019">2018/2019</option>
                                                <option value="2019/2020">2019/2020</option>
                                                <option value="2020/2021">2020/2021</option>
                                                <option value="2021/2022">2021/2022</option>
                                                <option value="2022/2023">2022/2023</option>
                                                <option value="2023/2024">2023/2024</option>
                                                <option value="2024/2025">2024/2025</option>
                                                <option value="2025/2026">2025/2026</option>
                                                <option value="2026/2027">2026/2027</option>
                                                <option value="2027/2028">2027/2028</option>
                                                <option value="2028/2029">2028/2029</option>
                                                <option value="2029/2030">2029/2030</option>
                                            </select>
                                        </div>
                                    </figure>
                                </fieldset>
                        </main>
                      
                    <footer class="card-footer">
                            <?php
                                if($studrecords == true){
                                   echo"<a class='btn btn-primary' href='adminpage.php'> back</a><input type='submit' class='btn btn-primary col-md-8' name='addresult' style='margin-left:50px'> ";
                                }else{
                                    echo"<a class='btn btn-primary' href='adminpage.php'> back</a><input type='submit' disabled class='btn btn-primary col-md-8' id=''style='margin-left:50px>";
                                }
                            ?>

                    </footer>
                </form>

            </div>
        </div>
    </div>
</body>

</html>