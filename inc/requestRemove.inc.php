<?php
    require_once("../inc/dbh.inc.php");
    require_once("../inc/functions.inc.php");

    $reqId = $_GET["reqId"];

    if(isset($reqId)){
        $sql = "DELETE FROM `requests` WHERE reqId = ?";

        $prepStmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($prepStmt, $sql)){exit();}
        
        mysqli_stmt_bind_param($prepStmt, "s", $reqId);
        mysqli_stmt_execute($prepStmt);

        return true;
    } else {
        return false;
    }
?>