<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    error_reporting(0);
    ini_set('max_execution_time', 600);
    include "../config/connection.php";
    $id = $_GET['groupid'];
    $test = "";
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "call GetMenuAksesUser($id)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            $test .= "<div class='form-group row'>";
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $noid = $rec['NoId'];
                $href = $rec['NamaMenu'];
                $caption = $rec['TextMenu'];
                $description = $rec['DeskripsiMenu'];
                $checked = $rec['active'];
                $href1 = $rec['HrefMenu'];
                if($href1 === '#' && $noid === '5'){
                    $test .= "<div class='clearfix m-b-2'></div>";
                }
                if($noid === '9'){
                    $test .= "<div class='clearfix m-b-2'></div>";
                }
                $test .= "<div class='col-sm-3'>";
                if($href1 === '#'){
                    $test .= "<label class='md-check' for='$href'>";
                    $test .= "<input type='checkbox' value='$href' id='$href' name='menuaccess[]' $checked>";
                    $test .= "<i class='blue'></i>";
                    $test .= "$caption</label>";
                    $linkchild = mysqli_connect($host, $dbuser, $dbpassword, $database);
                    if (!$linkchild) {
                        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
                        exit;
                    }
                    if ($resultchild = mysqli_query($linkchild, "call GetMenuAksesUserChild($noid, $id)")){
                        $nbrowsc = mysqli_num_rows($resultchild);
                        if($nbrowsc>0){
                            while($rec1 = mysqli_fetch_array($resultchild, MYSQLI_ASSOC)){
                                $hrefc = $rec1['NamaMenu'];
                                $captionc = $rec1['TextMenu'];
                                $descriptionc = $rec1['DeskripsiMenu'];
                                $checkedc = $rec1['active'];
                                $test .= "<div class='col-sm-12 m-l-1' style='margin-top: 5px'>";
                                $test .= "<label class='md-check' for='$hrefc'>";
                                $test .= "<input type='checkbox' value='$hrefc' id='$hrefc' name='menuaccess1[]' $checkedc>";
                                $test .= "<i class='blue'></i>";
                                $test .= "$captionc</label>";
                                $test .= "</div>";
                            }
                        }
                        $test .= "</div>";
                        mysqli_free_result($resultchild);
                    }
                    mysqli_close($linkchild);
                }
                else{
                    $test .= "<label class='md-check' for='$href'>";
                    $test .= "<input type='checkbox' value='$href' id='$href' name='menuaccess[]' $checked>";
                    $test .= "<i class='blue'></i>";
                    $test .= "$caption</label>";
                    $test .= "</div>";
                }
            }
            $test .= "</div>";
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
    echo $test;
?>