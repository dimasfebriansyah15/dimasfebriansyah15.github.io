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
    $_SESSION['aktif'] = "bobot";
    $_SESSION['hrefmenu'] = "bobot";
    $_SESSION['Text'] = "Nilai Data";
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Aplikasi SAW - Bobot Kriteria</title>
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
        <!--<link rel="stylesheet" href="libs/jquery/datatables/extensions/button/buttons.dataTables.css" type="text/css"/>-->

        <link rel="stylesheet" href="libs/jquery/select2/dist/css/select2.min.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css" type="text/css"/>

        
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
                                    <i class="material-icons">&#xe8f0;
                                        <span ui-include="'assets/images/i_1.svg'"></span>
                                    </i>
                                </span>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Nilai Data</li>
                                    <li class="breadcrumb-item active">Bobot Kriteria</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="padding">
                        <div class="row">
                            <div class="box">
                                <div class="box-header">
                                    <h2>Data Bobot Kriteria</h2>
                                    <a href="addbobot" class="pull-right" data-toggle='modal' data-target='#remoteModal' data-backdrop='static'
                                        ui-toggle-class="zoom" ui-target="#animate">
                                        <button class="btn primary">
                                            <span class="nav-icon">
                                                <i class="material-icons">&#xe8f0;
                                                    <span ui-include="'assets/images/i_1.svg'"></span>
                                                </i>
                                            </span> Tambah Bobot Kriteria
                                        </button>
                                    </a>
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label1" for="kriteria1id">Nama Kriteria</label>
                                            <div class="col-md-3">
                                                <select data-placeholder="Pilih Kriteria ...." class="select" id="kriteria1id" name="kriteria1id">
                                                    <option value="0">Pilih Kriteria</option>
<?php
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    if ($result = mysqli_query($link, "call GetBrowseTable(4)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<option value=".$rec['KriteriaId'].">".$rec['NamaKriteria']."</option>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table id="databobot" name="databobot" class="table datatable-responsive table-bordered table-hover" 
                                            width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="70">No</th>
                                                    <th>Nama Sub Kriteria</th>
                                                    <th>Nilai Bobot</th>
                                                    <th>Keterangan Bobot</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
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
        <div class="modal fade animate" id="remoteModal1">
            <div class="modal-dialog" id="animate">
            </div>
        </div>
        <div class='modal fade animate' id='remoteModal'>
            <div class="modal-dialog" id="animate"></div>
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
        <script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>

        <script src="scripts/app.js"></script>

        <!-- ajax -->
        <!--
        <script src="libs/jquery/jquery-pjax/jquery.pjax.js"></script>
        <script src="scripts/ajax.js"></script>
        -->
        <script>
            function reloadTabel(oTbl){
                oTbl.fnClearTable();
                oTbl.fnDraw();
            }
            function getdelete(bobotid){
                swal({
                    title: "Apakah anda yakin",
                    text: "Ingin menghapus data sub kriteria ini ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn primary",
                    cancelButtonClass: 'btn danger',
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) =>{
                    if (result.value){
                        window.location = 'deletebobot-'+bobotid;
                    }
                    else if (result.dismiss === 'cancel'){
                        swal("Dibatalkan", "Anda membatalkan penghapusan data bobot kriteria", "error");
                        return false;
                    }
                });
            }
            $(document).ready(function(){
                var databobot;
                databobot = $('#databobot').DataTable({
                    "responsive": true,
                    "serverSide": true,
                    "ajax": {
                        url : "data/databobot.php",
                        "data": function (d){
                            return $.extend({}, d,{
                                "KriteriaId": $('#kriteria1id').val()
                            });
                        }
                    },
                    "columns":[
                        {"sortable": true, "class": "text-center", "data": "0"},
                        {"sortable": false, "data": "1"},
                        {"sortable": false, "data": "2"},
                        {"sortable": false, "data": "3"},
                        {"sortable": false, "class": "text-center", "data": "4"}
                    ],
                    dom: '<"datatable-header"Bfl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Cari: </span> _INPUT_',
                        lengthMenu: '<span>Tampil: </span> _MENU_ <span> data</span>' ,
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "zeroRecords": "Tidak ada data yang cocok dengan kriteria pencarian anda",
                        "infoFiltered": "(Tersaring dari _MAX_ total data)",
                        "emptyTable": "Tidak ada data yang di tampilkan",
                        paginate: {'first': 'Pertama', 'last': 'Terakhir', 'next': 'Selanjutnya', 'previous': 'Sebelumnya'}
                    },
                    "columnDefs":[
                        {
                            "targets": 4,
                            "data": "4",
                            "render": function ( data, type, full, meta ){
                                return "<a href='editbobot-"+data+"' "+
                                        "data-toggle='modal' data-target='#remoteModal1' data-backdrop='static' class=''>"+
                                        "<span class='glyphicon glyphicon-edit'></span></a>&nbsp"+
                                        '<a href='+"#"+' class="confirm" onclick="getdelete(\''+data+ '\')">'+
                                        "<span class='glyphicon glyphicon-trash'></span></a>";
                            }
                        }
                    ],
                    buttons: [
                        {extend: 'print', className: 'btn btn-default'},
                        {extend: 'excelHtml5', className: 'btn success'},
                        {extend: 'csvHtml5', className: 'btn primary'},
                        {extend: 'pdfHtml5', className: 'btn danger'}
                    ]
                });
                $('.dataTables_filter input[type=search]').attr('placeholder','ketik untuk mencari...');
                $('.dataTables_length select').select2({
                    theme: 'bootstrap'
                });                
                $('.select').select2({
                    theme: 'bootstrap',
                    width: '100%',
                    language: 'id'
                });
                $('#kriteria1id').on('change', function(){
                    databobot.ajax.reload();
                });
                $('#remoteModal1').on('show.bs.modal', function (e) {
                    $(this).find('.modal-dialog').load(e.relatedTarget.href);
                });
                $('#remoteModal').on('show.bs.modal', function (e) {
                    $(this).find('.modal-dialog').load(e.relatedTarget.href);
                });
            });
        </script>
    </body>
</html>
<?php
    }
?>