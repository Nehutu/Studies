<?php
$login = $_POST["login"];
$password = $_POST["password"];

$mysqli = mysqli_connect("localhost", "o903578r_study", "Nata2012", "o903578r_study");
if ($mysqli == false) {
    print("Error: Failed to connect to MySQL " . mysqli_connect_error());
} else {
    $email = trim(mb_strtolower($_POST["email"]));
    $pass = trim($_POST["pass"]);

    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
    
    $result = $result->fetch_assoc();

    if (password_verify($pass, $result["password"])) {
        print("success");
        } else {
        print("failure");
        }
    }