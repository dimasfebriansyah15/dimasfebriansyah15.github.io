<?php
    include "../config/connection.php";
    if(isset($_GET['namauser'])){$namauser = $_GET['namauser'];} else {$namauser = $_POST['namauser'];}
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak Bisa Koneksi ke MySQL. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    $sqlcheck = "Select count(*) jml from userlogin where namauser = '$namauser'";
    $result = mysqli_query($link, $sqlcheck);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $jml = (int) $row['jml'];
    }
    if($jml > 0){echo "true";}else{echo "false";}
?>