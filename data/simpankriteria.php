<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $kriteriaid = $_POST['kriteriaid'];
        $namakriteria = $_POST['namakriteria'];
        $tipekriteria = $_POST['tipekriteria'];
        $sql = "Insert Into kriteria(KriteriaId, NamaKriteria, TipeKriteria) Values('$kriteriaid', '$namakriteria', '$tipekriteria')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        $kriteriaid = $_POST['kriteriaid'];
        $namakriteria = $_POST['namakriteria'];
        $tipekriteria = $_POST['tipekriteria'];
        $sql = "Update kriteria Set NamaKriteria = '$namakriteria', TipeKriteria = '$tipekriteria' Where KriteriaId = '$kriteriaid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $kriteriaid = $_GET['id'];
        $sql = "Delete From kriteria Where KriteriaId = '$kriteriaid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:kriteria');}else{header('location:kriteria');}
    }
?>