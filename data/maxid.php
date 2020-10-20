<?php
    include "../config/connection.php";
    session_start();
    if(isset($_GET['kode'])){$kode = $_GET['kode'];} else {$kode = $_POST['kode'];}
    if($kode === '1'){
        $field = "GroupId";
        $table = "groupuser";
    }
    else if($kode === '2'){
        $field = "UserId";
        $table = "userlogin";
    }
    else if($kode === '3'){
        $field = "KriteriaId";
        $table = "kriteria";
    }
    else if($kode === '4'){
        $field = "AlternatifId";
        $table = "alternatif";
    }
    else if($kode === '5'){
        $field = "NilaiId";
        $table = "nilai";
    }
    else if($kode === '6'){
        $field = "SubkriteriaId";
        $table = "subkriteria";
    }
    else if($kode === '7'){
        $field = "BobotId";
        $table = "bobot";
    }
    else if($kode === '8'){
        $field = "ParameterId";
        $table = "parameter";
    }
    else{
        $field = "";
        $table = "";
    }
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $sql = "Select IfNull(Max($field)+1, 1) as kode From $table";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $output = $row[0];
    }
    $data[] = array(
        "id" => $output
    );
    echo json_encode($data);
?>