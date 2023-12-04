<?php
    require_once("../inc/dbh.inc.php");
    require_once("../inc/functions.inc.php");
    session_start();
    
    if(isset($_SESSION["username"])){
        if($_SESSION["admin"]){
            echo '
                <section class="">
                    '.showRequests($conn).'
                </section>
            ';
        } else {
            //var_dump($_SESSION);
            echo '
                <div class="tooltip">
                    <p class="btn">Aici poți depune o cerere pentru a adăuga noi melodii!</p>
                    <i class="fa-solid fa-circle-info">
                        <span class="tooltiptext">După ce depui o cerere, un admin va încerca să adauge melodia/albumul dorit. Poate dura câteva zile.</span>
                    </i>
                </div>
                <form action="../inc/request.inc.php" method="post" class="form">
                    <input autocomplete="off" type="text" name="reqTitle" placeholder="Titlul cererii">
                    <textarea autocomplete="off" name="reqMessage" placeholder="Mesajul tău"></textarea>
                    <button name="reqSubmit" type="submit">TRIMITE CERERE</button>
                </form>
            ';
        } 
    } else {
        echo '<p class="PLAYLIST" style="font-size: 22px; color: white; font-weight:bold;">Nu esti conectat inca.</p>';
    }
?>