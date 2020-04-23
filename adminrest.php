<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/ttty.png">

    <style>
    
        #contcenter{
            height: 400px; background:white
        }
        #result{
            width:100%;
            height:140%;
        }
        @media screen and (max-width:580px){
            h4{
                display:none;
            }
            #contcenter{
                height:600px;
            }
        }
      
    </style>
</head>



<body>
    <?php include 'databaseConnection.php';?>
    <br>
    <?php
    if (isset($_POST['view'])) {
        $term = $_POST['studterm'];
        $class = $_POST['studclass'];

        $query = "SELECT s.FirstName,s.MiddleName,s.LastName,s.Passport,r.Term,r.class,r.Result from students s inner join studresult r on s.student_id = r.studentId where r.class = ? and r.Term = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $class, $term);
        $stmt->execute();
        $result = $stmt->get_result();

    ?>
        <div class="container-fluid mx-auto col-md-10 pb-4 shadow mb-5">
            <?php if ($row = $result->fetch_assoc()) { ?>
                <div id="contcenter" class="shadow text-dark">
                    <div id="right" class="p-2">
                        <h4 class=" text-center">Student's Result</h4>
                        <img class="shadow" id="result" src="<?= $row['Result'] ?>">
                    </div>
                </div>
             <br>
            <?php } ?>
        </div>

    <?php } else { ?>
        <h2>
            No result
    </h2>
    <?php } ?>
</body>

</html>