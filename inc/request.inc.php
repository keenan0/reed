<?php

if(isset($_POST["reqSubmit"])) {
    session_start();

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $title = $_POST["reqTitle"];
    $request = $_POST["reqMessage"];
    $_SESSION["errorShown"] = false;

    if(emptyRequest($title, $request)){
        header("location: ../pages/main.php?error=reqEmpty");
        exit();
    }

    sendRequest($conn, $_SESSION["userid"], $title, $request);
} else {
    header("location: ../main.php?error=reqNotSubmit");
    exit();
}