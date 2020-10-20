<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    ini_set('max_execution_time', 600);
    include "../config/connection.php";
    $id = $_GET['id'];
    $data = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak Bisa Koneksi ke MySQL : ", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "call GetGrafikRangking($id)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $data[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
    echo json_encode($data);
?>