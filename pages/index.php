<?php
    error_reporting(0);
    session_start();
    include '../cekuser.php';
    include '../config/connection.php';
    $nama = $_SESSION['NamaUser'];
    $namalengkap = $_SESSION['NamaDepan'].' '.$_SESSION['NamaBelakang'];
    $foto = $_SESSION['FotoUser'];
    $ftpro = "gambar1.jpg";
    $ftpro1 = "gambar2.png";
    $namagroup = $_SESSION['NamaGroup'];
    $groupid = $_SESSION['IdGroup'];
    $_SESSION['aktif'] = "home";
    $_SESSION['hrefmenu'] = "home";
    $_SESSION['Text'] = "";
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Aplikasi SAW - Halaman Utama</title>
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
                                <!--
                                <li class="active">
                                    <a href="home">
                                        <span class="nav-icon" style="margin-top: 10px">
                                            <i class="material-icons">&#xe3fc;
                                                <span ui-include="'assets/images/i_0.svg'"></span>
                                            </i>
                                        </span>
                                        <span class="nav-text">Halaman Utama</span>
                                    </a>
                                </li>
                                -->
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
                                    <i class="material-icons">&#xe3fc;
                                        <span ui-include="'assets/images/i_0.svg'"></span>
                                    </i>
                                </span>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Halaman Utama</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-bg1">
                            <img src="<?php echo $photo.$ftpro?>">
                        </div>
                        <div class="p-a-md">
                            <div class="row">
                                <div class="col-sm-7">
                                    <a href class="pull-left m-r-md">
                                        <span class="avatar w-128 opacity">
                                            <img src="<?php echo $photo.$ftpro1?>">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="padding">
                        <div class="row">
                            <div class="m-t p-a-sm">
                                <ul class="list">
                                    <li class="list-item">
                                        <div class="clear">
                                            <h5 class="m-a-0 m-b m-t">Profile Perusahaan</h5>
                                            <p class=" text-muted m-b-sm" style="text-align: justify; font-size: 16px">PT. Maharupa Gatra (MG) Jakarta adalah sebuah perusahaan swasta yang didirikan pada tahun 1970 yang bergerak dalam bidang distribusi alat-alat musik dan alat olah raga.</p>
                                            <p class="text-muted m-b-sm" style="text-align: justify; font-size: 16px">Dengan adanya kebutuhan masyarakat PT. Maharupa Gatra (MG) Jakarta. Menciptakan sebuah produk yang harganya bisa terjangkau oleh semua masyarakat, pada tahun 1980 PT Maharupa Gatra (MG) Jakarta sukses mendirikan cabang di daerah, Jakarta, Surabaya, Bali, dan Kalimantan yang mempunyai jumlah karyawan sebanyak 1000 karyawan.</p>
                                            <p class="text-muted m-b-sm" style="text-align: justify; font-size: 16px">Selain di Indonesia Produk PT Maharupa Gatra (MG) Jakarta juga mengimpor alat-alat olah raga dan alat-alat musik dari Negara seperti Malaysia, RRC, Inggris dan Amerika.</p>
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="clear">
                                            <h5 class="m-a-0 m-b m-t">Visi Dan Misi Perusahaan</h5>
                                            <p class="text-muted m-b-sm" style="text-align: justify; font-size: 16px">Adanya visi dan misi merupakan syarat wajib bagi sebuah perusahan atau organisasi. Setiap perusahaan atau organisasi memiliki visi dan misi yang berbeda, semua tergantung tujuan yang akan dicapai oleh masing – masing perusahaan atau organisasi.</p>
                                        </div>
                                    </li>
                                </ul>
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
                
        <script src="scripts/palette.js"></script>
        <script src="scripts/ui-load.js"></script>
        <script src="scripts/ui-include.js"></script>
        <script src="scripts/ui-device.js"></script>
        <script src="scripts/ui-form.js"></script>
        <script src="scripts/ui-nav.js"></script>
        <script src="scripts/ui-screenfull.js"></script>
        <script src="scripts/ui-scroll-to.js"></script>
        <script src="scripts/ui-toggle-class.js"></script>
        
        <script src="scripts/app.js"></script>
        
    </body>
</html>
