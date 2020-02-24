<?php
//online
// $servername = "localhost";
// $username = "stellnel_admin";
// $password = "Osaigbovo";
// $dbname = "stellnel_stell_nel";

//localhost.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stell_nel";

// using object oriented language 
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
  die("Could not connect to the database!".$conn->connect_error);
}
