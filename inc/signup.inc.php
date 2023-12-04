<?php 

if(isset($_POST["submit"])){ 
    $username = $_POST["uid"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwdrepeat"];

    require_once "../inc/dbh.inc.php";
    require_once "../inc/functions.inc.php";

    if(emptyFieldsSignup($username, $email, $password, $passwordRepeat) !== false) { 
        header("location: ../pages/signup.php?error=emptyFields");
        exit();
    }
    if(invalidUid($username) !== false) { 
        header("location: ../pages/signup.php?error=invalidUid");
        exit();
    }
    if(invalidEmail($email) !== false) { 
        header("location: ../pages/signup.php?error=invalidEmail");
        exit();
    }
    if(invalidPassword($password, $passwordRepeat) !== false) { 
        header("location: ../pages/signup.php?error=passwordNotMatch");
        exit();
    }
    if(userExists($conn, $username, $email) !== false) { 
        header("location: ../pages/signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $username, $email, $password, $passwordRepeat);
} else {
    header("location: ../pages/signup.php");
}