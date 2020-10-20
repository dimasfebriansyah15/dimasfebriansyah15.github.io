<?php
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login User</title>
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
        <!-- build:css assets/styles/app.min.css -->
        <link rel="stylesheet" href="assets/styles/app.css" type="text/css" />
        <!-- endbuild -->
        <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
    </head>
    <body>
        <div class="app" id="app">
            <div class="center-block w-xxl w-auto-xs p-y-md">
                <div class="navbar">
                    <div class="pull-center">
                        <div ui-include="'views/blocks/navbar.brand.html'"></div>
                    </div>
                </div>
                <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
                    <div class="m-b text-sm">Login ke Aplikasi SAW</div>
                    <form id="formlogin" name="formlogin" action="ceklogin" method="post">
                        <div class="md-form-group float-label">
                            <input type="text" class="md-input" id="username" name="username" required>
                            <label>Nama User</label>
                        </div>
                        <div class="md-form-group float-label">
                            <input type="password" class="md-input" id="password" name="password" required>
                            <label>Password</label>
                        </div>
                        <button type="submit" class="btn primary btn-block p-x-md">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="libs/jquery/jquery/dist/jquery.js"></script>
        <script src="libs/jquery/jquery/dist/jquery-form.min.js"></script>
        <script src="libs/jquery/validation/validate.min.js"></script>
        <script src="libs/jquery/validation/localization/messages_id.min.js"></script>
        <!-- Bootstrap -->
        <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
        <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
        <!-- core -->
        <script src="libs/jquery/underscore/underscore-min.js"></script>
        <script src="libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
        <script src="libs/jquery/PACE/pace.min.js"></script>

        <script src="scripts/config.lazyload.js"></script>

        <script src="scripts/palette.js"></script>
        <script src="scripts/ui-load.js"></script>
        <script src="scripts/ui-jp.js"></script>
        <script src="scripts/ui-include.js"></script>
        <script src="scripts/ui-device.js"></script>
        <script src="scripts/ui-form.js"></script>
        <script src="scripts/ui-nav.js"></script>
        <script src="scripts/ui-screenfull.js"></script>
        <script src="scripts/ui-scroll-to.js"></script>
        <script src="scripts/ui-toggle-class.js"></script>
        
        <script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>

        <script src="scripts/app.js"></script>

        <!-- ajax -->
        <script src="libs/jquery/jquery-pjax/jquery.pjax.js"></script>
        <script src="scripts/ajax.js"></script>
        <script>
            $(document).ready(function(){
                var form = $('#form-login');
                var errorHandler = $('.errorHandler', form);
                $("#formlogin").validate({
                    rules : {
                        username : {
                            minlength : 2,
                            required : true
                        },
                        password : {
                            minlength : 3,
                            required : true
                        }
                    },
                    messages:{
                        username: {
                            required : "Masukan Nama Anda",
                            minlength : "Masukan Nama Anda Minimal 2 Karakter"
                        },
                        password: {
                            required : "Masukan Kata Kunci Anda", 
                            minlength : "Masukan Kata Kunci Anda Minimal 3 Karakter"
                        }
                    },
                    errorElement : "span",
                    errorClass : 'help-block',
                    errorPlacement : function(error, element){
                        if(element.attr("type") === "radio" || element.attr("type") === "checkbox"){
                            error.insertAfter($(element).closest('.form-group').children('div').children().last());
                        } else{error.insertAfter(element);}
                    },
                    //ignore : ':hidden',
                    success : function(label, element){
                        label.addClass('help-block valid');
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    highlight : function(element){
                        $(element).closest('.help-block').removeClass('valid');
                        $(element).closest('.form-group').addClass('has-error');
                    },
                    unhighlight : function(element){
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    submitHandler : function(form){
                        errorHandler.hide();
                    },
                    invalidHandler : function(event, validator){
                        errorHandler.show();
                    }
                });
                $("#formlogin").on('submit', function(e){
                    e.preventDefault();
                    var username = $('#username').val();
                    var password = $('#password').val();
                    var lenuser = username.length;
                    var lenpass = password.length;
                    if(username === '' || password === ''){return false;}
                    else if(lenuser < 2 || lenpass < 3){return false;}
                    else{
                        $(this).ajaxSubmit({
                            success: function(data){
                                if(data === 'true'){
                                    window.location = "home";
                                }
                                else if(data === 'false1'){
                                    swal({
                                        title: "Login User",
                                        text: "Data user tidak bisa masuk...!!",
                                        confirmButtonClass: "btn primary",
                                        buttonsStyling: false
                                    });
                                    window.location = "login";
                                }
                                else{
                                    swal({
                                        title: "Login User",
                                        text: "Nama atau Kata Kunci Anda Tidak ditemukan..!",
                                        type: "info",
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