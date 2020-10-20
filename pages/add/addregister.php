<?php
    include "../../config/connection.php";
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
?>
<style>
    .control-label1{
        margin-top: 0;
        margin-bottom: 0;
        padding-top: 7px;
        text-align: right;
    }
</style>
<div class="modal-content box">
    <div class="modal-header">
        <button type="button" id="close1" name="close1" class="close" aria-hidden="true">&times;</button>
        <span class="nav-icon">
            <i class="material-icons">&#xe7fd;
                <span ui-include="'assets/images/i_1.svg'"></span>
            </i>
        </span> 
        <h6 class="text-muted">Tambah User</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <form class="form-horizontal" id="userform" name="userform" method="post" action="simpanregister">
                        <div class="box">
                            <div class="box-body">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="groupid">User Id</label>
                                        <div class="col-md-3">
                                            <input class="form-control" id="userid" maxlength="3" name="userid" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="namauser">Nama User</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="namauser" maxlength="25" name="namauser" type="text" autofocus placeholder="Nama User">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="passuser">Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="passuser" maxlength="32" name="passuser" type="password" placeholder="Password User">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="passconfirm">Konfir. Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="passconfirm" maxlength="32" name="passconfirm" type="password" placeholder="Konfirmasi Password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="namauser">Nama</label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input class="form-control" id="namadepan" maxlength="25" name="namadepan" type="text" placeholder="Nama Depan">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" id="namabelakang" maxlength="25" name="namabelakang" type="text" placeholder="Nama Belakang">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="emailuser">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="emailuser" maxlength="30" name="emailuser" type="text" placeholder="Email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 control-label1" for="groupid">Group</label>
                                        <div class="col-md-9">
                                            <select data-placeholder="Pilih Group ...." class="select" id="groupid" name="groupid">
<?php
    if ($result = mysqli_query($link, "call GetBrowseTable(1)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<option value=".$rec['GroupId'].">".$rec['NamaGroup']."</option>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="box-footer">
                                <div class="form-actions row">
                                    <button id="close" name="close" type="button" class="btn default">Tutup</button>
                                    <button id="simpan" name="simpan" type="submit" class="btn primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="libs/jquery/jquery/dist/jquery.js"></script>
<script src="libs/jquery/jquery/dist/jquery-form.min.js"></script>
<script src="libs/jquery/validation/validate.min.js"></script>
<script src="libs/jquery/validation/localization/messages_id.min.js"></script>
<script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="libs/jquery/select2/dist/js/select2.min.js"></script>
<script src="libs/jquery/select2/dist/js/i18n/id.js"></script>
<script>
    function UserId(){
        var UserId = document.getElementById('userid');
        var NamaUser = document.getElementById('namauser');
        var Email = document.getElementById('emailuser');
        var PassUser = document.getElementById('passuser');
        var PassConfirm = document.getElementById('passconfirm');
        var NamaDepan = document.getElementById('namadepan');
        var NamaBelakang = document.getElementById('namabelakang');
        $.ajax({
            dataType: 'json',
            url: "data/maxid.php",
            type: "GET",
            data:{kode:"2"},
            success: function(data){
                $.each(data, function(i, n){
                    var kode1 = n["id"];
                    UserId.value = kode1;
                    NamaUser.value = "";
                    Email.value = "";
                    PassUser.value = "";
                    PassConfirm.value = "";
                    NamaDepan.value = "";
                    NamaBelakang.value = "";
                });
            }
        });
    }
    $(document).ready(function(){
        function disabled(boolean){
            $("#emailuser").attr('readOnly', boolean);
            $("#passuser").attr('readOnly', boolean);
            $("#passconfirm").attr('readOnly', boolean);
            $("#namadepan").attr('readOnly', boolean);
            $("#namabelakang").attr('readOnly', boolean);
            $("#groupid").attr('disabled', boolean);
            $("#simpan").attr('disabled', boolean);
        }
        UserId();
        disabled(true);
        $("#namauser").on('change', function(){
            $.ajax({
                url: "data/ceknamauser.php",
                type: "GET",
                data:{namauser: $('#namauser').val()},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Register User",
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
        $('.select').select2({
            theme: 'bootstrap',
            width: '200px'
        });
        $('#close').on('click', function(){
            window.location = "register";
        });
        
        $('#close1').on('click', function(){
            window.location = "register";
        });
        $('#userform').validate({
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
        $("#userform").on('submit', function(e){
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
                                title: "Register User",
                                text: "Data user tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "register";
                            });
                        }
                        else{
                            swal({
                                title: "Register User",
                                text: "Data user tidak tersimpan!",
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