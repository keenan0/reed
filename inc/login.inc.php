<?php

if(isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $password = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyFieldsLogin($username, $password)){
        header("location: ../pages/login.php?error=emptyFields");
        exit();
    }

    loginUser($conn, $username, $password);
} else {
    header("location: ../pages/login.php");
    exit();
}