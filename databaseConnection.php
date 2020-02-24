<?php

//localhost

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stell_nel";

//online host
/*
$servername = "localhost";
$username = "stellnel_admin";
$password = "Osaigbovo";
$dbname = "stellnel_stell_nel";
*/

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



