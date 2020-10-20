<?php
    $host = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $database = "spk_saw";
    $port = "3306";
    $photo = "foto/";

    $koneksi = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (mysqli_connect_errno()){
        echo "Tidak bisa koneksi ke MySQL Server : " . mysqli_connect_error();
    }
?>
