<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $subkriteriaid = $_POST['subkriteriaid'];
        $kriteriaid = $_POST['kriteriaid'];
        $namasubkriteria = $_POST['namasubkriteria'];
        $sql = "Insert Into subkriteria(SubkriteriaId, KriteriaId, NamaSubkriteria) Values('$subkriteriaid', '$kriteriaid', '$namasubkriteria')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        $subkriteriaid = $_POST['subkriteriaid'];
        $kriteriaid = $_POST['kriteriaid'];
        $namasubkriteria = $_POST['namasubkriteria'];
        $sql = "Update subkriteria Set KriteriaId = '$kriteriaid', NamaSubkriteria = '$namasubkriteria' Where SubkriteriaId = '$subkriteriaid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $subkriteriaid = $_GET['id'];
        $sql = "Delete From subkriteria Where SubkriteriaId = '$subkriteriaid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:subkriteria');}else{header('location:subkriteria');}
    }
?>