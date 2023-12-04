<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "appdb";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Eroare la conectare: " . mysqli_connect_errno());
} else {
    //echo "Conectat la baza de date cu succes.";
}

//!ClR0s0m11OV39@Q la 000webhostapp