<?php
    require_once "../inc/dbh.inc.php";
    require_once "../inc/functions.inc.php";

    $songName = $_GET["songName"];

    $songData = getRelatedSong($conn, $songName);

    if(mysqli_num_rows($songData) > 0){
        while($row = mysqli_fetch_assoc($songData)){
            $album = getAlbumData($conn, $row["albumid"]);

            echo '
            <div class="searchCard">
                <a href="#">
                    <span class="invis">'.$row["id"].'</span>

                    <img class="cover" src="../albums/'.$album["id"].'.jpg"></i>
                    <i class="fa fa-play"></i>
                    
                    <div class="nameAndAlbum">
                        <span class="tit">'.$row["author"] .' - '. $row["name"].'</span>
                        <span class="art">'.$album["name"].'</span>
                    </div>
                </a>
            </div>
            ';
        }
    } else {
        echo '
            <p class="btnNotFound">Nu am gasit rezultate pentru '.$songName.'...</p>
        ';
    }
?>