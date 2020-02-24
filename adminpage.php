<?php
include 'action.php';
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
        <h3 class="text-center text-primary mt-3">STELL-NEL ADMIN STUDENT INFORMATION SYSTEM</h3>

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
        <form method="post" action="action.php" enctype="multipart/form-data">
          <input type="hidden" name="student_id" value="<?= $student_id; ?>">
          <div class="form-group">
            <input class="form-control" type="text" name="firstName" value="<?= $firstName; ?>" placeholder="Enter First Name" required>
          </div>

          <div class="form-group">
            <input class="form-control" type="text" name="middleName" value="<?= $middleName; ?>" placeholder="Enter Middle Name" required>
          </div>

          <div class="form-group">
            <input class="form-control" type="text" name="lastName" value="<?= $lastName; ?>" placeholder="Enter Last Name" required>
          </div>

          <div class="form-group">
            <input class="form-control" type="date" name="dateOfBirth" value="<?= $dateOfBirth; ?>" required>
          </div>

          <div class="form-group">
            <label>Students Class</label>
            <select name="class">
              <option value="Prnusery">Pre Nursery</option>
              <option value="Nusery 1">Nusery 1</option>
              <option value="Nusery 2">Nusery 2</option>
              <option value="Nusery 3">Nusery 3</option>
              <!--adding the separator-->
              <option value="separator" disabled>--------</option>
              <option value="Primary1">Primary1</option>
              <option value="Primary2">Primary2</option>
              <option value="Primary3">Primary3</option>
              <option value="Primary4">Primary4</option>
              <option value="Primary5">Primary5</option>
              <!--adding the separator-->
              <option value="separator" disabled>--------</option>
              <option value="Jss1">Jss1</option>
              <option value="Jss2">Jss2</option>
              <option value="Jss3">Jss3</option>
              <!--adding the separator-->
              <option value="separator" disabled>--------</option>
              <option value="Ss1">Ss1</option>
              <option value="Ss2">Ss2</option>
              <option value="Ss3">Ss3</option>
            </select>
          </div>

          <div class="form-group">
            <input style="height: 100px;" class="form-control" type="text" name="address" value="<?= $address; ?>" placeholder="Enter Students Address" required>
          </div>

          <div class="form-group">
            <input class="form-control" type="phone" name="phoneNumber" value="<?= $phoneNumber; ?>" placeholder="Enter Phone Number" pattern="0[789][01][0-9]{8}" required>
          </div>

          <div class="form-group">
            <input type="hidden" name="oldimage" value="<?= $passport; ?>">
          </div>
          <div class="form-group">
            <input class="form-control" type="file" name="passport">
            <img src="<?= $passport; ?>" width="200" class="rounded-circle">
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
        $query = "SELECT * from students";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <h3 class="text-center text-info">STELL-NEL Student Records</h3>
        <div class="container">
          <table class="table table-hover table-responsive">
            <thead>
              <tr>
                <th>Image</th>
                <th>FirstName</th>
                <th>MiddleName</th>
                <th>LastName</th>
                <th>DateOfBirth</th>
                <th>Class</th>
                <th>Address</th>
                <th>PhoneNumber</th>
              </tr>
            </thead>
            <tbody>
              <!-- FETCH DATA -->
              <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><img src="<?= $row['Passport']; ?>" width="40" alt=""></td>
                  <td><?= $row['FirstName']; ?></td>
                  <td><?= $row['MiddleName']; ?></td>
                  <td><?= $row['LastName']; ?></td>
                  <td><?= $row['DateOfBirth']; ?></td>
                  <td><?= $row['Class']; ?></td>
                  <td><?= $row['HomeAddress']; ?></td>
                  <td><?= $row['ParentsNumber']; ?></td>

                  <td>
                    <a href="adminpage.php?edit=<?= $row['student_id']; ?>" class="badge badge-success p-2">Edit</a>
                  </td>

                  <td>
                    <a href="action.php?delete=<?= $row['student_id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want to delete this Record?');">Delete</a>
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