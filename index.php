<?php
    session_start();
    if(!isset($_SESSION['rut'])){
        header('location: login.php');
    }
    else{
        header('location: home.php'); 
    }
?>