<?php
    //error_reporting(0);
    include "config/connection.php";
    $anakmenu = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link){
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
        
    $getacc = $_SESSION['aktif'];
    if ($getacc != null){$getactive = $_SESSION['aktif'];} else{$getactive = "home";}
    $href = $_SESSION['hrefmenu'];
    $text = $_SESSION['Text'];
    
    $test = "";
    if ($result = mysqli_query($link, "call GetMenuAkses('$_SESSION[IdGroup]')")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                if($rec['HrefMenu'] === "#"){
                    if($rec['TextMenu'] === $text and $rec['HrefMenu'] === "#"){
                        $test .= "<li class='active'>";
                        echo "<li class='active'>";
                    }
                    else{
                        $test .= "<li class=''>";
                        echo "<li class=''>";
                    }
                    $test .= "<a href='$rec[HrefMenu]'>"
                          . "<span class='nav-caret' style='margin-top: 10px'>"
                          . "<i class='fa fa-caret-down'></i></span>"
                          . "<span class='nav-icon' style='margin-top: 10px'>"
                          . "<i class='material-icons'>$rec[Class]<span ui-include='assets/images/i_0.svg'></span></i>"
                         . "</span>"
                          . "<span class='nav-text'>$rec[TextMenu]</span>"
                          . "</a>";
                    echo  "<a href='$rec[HrefMenu]'>"
                          . "<span class='nav-caret' style='margin-top: 10px'>"
                          . "<i class='fa fa-caret-down'></i></span>"
                          . "<span class='nav-icon' style='margin-top: 10px'>"
                          . "<i class='material-icons'>$rec[Class]<span ui-include='assets/images/i_0.svg'></span></i>"
                          . "</span>"
                          . "<span class='nav-text'>$rec[TextMenu]</span>"
                          . "</a>";
                    $link1 = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
                    if (!$link1) {
                        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
                        exit;
                    }
                    $test .= "<ul class='nav-sub'>";
                    echo "<ul class='nav-sub'>";
                    if ($result1 = mysqli_query($link1, "call GetMenuAksesChild('$_SESSION[IdGroup]', '$rec[NoId]')")){
                        $nbrows1 = mysqli_num_rows($result1);
                        if($nbrows1>0){
                            while($rec1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
                                if($rec1['HrefMenu'] == $getactive){
                                    $test .= "<li class='active'><a href='".$rec1['HrefMenu']."'><span class='nav-text'>".$rec1['TextMenu']."</span></a></li>";
                                    echo "<li class='active'><a href='".$rec1['HrefMenu']."'><span class='nav-text'>".$rec1['TextMenu']."</span></a></li>";
                                }
                                else{
                                    $test .= "<li class=''><a href='".$rec1['HrefMenu']."'><span class='nav-text'>".$rec1['TextMenu']."</span></a></li>";
                                    echo "<li class=''><a href='".$rec1['HrefMenu']."'><span class='nav-text'>".$rec1['TextMenu']."</span></a></li>";
                                }
                            }
                        }
                        mysqli_free_result($result1);
                    }
                    mysqli_close($link1);
                    $test .= "</ul>";
                    echo "</ul>";
                    $test .= "</li>";
                    echo "</li>";
                }
                else{
                    if($rec['HrefMenu'] == $getactive){
                        $test .= "<li class='active'>"
                            . "<a href='".$rec['HrefMenu']." '>"
                            . "<span class='nav-icon' style='margin-top: 10px'>"
                            . "<i class='material-icons'>$rec[Class]<span ui-include='assets/images/i_$rec[NoId].svg'></span></i>"
                            . "</span>"
                            . "<span class='nav-text'>$rec[TextMenu]</span>"
                            . "</a>"
                            . "</li>";
                        echo "<li class='active'>"
                            . "<a href='".$rec['HrefMenu']."'>"
                            . "<span class='nav-icon' style='margin-top: 10px'>"
                            . "<i class='material-icons'>$rec[Class]<span ui-include='assets/images/i_$rec[NoId].svg'></span></i>"
                            . "</span>"
                            . "<span class='nav-text'>$rec[TextMenu]</span>"
                            . "</a>"
                            . "</li>";
                    }
                    else{
                        $test .= "<li class=''>"
                            . "<a href='".$rec['HrefMenu']."'>"
                            . "<span class='nav-icon' style='margin-top: 10px'>"
                            . "<i class='material-icons'>$rec[Class]<span ui-include='assets/images/i_$rec[NoId].svg'></span></i>"
                            . "</span>"
                            . "<span class='nav-text'>$rec[TextMenu]</span>"
                            . "</a>"
                            . "</li>";
                        echo "<li class=''>"
                            . "<a href='".$rec['HrefMenu']."'>"
                            . "<span class='nav-icon' style='margin-top: 10px'>"
                            . "<i class='material-icons'>$rec[Class]<span ui-include='assets/images/i_$rec[NoId].svg'></span></i>"
                            . "</span>"
                            . "<span class='nav-text'>$rec[TextMenu]</span>"
                            . "</a>"
                            . "</li>";
                    }
                }
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>