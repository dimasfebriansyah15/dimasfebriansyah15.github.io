<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $parameterid = $_POST['parameterid'];
        $tingkat = $_POST['tingkat'];
        $bonus = $_POST['bonus'];
        $kondisi = $_POST['kondisi'];
        $keterangan = $_POST['keterangan'];
        $sql = "Insert Into parameter(ParameterId, Tingkat, BonusKaryawan, Kondisi, Keterangan) "
            . "Values('$parameterid', '$tingkat', '$bonus', '$kondisi', '$keterangan')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        $parameterid = $_POST['parameterid'];
        $tingkat = $_POST['tingkat'];
        $bonus = $_POST['bonus'];
        $kondisi = $_POST['kondisi'];
        $keterangan = $_POST['keterangan'];
        $sql = "Update parameter Set Tingkat = '$tingkat', BonusKaryawan = '$bonus', Kondisi = '$kondisi', Keterangan = '$keterangan' "
            . "Where ParameterId = '$parameterid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $parameterid = $_GET['id'];
        $sql = "Delete From parameter Where ParameterId = '$parameterid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:parameter');}else{header('location:parameter');}
    }
?>