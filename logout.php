<?php 
    session_start();
    
    session_unset();

    session_destroy();

    $login = false;

    header("Location: ". dirname($_SERVER['SCRIPT_NAME']) . "index.php");
?>