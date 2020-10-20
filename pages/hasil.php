<?php
    error_reporting(0);
    session_start();
    include '../cekuser.php';
    include '../config/connection.php';
    $nama = $_SESSION['NamaUser'];
    $namalengkap = $_SESSION['NamaDepan'].' '.$_SESSION['NamaBelakang'];
    $foto = $_SESSION['FotoUser'];
    $namagroup = $_SESSION['NamaGroup'];
    $groupid = $_SESSION['IdGroup'];
    $_SESSION['aktif'] = "hasil";
    $_SESSION['hrefmenu'] = "hasil";
    $_SESSION['Text'] = "";
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
    $links = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$links) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkk = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkk) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkn = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkn) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkr = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkr) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkbo = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkbo) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    function getnama($link, $alternatifid){
        $output = "";
        $sql = "select NamaAlternatif From alternatif Where AlternatifId = $alternatifid";
        $rk = mysqli_query($link, $sql);
        while($h=mysqli_fetch_array($rk)){
            $output = $h['NamaAlternatif'];
        }
        return $output;
    }
    $qs = "Call GetDataBobot()";
    $rs = mysqli_query($links, $qs);
    while($h=mysqli_fetch_array($rs)){
        $datasubkriteria[] = $h;
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
    $qn = "Call GetBrowseTable(5)";
    $rn = mysqli_query($linkn, $qn);
    while($h=mysqli_fetch_array($rn)){
        $databobot[] = $h;
    }
    $qr = "Select r.*, VektorR From rangking r, normalisasi n Where r.AlternatifId = n.AlternatifId Order By VektorV Desc";
    $rr = mysqli_query($linkr, $qr);
    while($h=mysqli_fetch_array($rr)){
        $datahasil[] = $h;
    }
    $qbo = "Select a.AlternatifId, NamaAlternatif, BonusKaryawan, VektorV Total, Round(VektorV / 100, 3) Persentase, "
        . "Round((VektorV * BonusKaryawan), 0) Bonus1, ROUND(((VektorV / 100) * BonusKaryawan), 0) Bonus2, "
        . "BonusKaryawan + ROUND(((VektorV / 100) * BonusKaryawan), 0) Bonus3 "
        . "From alternatif a, rangking r, parameter p Where a.AlternatifId = r.AlternatifId And r.ParameterId = p.ParameterId Order By VektorV Desc";
    $rbo = mysqli_query($linkbo, $qbo);
    while($h=mysqli_fetch_array($rbo)){
        $databonus[] = $h;
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Aplikasi SAW - Hasil Perhitungan</title>
        <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- for ios 7 style, multi-resolution icon of 152x152 -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="assets/images/logo.png">
        <meta name="apple-mobile-web-app-title" content="Flatkit">
        <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" sizes="196x196" href="assets/images/logo.png">

        <!-- style -->
        <link rel="stylesheet" href="assets/animate.css/animate.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/glyphicons/glyphicons.css" type="text/css" />
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/material-design-icons/material-design-icons.css" type="text/css" />

        <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="libs/jquery/datatables/extensions/responsive/responsive.dataTables.css" type="text/css"/>

        <link rel="stylesheet" href="libs/jquery/select2/dist/css/select2.min.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css" type="text/css"/>
        
        <link rel="stylesheet" href="assets/styles/app.css" type="text/css" />
        <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
    </head>
    <body>
        <div class="app" id="app">
            <div id="aside" class="app-aside modal fade nav-dropdown">
                <div class="left navside dark dk" layout="column">
                    <div class="navbar no-radius">
                        <a class="navbar-brand">
                            <div ui-include="'assets/images/logo.svg'"></div>
                            <img src="assets/images/logo.png" alt="" class="hide">
                            <span class="hidden-folded inline">Aplikasi SAW</span>
                        </a>
                    </div>
                    <div flex class="hide-scroll">
                        <nav class="scroll nav-light">
                            <ul class="nav" ui-nav>
                                <li class="nav-header hidden-folded">
                                    <small class="text-muted">Main Menu</small>
                                </li>
<?php
    include '../aksesmenu.php';
?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="content" class="app-content box-shadow-z0" role="main">
                <div class="app-header white box-shadow">
                    <div class="navbar">
                        <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
                            <i class="material-icons">&#xe5d2;</i>
                        </a>
                        <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>
                        <ul class="nav navbar-nav pull-right" style="margin-top: 10px">
                            <li class="nav-item dropdown">
                                <a class="nav-link clear" href data-toggle="dropdown">
                                    <span class="avatar w-32">
                                        <img src="<?php echo $photo.$foto?>" alt="...">
                                        <i class="on b-white bottom"></i>
                                    </span>
                                </a>
<?php
    if($groupid === 0){
?>
                                <div class="dropdown-menu pull-right dropdown-menu-scale">
                                    <a class="dropdown-item" href="login">
                                        <span class="nav-icon" style="margin-top: 3px">
                                            <i class="material-icons">&#xe890;</i>
                                        </span>
                                        <span>Login</span>
                                    </a>
                                </div>
<?php
    }
    else{
?>
                                <div class="dropdown-menu pull-right dropdown-menu-scale">
                                    <a class="dropdown-item" href="profile">
                                        <span class="nav-icon" style="margin-top: 3px">
                                            <i class="material-icons">&#xe416;</i>
                                        </span>
                                        <span>Profile</span>
                                    </a>
                                    <a class="dropdown-item" href="lockscreen">
                                        <span class="nav-icon" style="margin-top: 3px">
                                            <i class="material-icons">&#xe1be;</i>
                                        </span>
                                        <span>Kunci Layar</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout">
                                        <span class="nav-icon" style="margin-top: 3px">
                                            <i class="material-icons">&#xe8ac;</i>
                                        </span>
                                        <span>Log Out</span>
                                    </a>
                                </div>
<?php
    }
?>
                            </li>
                            <li class="nav-item hidden-md-up">
                                <a class="nav-link" data-toggle="collapse" data-target="#collapse">
                                    <i class="material-icons">&#xe5d4;</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="app-footer">
                    <div class="p-a text-xs">
                        <div class="pull-right text-muted">
                            &copy; 2018 <strong>Aplikasi SAW </strong> <span class="hidden-xs-down">- versi 1</span>
                            <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
                        </div>
                        <div class="nav">
                            <span class="text-muted">Design</span>
                            <span class="text-muted">By</span>
                            <span class="text-muted"><strong>Dimas Febriansyah</strong></span>
                        </div>
                    </div>
                </div>
                <div ui-view class="app-body" id="view">
                    <div class="p-a white lt box-shadow">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="m-b-1 _300">Aplikasi SAW</h4>
                                <span class="nav-icon" style='margin-top: 15px'>
                                    <i class="material-icons">&#xe555;
                                        <span ui-include="'assets/images/i_0.svg'"></span>
                                    </i>
                                </span>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Hasil Perhitungan</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="padding">
                        <div class="row">
                            <div class="b-b b-primary nav-active-primary">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href data-toggle="tab" data-target="#kriteria">Bobot Kriteria</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href data-toggle="tab" data-target="#alternatif">Bobot Karyawan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href data-toggle="tab" data-target="#hasil">Hasil Akhir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href data-toggle="tab" data-target="#grafik">Grafik Perangkingan</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content p-a m-b-md">
                                <div class="tab-pane animated fadeIn text-muted active" id="kriteria">
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Data Kriteria</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="databobot1" name="databobot1" class="table databobot table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th width="70" class="text-center">No</th>
                                                            <th>Nama Kriteria</th>
                                                            <th>Tipe Kriteria</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($i=0; $i<count($datakriteria); $i++){
        $no = $i+1;
        echo '<tr>';
        echo '<td class="text-center">'.$no.'</td>';
        echo '<td>'.$datakriteria[$i]['NamaKriteria'].'</td>';
        echo '<td>'.$datakriteria[$i]['TipeKriteria'].'</td>';
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Data Bobot Kriteria</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="databobot2" name="databobot2" class="table databobot table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th width="70" class="text-center">No</th>
                                                            <th>Nama Kriteria</th>
                                                            <th>Nama Sub Kriteria</th>
                                                            <th class="text-center">Nilai Bobot</th>
                                                            <th>Keterangan Bobot</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($i=0; $i<count($datasubkriteria); $i++){
        $no = $i+1;
        echo '<tr>';
        echo '<td class="text-center">'.$no.'</td>';
        echo '<td>'.$datasubkriteria[$i]['NamaKriteria'].'</td>';
        echo '<td>'.$datasubkriteria[$i]['NamaSubkriteria'].'</td>';
        echo '<td class="text-center">'.$datasubkriteria[$i]['NilaiBobot'].'</td>';
        echo '<td>'.$datasubkriteria[$i]['KetNilai'].'</td>';
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn text-muted" id="alternatif">
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Data Karyawan</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="dataalternatif1" name="dataalternatif1" class="table dataalternatif table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th width="40" class="text-center">No</th>
                                                            <th width="120">Nama Karyawan</th>
<?php
    for($r=0; $r<count($datakriteria); $r++){
        echo '<th class="">'.$datakriteria[$r][NamaKriteria].'</th>';
    }
?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($a=0; $a<count($dataalternatif); $a++){
        $no = $a+1;
        echo '<tr>';
        echo '<td class="text-center">'.$no.'</td>';
        echo '<td>'.$dataalternatif[$a][1].'</td>';
        for($k=0; $k<count($datakriteria); $k++){
            $qp = "Select SubkriteriaId From nilai_karyawan where AlternatifId = ".$dataalternatif[$a][0]." And KriteriaId = ".$datakriteria[$k][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $datanilai = $rec['SubkriteriaId'];
            $qket = "Select NamaSubkriteria From subkriteria Where SubkriteriaId = $datanilai";
            $rket = mysqli_query($linkb, $qket);
            $rec1 = mysqli_fetch_array($rket);
            $ket = $rec1['NamaSubkriteria'];
            if ((int) $datakriteria[$k][0] === 1){echo '<td style="width: 170px">'.$ket.'</td>';} else{echo '<td style="width: 150px">'.$ket.'</td>';}
        }
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Data Ranting Kecocokan Karyawan</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="dataalternatif2" name="dataalternatif2" class="table dataalternatif table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2">Nama Karyawan</th>
                                                            <th colspan="<?php echo count($datakriteria)?>" class="text-center">Kriteria</th>
                                                        </tr>
                                                        <tr>
<?php
    for($r=0; $r<count($datakriteria); $r++){
        echo '<th class="text-center">'.$datakriteria[$r][NamaKriteria].'</th>';
    }
?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($a=0; $a<count($dataalternatif); $a++){
        echo '<tr>';
        echo '<td>'.$dataalternatif[$a][1].'</td>';
        for($k=0; $k<count($datakriteria); $k++){
            $qp = "Select SubkriteriaId From nilai_karyawan where AlternatifId = ".$dataalternatif[$a][0]." And KriteriaId = ".$datakriteria[$k][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $datanilai = $rec['SubkriteriaId'];
            $qket = "Select JmlNilai From nilai n, bobot b Where b.NilaiId = n.NilaiId And SubkriteriaId = $datanilai";
            $rket = mysqli_query($linkb, $qket);
            $rec1 = mysqli_fetch_array($rket);
            $ket = $rec1['JmlNilai'];
            echo '<td class="text-center">'.$ket.'</td>';
        }
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn text-muted" id="hasil">
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Normalisasi</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="datahasil1" name="dataalternatif2" class="table datahasil table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Karyawan</th>
<?php
    for($r=0; $r<count($datakriteria); $r++){
        echo '<th class="text-center">'.$datakriteria[$r][NamaKriteria].'</th>';
    }
?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($a=0; $a<count($dataalternatif); $a++){
        echo '<tr>';
        echo '<td>'.$dataalternatif[$a][1].'</td>';
        for($k=0; $k<count($datakriteria); $k++){
            $qp = "Select VektorX From normalisasi where AlternatifId = ".$dataalternatif[$a][0]." And KriteriaId = ".$datakriteria[$k][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $VekX = $rec['VektorX'];
            echo '<td class="text-center">'.$VekX.'</td>';
        }
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Perangkingan</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="datahasil2" name="datahasil2" class="table datahasil table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Keterangan</th>
<?php
    for($r=0; $r<count($datakriteria); $r++){
        echo '<th class="text-center">'.$datakriteria[$r][NamaKriteria].'</th>';
    }
?>
                                                            <th>Total</th>
                                                            <th>Rangking</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($a=0; $a<count($dataalternatif); $a++){
        $total = 0;
        $no = $a + 1;
        for($k=0; $k<count($datakriteria); $k++){
            $qp = "Select VektorR From normalisasi where AlternatifId = ".$dataalternatif[$a][0]." And KriteriaId = ".$datakriteria[$k][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $VekR = $rec['VektorR'];
            $total = $total + $VekR;
        }
        $hasil[] = array($total, $dataalternatif[$a][0]);
    }
    sort($hasil);
    for($i=count($hasil)-1; $i>=0; $i--){
        $rank = count($hasil) - $i;
        $nama = getnama($linkb, $hasil[$i][1]);
        $hasil_akhir[$hasil[$i][1]]=array($hasil[$i][0], $rank);
        $urutan[] = array($hasil[$i][0], (int) $hasil[$i][1], $nama, $rank);
    }
    for($a=0; $a<count($urutan); $a++){
        echo '<tr>';
        echo '<td>'.$urutan[$a][2].'</td>';
        $total = 0;
        $no = $a + 1;
        for($k=0; $k<count($datakriteria); $k++){
            $qp = "Select VektorR From normalisasi where AlternatifId = ".$urutan[$a][1]." And KriteriaId = ".$datakriteria[$k][0];
            $rp = mysqli_query($linkb, $qp);
            $rec = mysqli_fetch_array($rp);
            $VekR = $rec['VektorR'];
            $total = $total + $VekR;
            echo '<td class="text-center">'.$VekR.'</td>';
        }
        echo '<td class="text-center">'.$total.'</td>';
        echo '<td class="text-center">'.$hasil_akhir[$urutan[$a][1]][1].'</td>';
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-header">
                                            <h2>Bonus Karyawan</h2>
                                        </div>
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table id="datahasil3" name="datahasil3" class="table datahasil table-bordered table-hover" 
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th width="40" class="text-center">No</th>
                                                            <th>Nama Karyawan</th>
                                                            <th class="text-center">Limit Bonus</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Persentase</th>
                                                            <th class="text-center">Bonus Karyawan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    for($b=0; $b<count($databonus); $b++){
        $no = $b+1;
        echo '<tr>';
        echo '<td class="text-center">'.$no.'</td>';
        echo '<td>'.$databonus[$b][1].'</td>';
        echo '<td class="text-right">'.number_format($databonus[$b][2], 0, ",", ".").'</td>';
        echo '<td class="text-center">'.$databonus[$b][3].'</td>';
        echo '<td class="text-center">'.$databonus[$b][4].'</td>';
        echo '<td class="text-right">'.number_format($databonus[$b][7], 0, ",", ".").'</td>';
        echo '</tr>';
    }
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeIn text-muted" id="grafik">
                                    <div class="box">
                                        <div class="box-header">
                                            <h3>Grafik Perangkingan</h3>
                                            <small class="block text-muted">Karyawan, Bonus, Penilaian</small>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="chart-container">
                                                        <div class="chart has-fixed-height-1" id="line_bar"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="chart-container">
                                                        <div class="chart has-fixed-height-1" id="line_bar1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="switcher">
                <div class="switcher box-color dark-white text-color" id="sw-theme">
                    <a href ui-toggle-class="active" target="#sw-theme" class="box-color dark-white text-color sw-btn">
                        <i class="fa fa-gear"></i>
                    </a>
                    <div class="box-header">
                        <h2>Pengaturan Theme</h2>
                    </div>
                    <div class="box-divider"></div>
                    <div class="box-body">
                        <p class="hidden-md-down">
                            <label class="md-check m-y-xs"  data-target="folded">
                                <input type="checkbox">
                                <i class="green"></i>
                                <span class="hidden-folded">Sembunyikan Aside</span>
                            </label>
                            <label class="md-check m-y-xs" data-target="boxed">
                                <input type="checkbox">
                                <i class="green"></i>
                                <span class="hidden-folded">Layar Kotak</span>
                            </label>
                            <label class="m-y-xs pointer" ui-fullscreen>
                                <span class="fa fa-expand fa-fw m-r-xs"></span>
                                <span>Mode Layar Penuh</span>
                            </label>
                        </p>
                        <p>Warna:</p>
                        <p data-target="themeID">
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'primary', accent:'accent', warn:'warn'}">
                                <input type="radio" name="color" value="1">
                                <i class="primary"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'accent', accent:'cyan', warn:'warn'}">
                                <input type="radio" name="color" value="2">
                                <i class="accent"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warn', accent:'light-blue', warn:'warning'}">
                                <input type="radio" name="color" value="3">
                                <i class="warn"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'success', accent:'teal', warn:'lime'}">
                                <input type="radio" name="color" value="4">
                                <i class="success"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'info', accent:'light-blue', warn:'success'}">
                                <input type="radio" name="color" value="5">
                                <i class="info"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'blue', accent:'indigo', warn:'primary'}">
                                <input type="radio" name="color" value="6">
                                <i class="blue"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warning', accent:'grey-100', warn:'success'}">
                                <input type="radio" name="color" value="7">
                                <i class="warning"></i>
                            </label>
                            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'danger', accent:'grey-100', warn:'grey-300'}">
                                <input type="radio" name="color" value="8">
                                <i class="danger"></i>
                            </label>
                        </p>
                        <p>Theme:</p>
                        <div data-target="bg" class="text-u-c text-center _600 clearfix">
                            <label class="p-a col-xs-6 light pointer m-a-0">
                                <input type="radio" name="theme" value="" hidden>
                                Terang
                            </label>
                            <label class="p-a col-xs-6 grey pointer m-a-0">
                                <input type="radio" name="theme" value="grey" hidden>
                                Abu-abu
                            </label>
                            <label class="p-a col-xs-6 dark pointer m-a-0">
                                <input type="radio" name="theme" value="dark" hidden>
                                Gelap
                            </label>
                            <label class="p-a col-xs-6 black pointer m-a-0">
                                <input type="radio" name="theme" value="black" hidden>
                                Hitam
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- build:js scripts/app.html.js -->
        <!-- jQuery -->
        <script src="libs/jquery/jquery/dist/jquery.js"></script>
        <!-- Bootstrap -->
        <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
        <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
        <!-- core -->
        <script src="libs/jquery/underscore/underscore-min.js"></script>
        <script src="libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
        <script src="libs/jquery/PACE/pace.min.js"></script>
<!--
        <script src="scripts/config.lazyload.js"></script>
-->
        <script src="scripts/palette.js"></script>
        <script src="scripts/ui-load.js"></script>
        <script src="scripts/ui-include.js"></script>
        <script src="scripts/ui-device.js"></script>
        <script src="scripts/ui-form.js"></script>
        <script src="scripts/ui-nav.js"></script>
        <script src="scripts/ui-screenfull.js"></script>
        <script src="scripts/ui-scroll-to.js"></script>
        <script src="scripts/ui-toggle-class.js"></script>

        <script src="libs/js/echarts/echarts-all.js"></script>

        <script src="libs/jquery/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="libs/jquery/datatables/media/js/dataTables.bootstrap.js"></script>
        <script src="libs/jquery/datatables/extensions/responsive/dataTables.responsive.js"></script>
        <script src="libs/jquery/datatables/extensions/button/dataTables.buttons.js"></script>
        <script src="libs/jquery/datatables/extensions/button/buttons.html5.js"></script>
        <script src="libs/jquery/datatables/extensions/button/buttons.print.js"></script>
        <script src="libs/jquery/datatables/extensions/jszip/jszip.min.js"></script>
        <script src="libs/jquery/datatables/extensions/pdfmake/pdfmake.min.js"></script>
        <script src="libs/jquery/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
        <script src="libs/jquery/select2/dist/js/select2.min.js"></script>
        <script src="libs/jquery/select2/dist/js/i18n/id.js"></script>

        <script src="scripts/app.js"></script>
<?php
    $datag = "[";
    $a = 0;
    for($i=0;$i<count($dataalternatif);$i++){
        $a += i+1;
        if($a === count($dataalternatif)){$datag .= "'".$dataalternatif[$i]['NamaAlternatif']."'";}
        else{$datag .= "'".$dataalternatif[$i]['NamaAlternatif']."', ";}
    }
    $datag .= "]";
?>
        <script>
            $(document).ready(function(){
                data = [];
                data2 = [];
                var databobot, dataalternatif, datahasil;
                var mychart = echarts.init(document.getElementById('line_bar'));
                var mychart2 = echarts.init(document.getElementById('line_bar1'));
                var line_bar_options = {
                    /*
                    title : {
                        text: 'Grafik Perangkingan',
                        subtext: 'SPK Penilaian Karyawan - Simple Additive Weighting (SAW)',
                        x: 'center'
                    },
                    */
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        x: 'center',
                        y: 'top',
                        data: ['Bonus Karyawan']
                    },
                    calculable: true,
                    toolbox: {
                        show: true,
                        orient: 'vertical',
                        feature: {
                            restore: {
                                show: true,
                                title: 'Memuat Ulang'
                            },
                            saveAsImage: {
                                show: true,
                                title: 'Simpan sebagai gambar',
                                lang: ['Save']
                            }
                        }
                    },
                    xAxis: [
                        {
                            type : 'category',
                            data : <?php echo $datag;?>,
                            axisLabel: {
                                show: true,
                                interval: 'auto',
                                rotate: 20,
                                margin: 8
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type : 'value'
                        }
                    ],
                    series: [
                        {
                            name: 'Bonus Karyawan',
                            type: 'bar',
                            itemStyle: {normal: {color: 'rgba(138, 237, 197, 1)'}},
                            data: data
                        }
                    ]
                };
                var line_bar_options1 = {
                    /*
                    title : {
                        text: 'Grafik Perangkingan',
                        subtext: 'SPK Penilaian Karyawan - Simple Additive Weighting (SAW)',
                        x: 'center'
                    },
                    */
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        x: 'center',
                        y: 'top',
                        data: ['Penilaian Karyawan']
                    },
                    calculable: true,
                    toolbox: {
                        show: true,
                        orient: 'vertical',
                        feature: {
                            restore: {
                                show: true,
                                title: 'Memuat Ulang'
                            },
                            saveAsImage: {
                                show: true,
                                title: 'Simpan sebagai gambar',
                                lang: ['Save']
                            }
                        }
                    },
                    xAxis: [
                        {
                            type : 'category',
                            data : <?php echo $datag;?>,
                            //data : 'alternatif',
                            axisLabel: {
                                show: true,
                                interval: 'auto',
                                rotate: 20,
                                margin: 8
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type : 'value'
                        }
                    ],
                    series: [
                        {
                            name: 'Penilaian Karyawan',
                            type: 'bar',
                            itemStyle: {normal: {color: 'rgba(252, 145, 87, 1)'}},
                            data: data2
                        }
                    ]
                };
                function GetGrafikB(){
                    //var datal=[];
                    $.ajax({
                        type: "post",
                        async: false,
                        url: "data/grafikrangking.php?id=1",
                        dataType: "json",
                        success: function(result){
                            if(result){
                                for(var i = 0; i < result.length; i++){
                                    var item = {value: result[i].Jumlah, name:result[i].NamaAlternatif};
                                    data.push(item);
                                }
                            }
                        }
                    });
                    return data;
                };
                function GetGrafikP(){
                    //var datal=[];
                    $.ajax({
                        type: "post",
                        async: false,
                        url: "data/grafikrangking.php?id=2",
                        dataType: "json",
                        success: function(result){
                            if(result){
                                for(var i = 0; i < result.length; i++){
                                    var item = {value: result[i].Jumlah, name:result[i].NamaAlternatif};
                                    data2.push(item);
                                }
                            }
                        }
                    });
                    return data2;
                };
                $.extend($.fn.dataTable.defaults, {
                    searching: false,
                    paging: true,
                    ordering: false,
                    autoWidth: false,
                    responsive: true,
                    info: true,
                    dom: '<"datatable-header row"<"col-md-6"l>f<"col-md-6 text-right"B>><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    buttons: [
                        {extend: 'print', className: 'btn btn-default'},
                        {extend: 'excelHtml5', className: 'btn success'},
                        {extend: 'csvHtml5', className: 'btn primary'},
                        {extend: 'pdfHtml5', className: 'btn danger'}
                    ],
                    language: {
                        search: '<span>Cari: </span> _INPUT_',
                        lengthMenu: '<span>Tampil: </span> _MENU_ <span> data</span>' ,
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "zeroRecords": "Tidak ada data yang cocok dengan kriteria pencarian anda",
                        "infoFiltered": "(Tersaring dari _MAX_ total data)",
                        "emptyTable": "Tidak ada data yang di tampilkan",
                        paginate: {'first': 'Pertama', 'last': 'Terakhir', 'next': 'Selanjutnya', 'previous': 'Sebelumnya'}
                    }
                });
                databobot = $('.databobot').DataTable();
                dataalternatif = $('.dataalternatif').DataTable();
                datahasil = $('.datahasil').DataTable();
                $('.dataTables_length select').select2({
                    theme: 'bootstrap'
                });
                GetGrafikB();
                GetGrafikP();
                mychart.setOption(line_bar_options);
                mychart2.setOption(line_bar_options1);
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
                    mychart.resize();
                    mychart2.resize();
                    GetGrafikB();
                    GetGrafikP();
                });
            });
        </script>
    </body>
</html>
