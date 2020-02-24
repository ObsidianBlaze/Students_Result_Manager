<?php
session_start();
$usernames = $_SESSION["username"];
$passwords = $_SESSION["password"];
//echo "Welcome " . "<h1 style='display: inline'>$usernames</h1>" . "<br>";
//return user to home page if user routes to a page without loggin in
if ($passwords == "" && $usernames == "") {
    header('Location:index.php');
}

