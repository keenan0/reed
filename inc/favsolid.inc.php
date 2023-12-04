<?php
    require_once "../inc/dbh.inc.php";
    require_once "../inc/functions.inc.php";

    $userId = $_GET["user"];
    $songId = $_GET["song"];
    
    $func = $_GET["func"];

    if(favoriteIsNotInDB($conn, $userId, $songId)) {
        echo '<i class="fa-regular fa-heart favorite" id="heart" onclick="'.$func.')"></i>';
    } else {
        echo '<i class="fa-solid fa-heart favorite" id="heart" onclick="'.$func.')"></i>';
        removeFavorite($conn, $userId, $songId);
    }
?>