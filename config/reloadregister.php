<?php
    error_reporting(0);
    session_start();
    function ReloadRegister($UserId, $NamaUser, $NamaDepan, $NamaBelakang, $PasswordUser, $Foto, $Email, $Password){
        $_SESSION['UserId'] = $UserId;
        $_SESSION['NamaUser'] = $NamaUser;
        $_SESSION['PassUser'] = $PasswordUser;
        $_SESSION['NamaDepan'] = $NamaDepan;
        $_SESSION['NamaBelakang'] = $NamaBelakang;
        $_SESSION['FotoUser'] = $Foto;
        $_SESSION['Email'] = $Email;
        $_SESSION['Password'] = $Password;
    }    
?>
