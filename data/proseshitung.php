<?php
    include '../config/connection.php';
    include '../config/function.php';
    ini_set('max_execution_time', 600);
    //session_start();
    $linka = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linka) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkb = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkb) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkk = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkk) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkp = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkp){
        printf("Tidak bisa koneksi ke MySQL Server.", mysqli_connect_error());
        exit;
    }
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link){
        printf("Tidak bisa koneksi ke MySQL Server.", mysqli_connect_error());
        exit;
    }
    function getparameter($link, $jml){
        //$output = 0;
        $sql = "Select ParameterId From parameter Where Kondisi = getkondisi($jml)";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $parameterid = (int) $row['ParameterId'];
        }
        $output = $parameterid;
        return $output;
    }
    $qk = "Call GetBrowseTable(4)";
    $rk = mysqli_query($linkk, $qk);
    while($h=mysqli_fetch_array($rk)){
        $datakriteria[] = $h;
    }
    $qa = "Call GetBrowseTable(3)";
    $ra = mysqli_query($linka, $qa);
    while($h=mysqli_fetch_array($ra)){
        $dataalternatif[] = $h;
    }
    $sqld1 = "Truncate Table normalisasi";
    $resultd1 = mysqli_query($link, $sqld1);
    $sqld2 = "Truncate Table rangking";
    $resultd2 = mysqli_query($link, $sqld2);
    
    // dapatkan nilai \\
    for($a=0; $a<count($dataalternatif); $a++){
        for($k=0; $k<count($datakriteria); $k++){
            $qp = "Select SubkriteriaId From nilai_karyawan where AlternatifId = ".$dataalternatif[$a][0]." And KriteriaId = ".$datakriteria[$k][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $datanilai = $rec['SubkriteriaId'];
            $qnil = "Select JmlNilai From nilai n, bobot b Where b.NilaiId = n.NilaiId And SubkriteriaId = $datanilai";
            $rnil = mysqli_query($linkb, $qnil);
            $rec1 = mysqli_fetch_array($rnil);
            $nilai = $rec1['JmlNilai'];
            $matriks_x[$a+1][$k+1] = $nilai;
        }
    }
    /* normalisasi matrik x */
    for($i=0; $i<count($dataalternatif); $i++){
        for($ii=0; $ii<count($datakriteria); $ii++){
            $arr='';
            for($j=0; $j<count($dataalternatif); $j++){
                $arr[] = $matriks_x[$j+1][$ii+1];
            }
            if($datakriteria[$ii][2]=='Benefit'){
                if($matriks_x[$i+1][$ii+1]>0){$jml = $matriks_x[$i+1][$ii+1] / max($arr);}else{$jml = 0;}
            }
            else{
                if(min($arr)>0){$jml = min($arr) / $matriks_x[$i+1][$ii+1];}else{$jml = 0;}
            }
            $matriks_1[$i+1][$ii+1] = round($jml, 2);
            $qnormal = "Insert Into normalisasi(AlternatifId, KriteriaId, VektorX) "
                . "Values('".$dataalternatif[$i][0]."', '".$datakriteria[$ii][0]."', '".round($jml, 2)."')";
            $rnormal[] = mysqli_query($link, $qnormal);
        }
    }
    /* normalisasi matrik r */
    for($i=0; $i<count($dataalternatif); $i++){
        $jmlr=0;
        for($ii=0; $ii<count($datakriteria); $ii++){
            $qp = "Select SubkriteriaId From nilai_karyawan where AlternatifId = ".$dataalternatif[$i][0]." And KriteriaId = ".$datakriteria[$ii][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $datanilai = $rec['SubkriteriaId'];
            $qnil = "Select JmlNilai From nilai n, bobot b Where b.NilaiId = n.NilaiId And SubkriteriaId = $datanilai";
            $rnil = mysqli_query($linkb, $qnil);
            $rec1 = mysqli_fetch_array($rnil);
            $nilai = (float) $rec1['JmlNilai'];
            $nilaim = (float) $matriks_1[$i+1][$ii+1];
            $vekr = round($nilai * $nilaim, 2);
            $qnormal = "Update normalisasi Set VektorR = '".$vekr."' Where AlternatifId = '".$dataalternatif[$i][0]."' "
                . "And KriteriaId = '".$datakriteria[$ii][0]."'";
            $rnormal[] = mysqli_query($link, $qnormal);
            $jmlr = $jmlr + $vekr;//($nilai * $matriks_1[$i+1][$ii+1]);
        }
        $hasil[]=array(round($jmlr, 2), $dataalternatif[$i][0]);
        $param = getparameter($linkp, round($jmlr, 2));
        $qhasil = "Insert Into rangking(AlternatifId, VektorV, ParameterId) "
            . "Values('".$dataalternatif[$i][0]."', '".round($jmlr, 2)."', $param)";
        $rhasil[] = mysqli_query($link, $qhasil);
    }
    $output1 = array_search("false", $rhasil);
    $output = $rhasil[$output1];
    if($output){echo "true";} else{echo "false";}
?>