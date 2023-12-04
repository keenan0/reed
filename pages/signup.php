<?php require_once '../php/doctype.php'; ?>
    <title>eed | Înregistrare</title>  
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="icon" href="../assets/icon.png" type="image/png">
</head>

<body>
    <a href="../pages/main.php" id="logo">
        <img src="../assets/logo.png" alt="logo">
    </a>
    <header class="wrapper">
        <!-- <h2>Creare cont nou</h2> -->
        <form action="../inc/signup.inc.php" method="post" autocomplete="off">
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Parola">
            <!-- <input type="checkbox" name="showpwd" id="tglPwd" onclick="togglePassword()"> -->
            <input type="password" name="pwdrepeat" placeholder="Repetă Parola">
            <button type="submit" name="submit" style="font-weight: bold;">CREEAZĂ CONT</button>
        </form> 
        
        <a href="../pages/login.php" id="other"> 
            <span>Ai cont? Autentifică-te!</span>
        </a>
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyFields"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Nu ați completat câmpurile.</p>";
                } else if($_GET["error"] == "invalidUid"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Numele este invalid.</p>";
                } else if($_GET["error"] == "invalidEmail"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Emailul este invalid.</p>";
                } else if($_GET["error"] == "passwordNotMatch"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Parolele nu se potrivesc.</p>";
                } else if($_GET["error"] == "usernametaken"){
                    echo "<p class='error'><i class='fa-solid fa-exclamation'></i> Utilizatorul există deja.</p>";
                }
            }
        ?>
    </header>
    
    <div class="artists">
        <img src="../images/artists/8.png" alt="KANYE" height=700 style="transform: rotateZ(15deg); left: 850px; bottom: 130px;">
        
        <img src="../images/artists/5.png" alt="PINK FLOYD" height=400 style="transform: rotateZ(-10deg); left: 950px; bottom: -60px;">
        
        <img src="../images/artists/4.png" alt="METALLICA" height=600 style="transform: rotateZ(5deg); left: 200px;">
        
        <img src="../images/artists/3.png" alt="QUEEN" height=400 style="transform: rotateZ(0deg); left: 50px; bottom: -30px;">
        
        <img src="../images/artists/2.png" alt="TRAVIS SCOTT" height=500 style="transform: rotateZ(12deg); left: -100px;">
        
        <img src="../images/artists/6.png" alt="LIL UZI VERT" height=600 style="transform: rotateZ(-15deg); left: 1350px; bottom: 100px;">
        
        <img src="../images/artists/7.png" alt="BRYAN ADAMS" height=500 style="transform: rotateZ(-5deg); left: 650px; bottom: -50px;">
        
        <img src="../images/artists/1.png" alt="LINDEMANN" height=400 style="transform: rotateZ(0deg); left: 250px; bottom: -50px;">
    </div>

    <script src="../js/app.js"></script>
    <script src="../js/signup.js"></script>
</body>
</html>