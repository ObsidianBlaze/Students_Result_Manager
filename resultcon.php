<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/ttty.png">

    <style>
        #right {
            float: right;
        }

        @media screen and (max-width:650px) {
            #right {
                float: none;
            }
        }

        #contcenter {
            height: 400px;
            background: white
        }

        #result {
            width: 100%;
            height: 140%;
        }

        @media screen and (max-width:580px) {
            h4 {
                display: block;
            }

            #contcenter {
                height: 600px;
            }
        }
    </style>
</head>



<body>
    <?php include 'result.php' ?>
    <br>
    <?php
    if (isset($_POST['viewresult'])) {
        $term = $_POST['studterm'];
        $class = $_POST['studclass'];
//Selecting the childs result using a join.
        $query = "SELECT s.FirstName,s.MiddleName,s.LastName,s.Passport,r.Term,r.class,r.Result from students s inner join studresult r on s.student_id = r.studentId where r.class = ? and r.Term = ? and ParentsNumber = '$usernames'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $class, $term);
        $stmt->execute();
        $result = $stmt->get_result();

    ?>
        <div class="container">
            <div >
                <?php //Using a while loop to display the result of all the siblings. ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <?php if($row > 1){?>
                    <div class="card m-auto col-md-10 bg-light text-dark">
                        <aside class="card-header alert-primary">
                            <ul style="float:right">
                                <li><span>FullName</span> - <?= $row['FirstName']; ?> <?= $row['MiddleName']; ?> <?= $row['LastName']; ?></li>
                                <li><span>Term</span> - <?= $row['Term']; ?></li>
                                <li><span>Class</span> - <?= $row['class']; ?></li>
                            </ul>
                            <figure style="float: left">
                                <img class="rounded-circle shadow" src="<?= $row['Passport']; ?>" height='150' width='150' alt="">
                            </figure>
                        </aside>
                        <main class="card-body">
						<a href="<?= $row['Result'] ?>" download>
                            <h4 class=" text-center">Download Student's Result</h4>
						</a>
                            <!--<img class="shadow" id="result" src="<?//= $row['Result'] ?>">-->
                        </main>
                    </div>
                <?php }?>
                <?php } ?>
            </div>
        </div>

    <?php } else { ?>
        <div class="m-auto col-md-10">
            <h3 class="text">No result</h3>
        </div>
    <?php } ?>


</body>

</html>