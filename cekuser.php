<?php
    //session_start();
    include 'config/connection.php';
    if($_SESSION['IdGroup'] === null || $_SESSION['IdGroup'] === '' || $_SESSION['IdGroup'] === 0){
        $_SESSION['NamaUser'] = "Tamu";
        $_SESSION['NamaDepan'] = "Tamu";
        $_SESSION['NamaBelakang'] = "";
        $_SESSION['IdGroup'] = 0;
        $_SESSION['NamaGroup'] = "Tamu";
        $_SESSION['AlamatIp'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['NamaKomputer'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $_SESSION['FotoUser'] = "Usericon.png";
        $_SESSION['active'] = "home";
    }
?>