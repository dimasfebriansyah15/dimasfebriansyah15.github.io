<?php
    include '../config/connection.php';
    include '../config/function.php';
    include '../config/reloadregister.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $act = $_GET['act'];
    if($act == 'simpan'){
        $userid = $_POST['userid'];
        $namauser = $_POST['namauser'];
        $namadepan = $_POST['namadepan'];
        $namabelakang = $_POST['namabelakang'];
        $email = $_POST['emailuser'];
        $passuser = md5($_POST['namauser'].$_POST['passuser']);
        $groupid = $_POST['groupid'];
        $sql = "Insert Into userlogin(UserId, NamaUser, PassUser, NamaDepan, NamaBelakang, EmailUser, GroupId) "
            . "Values('$userid', '$namauser', '$passuser', '$namadepan', '$namabelakang', '$email', '$groupid')";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit1'){
        $userid = $_POST['userid'];
        $namauser = $_POST['namauser'];
        $namadepan = $_POST['namadepan'];
        $namabelakang = $_POST['namabelakang'];
        $email = $_POST['emailuser'];
        $PassLogin = $_POST['passuser'];
        $groupid = $_POST['groupid'];
        $sqlgetpass = "Select PassUser from userlogin where UserId = '$userid'";
        $resultpass = mysqli_query($link, $sqlgetpass);
        while($row = mysqli_fetch_array($resultpass, MYSQLI_ASSOC)){
            $passlama = $row['PassUser'];
        }
        $PassLogin1 = $PassLogin;
        if($passlama === $PassLogin1){$NewPassLogin = $passlama;}
        else{$NewPassLogin = md5($namauser.$PassLogin);}
        $sql = "Update userlogin Set GroupId = '$groupid', NamaUser = '$namauser', NamaDepan = '$namadepan', "
            . "NamaBelakang = '$namabelakang', PassUser = '$NewPassLogin', EmailUser = '$email' "
            . "Where UserId = '$userid'";
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'edit'){
        session_start();
        $userid = $_POST['userid'];
        $namauser = $_POST['namauser'];
        $namadepan = $_POST['namadepan'];
        $namabelakang = $_POST['namabelakang'];
        $email = $_POST['emailuser'];
        $PassLogin = $_POST['passuser'];
        $groupid = $_POST['groupid'];
        $location_file = $_FILES['fotouser']['tmp_name'];
        $type_file = $_FILES['fotouser']['type'];
        $name_file = $_FILES['fotouser']['name'];
        $picture = $_POST['foto'];
        $sqlgetpass = "Select PassUser from userlogin where UserId = '$userid'";
        $resultpass = mysqli_query($link, $sqlgetpass);
        while($row = mysqli_fetch_array($resultpass, MYSQLI_ASSOC)){
            $passlama = $row['PassUser'];
        }
        $PassLogin1 = $PassLogin;
        if($passlama === $PassLogin1){
            $NewPassLogin = $passlama;
        }
        else{
            $NewPassLogin = md5($namauser.$PassLogin);
        }
        if (empty($location_file)){
            $picture = $_POST['foto'];
            $sql = "Update userlogin Set GroupId = '$groupid', NamaUser = '$namauser', NamaDepan = '$namadepan', "
                . "NamaBelakang = '$namabelakang', EmailUser = '$email', PassUser = '$NewPassLogin' "
                . "Where UserId = '$userid'";
        }
        else{
            $dir = "../".$photo;
            if($picture !== 'Usericon.png'){DeleteImage($picture, $dir);}
            UploadImage($name_file, $dir, $location_file);
            $picture = $name_file;
            $sql = "Update userlogin Set GroupId = '$groupid', NamaUser = '$namauser', NamaDepan = '$namadepan', "
                . "NamaBelakang = '$namabelakang', EmailUser = '$email', PassUser = '$NewPassLogin', FotoUser = '$picture' "
                . "Where UserId = '$userid'";
        }
        ReloadRegister($userid, $namauser, $namadepan, $namabelakang, $NewPassLogin, $picture, $email, $NewPassLogin);
        $result = mysqli_query($link, $sql);
        if($result){echo 'true';}else{echo 'false';}
    }
    else if($act == 'delete'){
        $iduser = $_GET['id'];
        $sqlgetpass = "Select FotoUser from userlogin where UserId = '$iduser'";
        $resultpass = mysqli_query($link, $sqlgetpass);
        while($row = mysqli_fetch_array($resultpass, MYSQLI_ASSOC)){
            $fotolama = $row['FotoUser'];
        }
        $dir = "../".$photo;
        if($fotolama !== 'Usericon.png'){
            DeleteImage($fotolama, $dir);
        }
        $sql = "Delete From userlogin Where UserId = '$iduser'";
        $result = mysqli_query($link, $sql);
        if($result){header('location:register');}else{header('location:register');}
    }
?>