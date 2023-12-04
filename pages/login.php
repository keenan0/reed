<?php 
    require_once '../php/doctype.php'; 
?>
    <title>eed | Autentificare</title>  
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="icon" href="../assets/icon.png" type="image/png">
</head>

<body>
    <header class="wrapper">
        <a href="../pages/main.php" id="logo">
            <img src="../assets/logo.png" alt="logo">
        </a>
        <div class="vertical">
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
            <p>autentificare.autentificare.autentificare.autentificare.</p>
        </div>
        <div id="filter"></div>
        <!-- <h2>Autentificare</h2> -->
        <form action="../inc/login.inc.php" method="post">
            <input autocomplete="off" type="text" name="uid" placeholder="Username/Email">
            <input autocomplete="off" type="password" name="pwd" placeholder="Parola">
            <button type="submit" name="submit" style="font-weight: bold;">Autentificare</button>
        </form>    

        <a href="../pages/signup.php" id="other"> 
            <span>Nu ai cont? Creează-ți unul!</span>
        </a>
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyFields"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Nu ai completat toate câmpurile.</p>";
                } else if($_GET["error"] == "usernameNotExist"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Username-ul nu există.</p>";
                } else if($_GET["error"] == "wrongPassword"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Parola și username-ul nu corespund.</p>";
                } else if($_GET["error"] == "none") {
                    header("location: main.php?");
                }
            }  
        ?>
    </header>
    </div>    
    <script src="../js/app.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>