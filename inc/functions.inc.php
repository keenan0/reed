<?php

function emptyFieldsSignup($username, $email, $password, $passwordRepeat) {
    $result = null;

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emptyFieldsLogin($username, $password){
    $result = null;

    if(empty($username) || empty($password)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function emptyRequest($title, $message) {
    $result = null;

    if(empty($message) || empty($title)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidUid($username) {
    $result = null;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    $result = null;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidPassword($pwd, $pwdR) { 
    $result = null;
    
    if($pwd !== $pwdR){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function userExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";

    $preparedStatement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($preparedStatement, $sql)) {
        header("location: ../pages/signup.php?error=stmtfailed");
        exit();    
    }

    mysqli_stmt_bind_param($preparedStatement, "ss", $username, $email);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

function createUser($conn, $username, $email, $pwd, $pwdR) {
    $sqlQuery = "INSERT INTO users (
        usersName,
        usersEmail,
        usersPassword
    ) VALUES (?, ?, ?)";

    $preparedStatement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($preparedStatement, $sqlQuery)){
        header("location: ../pages/signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($preparedStatement, "sss", $username, $email, $hashedPwd);
    mysqli_stmt_execute($preparedStatement);
    mysqli_stmt_close($preparedStatement);

    header("location: ../pages/main.php?error=none");
}

function loginUser($conn, $username, $pwd) {
    $userData = userExists($conn, $username, $username);

    if($userData === false){
        header("location: ../pages/login.php?error=usernameNotExist");
        exit();
    }

    $pwdHashed = $userData["usersPassword"];
    $pwdCheck = password_verify($pwd, $pwdHashed);

    if($pwdCheck === false){
        header("location: ../pages/login.php?error=wrongPassword");
        exit();
    } else if($pwdCheck === true){ 
        session_start();
        $_SESSION["username"] = $userData["usersName"];
        $_SESSION["userid"] = $userData["usersId"];
        $_SESSION["admin"] = $userData["admin"];

        header("location: ../pages/login.php?error=none");
    }
}

function getAlbumData($conn, $id){
    $sql = "SELECT * FROM albums WHERE id=?";

    $preparedStatement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($preparedStatement, $sql)) {exit();}

    mysqli_stmt_bind_param($preparedStatement, "i", $id);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

function getSongAlbumId($conn, $song_id) {
    $sql = "SELECT * FROM songs WHERE id = ?";

    $preparedStatement = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($preparedStatement, $sql)) {exit();}

    mysqli_stmt_bind_param($preparedStatement, "s", $song_id);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row["albumid"];
    } else {
        $result = false;
        return $result;
    }
}

function showSongsFromAlbum($conn, $albumId){
    $sql = "SELECT * FROM songs WHERE albumid=?;";
    $preparedStatement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($preparedStatement, $sql)){exit();}
    
    mysqli_stmt_bind_param($preparedStatement, "i", $albumId);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    $album = getAlbumData($conn, $albumId);

    echo 
    '<p class="sectionTitle">
        '.$album["name"].'
    </p>
    <p class="sectionPublish">
        '.$album["publish"].
    '</p>
    ';
    echo '<div class="songs">';
    
    if(mysqli_num_rows($resultData)){
        while($row = mysqli_fetch_assoc($resultData)){
            //mai tarziu pentru atunci cand o sa fie random piesele nu toate din acelasi album
            //$album = getAlbumData($conn, $row["albumid"]);

            //pentru fiecare melodie gasita 
            echo 
                '<a href="#" onlick="LoadSong('.$row["id"].')">
                    <div class="grid-card">
                        <div class="card1">
                            <img src="../albums/'.$albumId.'.jpg">
                        </div>
                        <span class="invis">'.$row["id"].'</span>
                        <h1>'.$row["name"].'</h1>
                        <p>'.$album["author"].'</p>
                    </div>
                </a>';
        }

        echo '</div>';
    } else {
        echo "0 results";
    }
}

function showSongsFromAlbumGrid($conn, $albumId){
    $sql = "SELECT * FROM songs WHERE albumid=?;";
    $preparedStatement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($preparedStatement, $sql)){exit();}
    
    mysqli_stmt_bind_param($preparedStatement, "i", $albumId);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    $album = getAlbumData($conn, $albumId);

    echo 
    '
    <div style="display: inline-flex; align-items: center; padding: 10px; justify-content:space-between;">
        <div style="display: inline-flex; align-items: center;">     
            <img src="../albums/'.$albumId.'.jpg" style="width: 100px; height: 100px;">
            <div>
                <p class="sectionTitle">
                    '.$album["name"].'
                    - 
                    '.$album["author"].'
                </p>
                <p class="sectionPublish">
                    '.$album["publish"].
                '</p>
            </div>
        </div>
        <i id="toggle'.$albumId.'" class="okT fa-regular fa-square-caret-down" onclick="Show('.$albumId.')"></i>
    </div>
    ';
    echo '<div class="songs2'.$albumId.'" style="display:none;">';
    
    if(mysqli_num_rows($resultData)){
        while($row = mysqli_fetch_assoc($resultData)){
            echo '
            <div class="searchCard2">
                <a href="#" onclick="LoadSong('.$row["id"].')">
                    <span class="invis">'.$row["id"].'</span>
                    <span class="invis">'.$album["author"].'</span>

                    <i class="fa fa-play"></i>
                    
                    <div class="nameAndAlbum">
                        <span class="tit">'.$row["name"].'</span>
                        <span class="invis art">'.$album["name"].'</span>
                        <span class="invis">../albums/'.$albumId.'.jpg</span>
                    </div>
                </a>
            </div>
            ';
        }

        echo '</div>';
    } else {
        echo "0 results";
    }
}

function showPlaylist($conn, $playlistId){
    $sql = "SELECT * FROM playlists JOIN playlists_songs ON playlists.id = playlists_songs.playlist_id WHERE playlists.id = ?;";
    $preparedStatement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($preparedStatement, $sql)){exit();}
    
    mysqli_stmt_bind_param($preparedStatement, "i", $playlistId);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    $playlist = mysqli_fetch_assoc($resultData);

    echo '
    <div class="title">
        <p class="sectionTitle">
            '.$playlist["name"].'
        </p>
        
        <p class="info">
            '.$playlist["info"].'
        </p>
    </div>
    ';
    echo '
    <section class="songSlideShow">
    <div class="songs">';

    if(mysqli_num_rows($resultData)){
        while($row = mysqli_fetch_assoc($resultData)){
            $album = getAlbumData($conn, getSongAlbumId($conn, $row["song_id"]));

            if($album){
            echo 
                '<a href="#">
                    <div class="grid-card">
                        <div class="card1">
                            <img src="../albums/'.$album["id"].'.jpg">
                        </div>
                        <span class="invis">'.$row["song_id"].'</span>
                        <h1>'.getSongName($conn, $row["song_id"]).'</h1>
                        <p>'.$album["author"].'</p>
                    </div>
                </a>';
            }
        }
    }     
    echo '</div> </section>';
}

function getSongName($conn, $song_id) {
    $sql = "SELECT * FROM songs WHERE id=?";

    $preparedStatement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($preparedStatement, $sql)){exit();}
    
    mysqli_stmt_bind_param($preparedStatement, "i", $song_id);
    mysqli_stmt_execute($preparedStatement);

    $resultData = mysqli_stmt_get_result($preparedStatement);

    $song = mysqli_fetch_assoc($resultData);

    if($song) {
        $result = $song["name"];
        return $result;
    } else {
        $result = false;
        return $result;
    }
}

function getRelatedSong($conn, $song) {
    //$sql = "SELECT * FROM songs WHERE LEFT(name, LENGTH(?)) = ?";
    //$sql = "SELECT * FROM albums JOIN songs ON albums.id = songs.albumid WHERE LEFT(songs.name, LENGTH(?)) = ? OR LEFT(albums.name, LENGTH(?)) = ? OR LEFT(albums.author, LENGTH(?)) = ?;";

    $sql = "SELECT * FROM albums JOIN songs ON albums.id = songs.albumid WHERE LOCATE(?, songs.name) > 0 OR LOCATE(?, albums.name) > 0 OR LOCATE(?, albums.author) > 0;";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_bind_param($prepStmt, "sss", $song, $song, $song);
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    return $resultData;
}

function getRelatedFilter($conn, $filter) {
    $sql = "SELECT * FROM albums JOIN songs ON albums.id = songs.albumid WHERE LOCATE(?, genre) > 0;";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_bind_param($prepStmt, "s", $filter);
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    return $resultData;
}

function favoriteIsNotInDB($conn, $userId, $songId) {
    $sql = "SELECT * FROM favourites WHERE favsong = ? AND favuser = ?";

    $prepStmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_bind_param($prepStmt, "ss", $songId, $userId);
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    if(mysqli_num_rows($resultData) > 0) {
        return false;
    }

    return true;
}

function addFavorite($conn, $userId, $songId){
    if(favoriteIsNotInDB($conn, $userId, $songId)){
        $sql = "INSERT INTO favourites (`favsong`, `favuser`) VALUES (?, ?);";

        $prepStmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
        
        mysqli_stmt_bind_param($prepStmt, "ss", $songId, $userId);
        mysqli_stmt_execute($prepStmt);

        return true;
    }
    
    return false;
}

function removeFavorite($conn, $userId, $songId) {
    if(favoriteIsNotInDB($conn, $userId, $songId)){
        return false;
    }

    $sql = "DELETE FROM favourites WHERE favsong = ? AND favuser = ?";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_bind_param($prepStmt, "ss", $songId, $userId);
    mysqli_stmt_execute($prepStmt);

    return true;
}

function getSongId($conn, $songName) {
    $sql = "SELECT * FROM `songs` WHERE `name` = ?";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_bind_param($prepStmt, "s", $songName);
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    if(mysqli_num_rows($resultData) > 0) {
        while($row = mysqli_fetch_assoc($resultData)){
            return $row["id"];
        }
    }
}

function sendRequest($conn, $userId, $title, $message) {
    if(strlen($title) > 100) {
        header("location: ../pages/main.php?error=reqLongTitle");
        return false;
        exit();
    } else if(strlen($message) > 1000){
        header("location: ../pages/main.php?error=reqLongRequest");
        return false;
        exit();
    } else {
        $sql = "INSERT INTO `requests`(`userId`, `reqTitle`, `reqMessage`) VALUES (?, ?, ?);";

        $prepStmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
        
        mysqli_stmt_bind_param($prepStmt, "sss", $userId, $title, $message);
        
        if(mysqli_stmt_execute($prepStmt)){
            header("location: ../pages/main.php?error=none");
            return true;
        } else {
            header("location: ../pages/main.php?error=reqSQL");
            return false;
        }
    }
    
    return false;
}

function getReqSize($conn) {
    $sql = "SELECT COUNT(*) AS countVar FROM requests;";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    $row = mysqli_fetch_assoc($resultData);

    return $row["countVar"];
}

function getUserName($conn, $id) {
    $sql = "SELECT * FROM users WHERE usersId = ?";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_bind_param($prepStmt, "s", $id);
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    if(mysqli_num_rows($resultData) > 0) {
        while($row = mysqli_fetch_assoc($resultData)){
            return $row["usersName"];
        }
    }
}

function showRequests($conn) {
    $sql = "SELECT * FROM requests;";

    $prepStmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
    
    mysqli_stmt_execute($prepStmt);

    $resultData = mysqli_stmt_get_result($prepStmt);

    if(mysqli_num_rows($resultData) > 0) {
        while($row = mysqli_fetch_assoc($resultData)){
            echo '
                <div class="reqSection">
                    <div>
                        <p><span style="font-weight:bold;">Utilizator:</span> '.getUserName($conn, $row["userId"]).'</p>
                        <p><span style="font-weight:bold;">Titlu cerere:</span> '.$row["reqTitle"].'</p>
                        <p class="btn">'.$row["reqMessage"].'</p>
                    </div>

                    <div>
                        <i id="checkMark" class="fa-solid fa-check" onclick="removeRequest('.$row["reqId"].')"></i>
                        <!--<i class="fa-solid fa-xmark" style="color:rgb(219,74,74);" onclick="removeRequest('.$row["reqId"].', false)"></i>-->
                    </div>
                </div>
            ';
        }
    } else {
        echo '<p class="btn">Momentan nu sunt cereri active.</p>';
    }
}

//Lph4Z7t7Gc7Zj1ULIESj55SxMMRvQnNylJvxYG9y