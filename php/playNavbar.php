<?php
    if(isset($_SESSION["username"])){
        $userId = $_SESSION["userid"];
        //$songId = getSongId($conn, "YOSEMITE");
        $songId = "1";
        //$currentMenu = $_GET["biblioteca"];

        echo '<!--Imaginea pentru melodia selectata-->
        <img src="../albums/1.jpg" alt="activeSongImage" id="activeSongImage">
        <h1 id="playTitle">YOSEMITE</h1>
        <p id="playAuthor">Travis Scott</p>
        <div id="heart">
        ';
        
        if(favoriteIsNotInDB($conn, $userId, $songId)){
            echo '
            <i class="fa-regular fa-heart favorite" id="heart" onclick="updateFavorite('.$userId.','.$songId.')"></i>
            ';
            // if(isset($currentMenu)){
            //     echo '<script>loadContent("library.php");</script>';
            // }
        } else {
            echo '
            <i class="fa-solid fa-heart favorite" id="heart" onclick="updateFavorite('.$userId.','.$songId.')"></i>
            ';
        }

        echo '
        </div>
        <!--Meniu audio pentru melodie-->
        <audio id="playbar" autostart="false">
            <source id="sourceSong" src="#" type="audio/mpeg">
        </audio>
        <div class="controls">
            <div class="fa-play-wrap fa-prev" onclick="prevSong()">
                <i class="fa fa-backward fa-lg" id="audioPreviousButton"></i>
            </div>
            <div class="fa-play-wrap" onclick="hitBtn()">
                <i class="fa fa-play fa-lg" id="audioPlayButton"></i>
            </div>
            <div class="fa-play-wrap fa-next" onclick="nextSong()">
                <i class="fa fa-forward fa-lg" id="audioNextButton"></i>
            </div>
            <!-- 
                <div class="progressBar">
                    <input type="range" min=0 max=100 step=1>
                </div> -->
            </div>';
    } else {
        echo '<a href="../pages/login.php" class="noAccount">Autentifica-te!</a>';
    }

