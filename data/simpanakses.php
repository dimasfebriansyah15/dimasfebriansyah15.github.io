<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    ini_set('max_execution_time', 600);
    include '../config/connection.php';
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server: ", mysqli_connect_error());
        exit;
    }
    $menu = $_POST['menuaccess'];
    $menuc = $_POST['menuaccess1'];
    $group = $_POST['groupid'];
    $sqldel2 = "Delete From menuaksessawchild Where GroupId = '$group'";
    $resultdel2 = mysqli_query($link, $sqldel2);
    $sqldel1 = "Delete From menuaksessaw Where GroupId = '$group'";
    $resultdel1 = mysqli_query($link, $sqldel1);
    for($i=0; $i<count($menu); $i++){
        $list = "Select * From menusaw Where NamaMenu = '$menu[$i]'";
        $resultlist = mysqli_query($link, $list);
        if(mysqli_num_rows($resultlist) > 0){
            while($row = mysqli_fetch_array($resultlist)){
                $sql = "Insert Into menuaksessaw(GroupId, NoId, class, NamaMenu, ClassMenu, HrefMenu, TextMenu, DeskripsiMenu) ";
                $sql .= "Values('$group', '$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]')";
                $result = mysqli_query($link, $sql);
            }
        }
    }
    for($i=0; $i<count($menuc); $i++){
        $list = "Select * From menusawchild Where NamaMenu = '$menuc[$i]'";
        $resultlist = mysqli_query($link, $list);
        if(mysqli_num_rows($resultlist) > 0){
            while($row = mysqli_fetch_array($resultlist)){
                $sql = "Insert Into menuaksessawchild(GroupId, NoIdChild, NoId, Class, NamaMenu, HrefMenu, TextMenu, DeskripsiMenu) ";
                $sql .= "Values('$group', '$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]')";
                $result = mysqli_query($link, $sql);
            }
        }
    }
    if($result){echo "true";}else{echo "false";}
?>