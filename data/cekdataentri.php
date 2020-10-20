<?php
    error_reporting(0);
    include "../config/connection.php";
    if(isset($_GET['value'])){$value = $_GET['value'];} else {$value = $_POST['value'];}
    if(isset($_GET['kode'])){$kode = (int) $_GET['kode'];} else {$kode = (int) $_POST['kode'];}
    if(isset($_GET['value2'])){$value2 = (int) $_GET['value2'];} else {$value2 = (int) $_POST['value2'];}
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak Bisa Koneksi ke MySQL. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    if($kode === 1){
        $sqlcheck = "Select count(*) jml from groupuser where NamaGroup = '$value'";
        $result = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){echo "true";}else{echo "false";}
    }
    else if($kode === 2){
        $sqlcheck = "Select count(*) jml from kriteria where NamaKriteria = '$value'";
        $result = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){echo "true";}else{echo "false";}
    }
    else if($kode === 3){
        $sqlcheck = "Select count(*) jml from alternatif where NamaAlternatif = '$value'";
        $result = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){echo "true";}else{echo "false";}
    }
    else if($kode === 4){
        $sqlcheck = "Select count(*) jml from nilai where KetNilai = '$value'";
        $result = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){echo "true";}else{echo "false";}
    }
    else if($kode === 5){
        $sqlcheck = "Select count(*) jml from subkriteria where NamaSubkriteria = '$value' And KriteriaId = '$value2'";
        $result = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){echo "true";}else{echo "false";}
    }
    else if($kode === 6){
        $sqlcheck = "Select count(*) jml from parameter where tingkat = '$value'";
        $result = mysqli_query($link, $sqlcheck);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){echo "true";}else{echo "false";}
    }
?>