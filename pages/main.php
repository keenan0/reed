<?php session_start();?>
<?php require_once '../php/doctype.php';?>
    <title>eed</title> 
    <link rel="icon" href="../assets/icon.png" type="image/png">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="errorC">
    <?php
        if(isset($_GET["error"]) && !$_SESSION["errorShown"]){
            $errorCode = $_GET["error"];
            
            if($errorCode == "none") {
                echo '<span class="success"><i class="fa-solid fa-check"></i> Cererea a fost înregistrată!</span>';
                $_SESSION["errorShown"] = true;
            } else {
                echo '<span class="error"><i class="fa-solid fa-exclamation"></i> ';
                if($errorCode == "reqLongTitle") {
                    echo 'Titlul are peste 100 de caractere.';
                } else if ($errorCode == "reqLongMessage"){
                    echo 'Mesajul conține mai mult de 1000 de caractere.';
                } else if($errorCode == "reqEmpty") {
                    echo 'Nu ai completat ambele câmpuri.';
                }
                echo '</span>';

                $_SESSION["errorShown"] = true;
            }
        }
        // else {
        //     $_SESSION["errorShown"] = false;
        // }
        //var_dump($_SESSION);
    ?>
    </div>
    <header class="wrapper">
        <?php require_once '../php/leftNavbar.php'?>
        
        <div class="rightNavbar">
            <div class="topNavbar">
                <!--Bara pentru logare si informatii utilizator-->
                <?php require_once '../php/topNavbar.php'?>  
            </div>
            <section id="cont" class="content">
                <!--Continutul paginii-->
                <?php require_once '../php/content.php'?>
            </section>
        </div>
        
        <!--Bara pentru melodii-->
        <div class="playNavbar">
            <?php require_once '../php/playNavbar.php'?>
        </div>
    </header>
    
    <?php 
        if(isset($_SESSION["userid"])){
            $userId = $_SESSION["userid"];

            echo '<span id="userId" style="display: none;">'.$userId.'</span>';    
        }
    ?>
    <script src="../js/more.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/audioPlay.js"></script>
    <script src="../js/songs.js"></script>
    <script src="../js/form.js"></script>
</body>
</html>