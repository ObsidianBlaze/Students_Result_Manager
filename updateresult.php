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
    <title>Admin Update Result</title>
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
                        <figure class="form-group container" style="display: none">
                            <label class="form-label">Student Id (fk)</label>
                            <input class="form-control col-md-3" name="studid" required value="<?= $row['studentId'] ?>" type="number">
                        </figure>
                        <fieldset class="shadow-lg input-group">

                            <figure class="form-group container mt-2" style="display: none">
                                <label class="form-label">Class</label>
                                <input class="form-control-file col-md-8" name="class" required value="<?= $row['Class'] ?>">
                            </figure>
                            <div class="form-group">
                                <input type="hidden" name="oldimage" value="<?= $result; ?>">
                            </div>
                            <figure class="form-group container mt-2">
                                <label class="form-label">Image Result</label>
                                <input class="form-control-file col-md-8" required name="upresult" type="file">
                                <br>
                                <div class="col-md-12">
                                    <img class="col-md-9 shadow-lg" name="class" src="<?= $result ?>" alt="" srcset="">
                                </div>
                            </figure>
                            <figure class="form-group" style="display: flex; padding:10px">
                                <div class="pr-2">
                                    <label>Term</label>
                                </div>
                                <div class="pr-2">
                                    <?php
                                    $resulty = $row['Term'];
                                    "<br>";
                                    $term = substr($resulty, 0, -9);
                                    //  echo $term;

                                    $year = substr($resulty, 4, 9);

                                    ?>
                                    <select name="term">

                                        <option value="<?= $term ?>"><?= $term ?></option>
                                        <optgroup>

                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                        </optgroup>

                                    </select>
                                </div class="pr-2">
                                <div class="pr-2">
                                    <label>Year</label>
                                </div>
                                <div class="pr-2">
                                    <input type="text" list="sessionsyear" class="col-8" name="year" value="<?= $year ?>" required placeholder="2019/2020">
                                    <datalist id="sessionsyear">
                                        <option>2016/2017</option>
                                        <option>2017/2018</option>
                                        <option>2018/2019</option>
                                        <option>2019/2020</option>
                                        <option>2020/2021</option>
                                        <option>2021/2022</option>
                                        <option>2022/2023</option>
                                        <option>2023/2024</option>
                                        <option>2024/2025</option>
                                        <option>2025/2026</option>
                                        <option>2026/2027</option>
                                    </datalist>
                                </div>
                            </figure>
                        </fieldset>
                    </main>

                    <footer class="card-footer">
                        <?php
                        if ($updateresult == true) {
                            echo "<input type='submit' class='btn btn-primary col-md-8' name='updatestudresult'>";
                        } else {
                            echo "<input type='submit' disabled class='btn btn-primary col-md-8' id=''>";
                        }
                        ?>

                    </footer>
                </form>

            </div>
        </div>
    </div>

</body>

</html>