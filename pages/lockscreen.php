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
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Aplikasi SAW - Akses User</title>
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
              
        <link rel="stylesheet" href="assets/styles/app.css" type="text/css" />
        <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
    </head>
    <body>
        <div class="app" id="app">
            <div class="indigo-800 h-v row-col">
                <div class="row-cell v-m text-center animated fadeIn">
                    <form id="lockform" name="lockform" action="cekpass" method="post">
                        <div class="m-b">
                            <img src="<?php echo $photo.$foto?>" class="w-128 circle">
                            <div class="m-t-md font-bold"><?php echo $namalengkap?></div>
                        </div>
                        <div class="md-form-group w-xl w-auto-xs center-block">
                            <input type="password" class="md-input text-center" name="password" id="password">
                            <label class="block w-full">Password Anda</label>
                        </div>
                        <div class="m-t">
                            <button id="unlock" name="unlock" type="submit" class="btn btn-danger p-x-md">Unlock</button>
                        </div>
                    </form>
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
        <script src="scripts/palette.js"></script>
        <script src="scripts/ui-load.js"></script>
        <script src="scripts/ui-include.js"></script>
        <script src="scripts/ui-device.js"></script>
        <script src="scripts/ui-form.js"></script>
        <script src="scripts/ui-nav.js"></script>
        <script src="scripts/ui-screenfull.js"></script>
        <script src="scripts/ui-scroll-to.js"></script>
        <script src="scripts/ui-toggle-class.js"></script>
        
        <script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>

        <script src="scripts/app.js"></script>
        <script>
            $(document).ready(function(){
                $("#lockform").on('submit', function(e){
                    e.preventDefault();
                    $(this).ajaxSubmit({
                        success: function(data){
                            if(data === 'true'){window.location = "home";}
                            else if(data === 'false'){
                                swal({
                                    title: "Kunci Layar",
                                    text: "Ada kesalahan dalam database!",
                                    type: "error",
                                    confirmButtonClass: "btn primary",
                                    buttonsStyling: false
                                });
                            }
                            else if(data === 'false1'){
                                swal({
                                    title: "Kunci Layar",
                                    text: "Nama user anda tidak ditemukan..!",
                                    type: "error",
                                    confirmButtonClass: "btn primary",
                                    buttonsStyling: false
                                });
                            }
                            else if(data === 'false2'){
                                swal({
                                    title: "Kunci Layar",
                                    text: "Password anda tidak sesuai..!",
                                    type: "error",
                                    confirmButtonClass: "btn primary",
                                    buttonsStyling: false
                                });
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>
<?php
  }
?>