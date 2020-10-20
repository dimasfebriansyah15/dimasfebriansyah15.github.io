<?php
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $groupid = $_POST['groupid'];
        $namagroup = $_POST['namagroup'];
        $sql = "Insert Into groupuser(GroupId, NamaGroup) Values('$groupid', '$namagroup')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        $groupid = $_POST['groupid'];
        $namagroup = $_POST['namagroup'];
        $sql = "Update groupuser Set NamaGroup = '$namagroup' Where GroupId = '$groupid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $groupid = $_GET['id'];
        $sql = "Delete From groupuser Where GroupId = '$groupid'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:group');}else{header('location:group');}
    }
?>