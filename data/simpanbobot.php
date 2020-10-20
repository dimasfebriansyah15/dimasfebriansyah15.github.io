<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $link1 = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link1) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    function cekdataentri($link, $kriteriaid, $subkriteriaid){
        $out = "";
        $sql = "Select Count(*) jml From bobot Where KriteriaId = '$kriteriaid' And SubkriteriaId = '$subkriteriaid'";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jml = (int) $row['jml'];
        }
        if($jml > 0){$out = false;}else{$out = true;}
        return $out;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $bobotid = $_POST['bobotid'];
        $kriteriaid = $_POST['kriteriaid'];
        $subkriteriaid = $_POST['subkriteriaid'];
        $nilaiid = $_POST['nilaiid'];
        $cek = cekdataentri($link1, $kriteriaid, $subkriteriaid);
        if($cek){
            $sql = "Insert Into bobot(BobotId, KriteriaId, SubkriteriaId, NilaiId) Values('$bobotid', '$kriteriaid', '$subkriteriaid', '$nilaiid')";
            $result = mysqli_query($link, $sql);
            if($result){echo 'true';}else{echo 'false';}
        }
        else{
            echo 'false2';
        }
    }
    else if($act == 'edit'){
        $bobotid = $_POST['bobotid'];
        $kriteriaid = $_POST['kriteriaid'];
        $subkriteriaid = $_POST['subkriteriaid'];
        $nilaiid = $_POST['nilaiid'];
        $sql = "Update bobot Set KriteriaId = '$kriteriaid', SubkriteriaId = '$subkriteriaid', NilaiId = '$nilaiid' Where BobotId = '$bobotid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $bobotid = $_GET['id'];
        $sql = "Delete From bobot Where BobotId = '$bobotid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:bobot');}else{header('location:bobot');}
    }
?>