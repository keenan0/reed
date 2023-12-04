<?php
//bara de navigatie in functie de logare utilizator 
if(isset($_SESSION["username"])){
    echo '<a href="main.php?">Bun venit, '.$_SESSION["username"].'!</a>';
    echo '<a href="../inc/logout.inc.php">Deconectare</a>';
} else {
    echo '<a href="login.php">Autentificare</a>';
    echo '<a href="signup.php">Inregistrare</a>';
}