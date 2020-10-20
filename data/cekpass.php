<?php
    error_reporting(0);
    include "../config/connection.php";
    session_start();
    $namauser = $_SESSION['NamaUser'];
    $passuser = $_SESSION['PasswordUser'];
    if(isset($_GET['password'])){$password = $_GET['password'];} else {$password = $_POST['password'];}
    $password1 = md5($namauser.$password);
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "Select * from userlogin where namauser = '$namauser'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows > 0){
            if($passuser === $password1){echo "true";}else{echo "false2";}
        }
        else{
            echo "false1";
        }
        mysqli_free_result($result);
    }
    else{
        echo "false";
    }
    mysqli_close($link);
?>