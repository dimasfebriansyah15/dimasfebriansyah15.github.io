<?php
    include '../config/connection.php';
    if(isset($_GET['username'])){$user = $_GET['username'];} else {$user = $_POST['username'];}
    if(isset($_GET['password'])){$password = $_GET['password'];} else {$password = $_POST['password'];}
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $link2 = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link2) {
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "call UserLogin('$user', '$password')")) {
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                session_start();
                $_SESSION['IdUser'] = $rec['UserId'];
                $_SESSION['NamaUser'] = $rec['NamaUser'];
                $_SESSION['NamaDepan'] = $rec['NamaDepan'];
                $_SESSION['NamaBelakang'] = $rec['NamaBelakang'];
                $_SESSION['PasswordUser'] = $rec['PassUser'];
                $_SESSION['FotoUser'] = $rec['FotoUser1'];
                $_SESSION['Email'] = $rec['EmailUser'];
                $_SESSION['Password'] = $password;
                $_SESSION['IdGroup'] = $rec['GroupId'];
                $_SESSION['NamaGroup'] = $rec['NamaGroup'];
                $_SESSION['AlamatIp'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['NamaKomputer'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $_SESSION['aktif'] = "home";
            }
            echo "true";
        }
        else{
            echo "false";
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>