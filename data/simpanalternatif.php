<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $alternatifid = $_POST['alternatifid'];
        $namaalternatif = $_POST['namaalternatif'];
        $sql = "Insert Into alternatif(AlternatifId, NamaAlternatif) Values('$alternatifid', '$namaalternatif')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        $alternatifid = $_POST['alternatifid'];
        $namaalternatif = $_POST['namaalternatif'];
        $sql = "Update alternatif Set NamaAlternatif = '$namaalternatif' Where AlternatifId = '$alternatifid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $alternatifid = $_GET['id'];
        $sql = "Delete From alternatif Where AlternatifId = '$alternatifid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:alternatif');}else{header('location:alternatif');}
    }
?>