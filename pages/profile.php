<?php
    error_reporting(0);
    session_start();
    include '../cekuser.php';
    include '../config/connection.php';
    $groupid = $_SESSION['IdGroup'];
    if($groupid === 0){
?>
        <link rel="stylesheet" href="assets/animate.css/animate.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/glyphicons/glyphicons.css" type="text/css" />
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/material-design-icons/material-design-icons.css" type="text/css" />

        <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="assets/styles/app.css" type="text/css" />
        <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
        <link rel="stylesheet" href="libs/jquery/sweetalert2/dist/sweetalert2.css"/>
        <script src="libs/jquery/jquery/dist/jquery.js"></script>
        <!-- Bootstrap -->
        <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
        <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
        <!-- core -->
        
        <script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>

        <script>
            $(document).ready(function(){
                swal({
                    title: "Aplikasi SAW",
                    text: "Maaf, anda tidak bisa mengakses web ini...!",
                    type: "info",
                    confirmButtonColor: "#2196F3"
                }).then(function(){
                    window.location = "home";
                });
            });
        </script>
<?php
    }
    else{
    $nama = $_SESSION['NamaUser'];
    $namalengkap = $_SESSION['NamaDepan'].' '.$_SESSION['NamaBelakang'];
    $foto = $_SESSION['FotoUser'];
    $namagroup = $_SESSION['NamaGroup'];
    $_SESSION['aktif'] = "profile";
    $_SESSION['hrefmenu'] = "profile";
    $userid = $_SESSION['IdUser'];
    $linkp = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkp) {
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($linkp, "Select u.*, NamaGroup From userlogin u, groupuser g Where u.GroupId = g.GroupId And u.UserId = '$userid'")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $dataprofile[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($linkp);
    $iduser = $dataprofile[0]['UserId'];
    $namauser = $dataprofile[0]['NamaUser'];
    $passuser = $dataprofile[0]['PassUser'];
    $namadepan = $dataprofile[0]['NamaDepan'];
    $namabelakang = $dataprofile[0]['NamaBelakang'];
    $groupid = $dataprofile[0]['GroupId'];
    $gambar = $dataprofile[0]['FotoUser'];
    $email = $dataprofile[0]['EmailUser'];
    $namagroup1 = $dataprofile[0]['NamaGroup'];
    if($gambar === '' || $gambar === null){$gambar = $foto;}
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Aplikasi SAW - Profile User</title>
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
        <link rel="stylesheet" href="libs/jquery/sweetalert2/dist/sweetalert2.css"/>
        <link rel="stylesheet" href="libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="libs/jquery/datatables/extensions/responsive/responsive.dataTables.css" type="text/css"/>

        <link rel="stylesheet" href="libs/jquery/select2/dist/css/select2.min.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/bootstrap-file-input/fileinput.css" type="text/css"/>
        
        <link rel="stylesheet" href="assets/styles/app.css" type="text/css" />
        <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
        <style>
            .control-label1{
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 7px;
                text-align: right;
            }
        </style>
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
                            &copy; 2018 <strong>Aplikasi SAW </strong> <span class="hidden-xs-down">- Versi 1</span>
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
                    <div class="item">
                        <div class="item-bg">
                            <img src="<?php echo $photo.$gambar?>" class="blur opacity-3">
                        </div>
                        <div class="p-a-md">
                            <div class="row m-t">
                                <div class="col-sm-7">
                                    <a href class="pull-left m-r-md">
                                        <span class="avatar w-128">
                                            <img src="<?php echo $photo.$gambar?>">
                                            <i class="on b-white"></i>
                                        </span>
                                    </a>
                                    <div class="clear m-b">
                                        <h3 class="m-a-0 m-b-xs"><?php echo $namadepan." ".$namabelakang?></h3>
                                        <p class="text-muted"><span class="m-r"><?php echo $namagroup1?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="padding">
                        <div class="row">
                            <form action="simpanprofile" class="form-horizontal" id="profileform" name="profileform" method="post"
                                enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    <input class="form-control" id="userid" maxlength="3" name="userid" type="hidden" readonly 
                                        value="<?php echo $iduser?>">
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="namauser">Nama User</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="namauser" maxlength="25" name="namauser" type="text" placeholder="Nama User"
                                                value="<?php echo $namauser?>" autofocus>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="passuser">Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="passuser" maxlength="32" name="passuser" type="password" placeholder="Password User"
                                                value="<?php echo $passuser?>">
                                            <div class="help-block">Abaikan jika tidak ada perubahan</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="passconfirm">Konfir. Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="passconfirm" maxlength="32" name="passconfirm" type="password" 
                                                placeholder="Konfirmasi Password" value="<?php echo $passuser?>">
                                            <div class="help-block">Abaikan jika tidak ada perubahan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="namauser">Nama</label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" id="namadepan" maxlength="25" name="namadepan" type="text" 
                                                        placeholder="Nama Depan" value="<?php echo $namadepan?>">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" id="namabelakang" maxlength="25" name="namabelakang" type="text" 
                                                        placeholder="Nama Belakang" value="<?php echo $namabelakang?>">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="emailuser">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="emailuser" maxlength="30" name="emailuser" type="text" placeholder="Email"
                                                value="<?php echo $email?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="groupid">Group</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="groupid" name="groupid" type="hidden" value="<?php echo $groupid?>">
                                            <select data-placeholder="Pilih Group ...." class="select" id="groupid1" name="groupid1" disabled>
<?php
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    $groupidd = (int) $groupid;
    if ($result = mysqli_query($link, "call GetBrowseTable(1)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $groupidb = (int) $rec['GroupId'];
                if($groupidd === $groupidb){echo "<option value='".$rec['GroupId']."' selected>".$rec['NamaGroup']."</option>";}
                else{echo "<option value=".$rec['GroupId'].">".$rec['NamaGroup']."</option>";}
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="fotouser">Foto</label>
                                        <div class="col-md-9">
                                            <input id="foto" name="foto" type="hidden" value="<?php echo $gambar?>">
                                            <input id="fotouser" name="fotouser" type="file" class="file" accept="image/*" data-show-upload="false"
                                                data-language="id">
                                            <div class="help-block">Abaikan jika tidak ada perubahan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions row text-center">
                                    <button id="simpan" name="simpan" type="submit" class="btn primary">Simpan</button>
                                </div>
                            </form>
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
        <script src="libs/jquery/jquery/dist/jquery-form.min.js"></script>
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
        
        <script src="libs/jquery/select2/dist/js/select2.min.js"></script>
        <script src="libs/jquery/select2/dist/js/i18n/id.js"></script>
        <script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>
        <script src="libs/jquery/bootstrap-file-input/fileinput.js"></script>
        <script src="libs/jquery/bootstrap-file-input/id.js"></script>
        <script src="libs/jquery/validation/validate.min.js"></script>
        <script src="libs/jquery/validation/localization/messages_id.min.js"></script>

        <script src="scripts/app.js"></script>
        <script>
            $(document).ready(function(){
                $('.select').select2({
                    width: '100%',
                    language:'id'
                });
                $("#fotouser").fileinput();
                function disabled(boolean){
                    $("#emailuser").attr('readOnly', boolean);
                    $("#passuser").attr('readOnly', boolean);
                    $("#passconfirm").attr('readOnly', boolean);
                    $("#namadepan").attr('readOnly', boolean);
                    $("#namabelakang").attr('readOnly', boolean);
                    $("#groupid").attr('disabled', boolean);
                    $("#simpan").attr('disabled', boolean);
                }
                $("#namauser").on('change', function(){
                    $.ajax({
                        url: "data/ceknamauser.php",
                        type: "GET",
                        data:{namauser: $('#namauser').val()},
                        success: function(data){
                            if(data === 'true'){
                                swal({
                                    title: "Profile",
                                    text: "Nama user sudah ada!!, silahkan coba dengan yang lain",
                                    type: "warning",
                                    confirmButtonClass: "btn primary",
                                    buttonsStyling: false
                                }).then(function(){
                                    disabled(true);
                                });
                            }
                            else{disabled(false);}
                        }
                    });
                });
                $('#profileform').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules:{
                        namauser: {minlength : 3, required : true},
                        emailuser: {email : true},
                        passuser: {required : true, minlength : 3, maxlength : 32},
                        passconfirm: {required : true, minlength : 3, maxlength : 32, equalTo : '#passuser'},
                        namadepan: {required : true}
                    },
                    messages:{
                        namauser: {required : "Masukan Nama User", minlength : "Masukan Nama User Minimal 3 Karakter"},
                        emailuser: {email : "Masukkan Email"},
                        passuser: {required : "Masukkan Password Anda", minlength : "Password minimal 3 karakter", maxlength : "Password miksimal 32 karakter"},
                        passconfirm: {required : "Masukkan Konfirmasi Password Anda", minlength : "Konfirmasi Password minimal 3 karakter", maxlength : "Konfirmasi Password miksimal 32 karakter", equalTo : "Konfirmasi Password Tidak Sama"},
                        namadepan: {required : "Masukkan Nama Depan Anda"}
                    },
                    invalidHandler: function(event, validator){
                        $('.alert-danger', $('#groupform')).show();
                    },

                    highlight: function(e){
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function(e){
                        $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                        $(e).remove();
                    },

                    errorPlacement: function(error, element){
                        if(element.is(':checkbox') || element.is(':radio')) {
                            var controls = element.closest('div[class*="col-"]');
                            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                            else error.insertAfter(element.nextAll('.labels:eq(0)').eq(0));
                        }
                        else error.insertAfter(element);
                    },

                    submitHandler: function(form){}
                });
                $("#profileform").on('submit', function(e){
                    e.preventDefault();
                    var namauser = $('#namauser').val();
                    var passuser = $('#passuser').val();
                    var passconfirm = $('#passconfirm').val();
                    var namadepan = $('#namadepan').val();
                    var lennamauser = namauser.length;
                    var lenpassuser = passuser.length;
                    var lenpassconfirm = passconfirm.length;
                    if(namauser === '' || passuser === '' || passconfirm === '' || namadepan === ''){return false;}
                    else if(lennamauser < 3 || lenpassuser < 3 || lenpassconfirm < 3){return false;}
                    else{
                        $(this).ajaxSubmit({
                            success: function(data){
                                if(data === 'true'){
                                    swal({
                                        title: "Profile",
                                        text: "Data profile tersimpan",
                                        type: "success",
                                        confirmButtonClass: "btn primary",
                                        buttonsStyling: false
                                    }).then(function(){
                                        window.location = "home";
                                    });
                                }
                                else{
                                    swal({
                                        title: "Profile",
                                        text: "Data profile tidak tersimpan!",
                                        type: "error",
                                        confirmButtonClass: "btn primary",
                                        buttonsStyling: false
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
<?php
    }
?>