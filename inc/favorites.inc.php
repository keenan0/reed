<?php
    require_once "../inc/dbh.inc.php";
    require_once "../inc/functions.inc.php";

    $userId = $_GET["user"];
    $songId = $_GET["song"];
    
    if(favoriteIsNotInDB($conn, $userId, $songId)) {
        echo '<i class="fa-solid fa-heart favorite" id="heart" onclick="updateFavorite('.$userId.','.$songId.')"></i>';
        addFavorite($conn, $userId, $songId);
    } else {
        echo '<i class="fa-regular fa-heart favorite" id="heart" onclick="updateFavorite('.$userId.','.$songId.')"></i>';
        removeFavorite($conn, $userId, $songId);
    }
?>