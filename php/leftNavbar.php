<div class="leftNavbar">
    <a onclick="loadContent('content.php')" href="#acasa" class="home-btn" id="logobtn"><img src="../assets/logo.png" alt="logo" width="100px"></a>
    <a onclick="loadContent('content.php')" href="#acasa" class="home-btn">
        <i class="fa-solid fa-house"></i>
        <span>Acasă</span>
    </a>
    <a onclick="loadContent('search.php')" href="#cauta">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span>Caută</span>
    </a>
    <a onclick="loadContent('library.php')" href="#biblioteca">
        <!-- <i class="fa-solid fa-book-bookmark"></i> -->
        <i class="fa-solid fa-bookmark"></i>
        <span>Bibliotecă</span>
    </a>
    <div style="
        display: flex;
        height: 100%;
        width: 100%;
        align-items:flex-end;
        justify-content:center;
        ">
        <a onclick="loadContent('upload.php')" href="#adauga" style="font-size: 16px;">
            <i class="fa-regular fa-square-plus"></i>
            <span>Adaugă melodie</span>
            <?php
                require_once '../inc/dbh.inc.php';
                require_once '../inc/functions.inc.php';

                if(isset($_SESSION["admin"])){
                    if($_SESSION["admin"] == '1'){
                        echo '<span class="notif">'.getReqSize($conn).'</span>';
                    }
                }
            ?>
        </a>
    </div>
</div>