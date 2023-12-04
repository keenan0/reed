<section class="PLAYLIST">
    <?php
        require_once("../inc/dbh.inc.php");
        require_once("../inc/functions.inc.php");

        session_start();

        $username = "testing";
        if(isset($_SESSION["username"])){
            echo '
                <h1 id="FAVO">Melodiile tale favorite: </h1>
                <section class="searchCard">
            ';
            
            $username = $_SESSION["username"];
            $userId = $_SESSION["userid"];

            $sql = "SELECT * FROM favourites JOIN songs ON songs.id = favourites.favsong WHERE favourites.favuser = ?;";
            $preparedStatement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($preparedStatement, $sql)){exit();}

            mysqli_stmt_bind_param($preparedStatement, "s", $userId);
            mysqli_stmt_execute($preparedStatement);

            $resultData = mysqli_stmt_get_result($preparedStatement);

            if(mysqli_num_rows($resultData) > 0) {
                while($row = mysqli_fetch_assoc($resultData)){
                    $album = getAlbumData($conn, $row["albumid"]);
                    
                    echo '
                        <div class="favSection">
                            <div class="flex">
                                <h1 style="display:none;">'.$row["id"].'</h1>
                                <img src="../albums/'.$row["albumid"].'.jpg">
                                <div class="nameAndAlbum">
                                    <span class="tit">'.$row["name"].'</span>
                                    <span class="art">'.$album["author"].'</span>
                                </div>
                            </div>
                            <i class="favorite fa-solid fa-heart" onclick="removeFavorite('.$userId.', '.getSongId($conn, $row["name"]).')"></i>
                        </div>
                    ';
                }
            } else {
                echo '
                    <p class="btnNotFound">Inca nu ai piese favorite...</p>
                ';
            }
        } else {
            echo '  
                <h1>Nu esti conectat inca.</h1>
                <section class="searchCard">
            ';
        }
    ?>

    </section>
</section>


<script src="../js/songs.js"></script>