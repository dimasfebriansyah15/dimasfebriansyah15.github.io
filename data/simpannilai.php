<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $nilaiid = $_POST['nilaiid'];
        $ketnilai = $_POST['ketnilai'];
        $jmlnilai = str_replace(",", ".", $_POST['jmlnilai']);
        $sql = "Insert Into nilai(NilaiId, KetNilai, JmlNilai) Values('$nilaiid', '$ketnilai', '$jmlnilai')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        $nilaiid = $_POST['nilaiid'];
        $ketnilai = $_POST['ketnilai'];
        $jmlnilai = str_replace(",", ".", $_POST['jmlnilai']);
        $sql = "Update nilai Set KetNilai = '$ketnilai', JmlNilai = '$jmlnilai' Where NilaiId = '$nilaiid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $nilaiid = $_GET['id'];
        $sql = "Delete From nilai Where NilaiId = '$nilaiid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:nilai');}else{header('location:nilai');}
    }
?>