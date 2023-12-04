<?php
    require_once "../inc/dbh.inc.php";
    require_once "../inc/functions.inc.php";

    $filter= $_GET["filter"];

    $albumWithFilter = getRelatedFilter($conn, $filter);

    if(mysqli_num_rows($albumWithFilter) > 0){
        while($row = mysqli_fetch_assoc($albumWithFilter)){
            $album = getAlbumData($conn, $row["albumid"]);
            
            echo '
            <div class="searchCard">
                <a href="#">
                    <span class="invis">'.$row["id"].'</span>

                    <img class="cover" src="../albums/'.$album["id"].'.jpg"></i>
                    <i class="fa fa-play" onclick="loadContent("content.php")"></i>
                    
                    <div class="nameAndAlbum">
                        <span class="tit">'.$album["author"] .' - '.$row["name"].'</span>
                        <span class="art">'.$album["name"].'</span>
                    </div>
                </a>
            </div>
            ';
        }
    }
?>