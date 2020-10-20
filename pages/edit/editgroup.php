<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();
    $GroupId = $_GET['id'];
    include "../../config/connection.php";
    $dataedit = array();
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak Bisa Koneksi ke MySQL: ", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($link, "call GetEditTable(1, '$GroupId')")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $dataedit[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
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
            <i class="material-icons">&#xe7ef;
                <span ui-include="'assets/images/i_1.svg'"></span>
            </i>
        </span> 
        <h6 class="text-muted">Edit Group</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form id="group1form" name="group1form" method="post" action="editgroup">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="groupid">Group Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="groupid" maxlength="3" name="groupid" type="text" readonly value="<?php echo $dataedit[0]['GroupId']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="namagroup">Nama Group</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="namagroup" maxlength="25" name="namagroup" type="text" autofocus value="<?php echo $dataedit[0]['NamaGroup']?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
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
<script src="libs/jquery/jquery/dist/jquery.js"></script>
<script src="libs/jquery/jquery/dist/jquery-form.min.js"></script>
<script src="libs/jquery/validation/validate.min.js"></script>
<script src="libs/jquery/validation/localization/messages_id.min.js"></script>
<script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>
<script>
    $(document).ready(function(){
        $('#close').on('click', function(){
            window.location = "group";
        });
        
        $('#close1').on('click', function(){
            window.location = "group";
        });
        disabled(true);
        function disabled(boolean){
            $("#simpan").attr('disabled', boolean);
        }
        $('#namagroup').on('exit', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namagroup').val(), kode: 1},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Group User",
                            text: "Nama Group sudah ada!!, silahkan coba dengan yang lain",
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
        $('#namagroup').on('change', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namagroup').val(), kode: 1},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Group User",
                            text: "Nama Group sudah ada!!, silahkan coba dengan yang lain",
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
        $('#group1form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:{
                namagroup : {
                    minlength : 3,
                    required : true
                }
            },
            messages:{
                namagroup: {
                    required : "Masukan Nama Group",
                    minlength : "Masukan Nama Group Minimal 3 Karakter"
                }
            },
            invalidHandler: function(event, validator){
                $('.alert-danger', $('#group1form')).show();
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
        $("#group1form").on('submit', function(e){
            e.preventDefault();
            var namagroup = $('#namagroup').val();
            var lennama = namagroup.length;
            if(namagroup === ''){return false;}
            else if(lennama < 3){return false;}
            else{
                $(this).ajaxSubmit({
                    success: function(data){
                        if(data === 'true'){
                            swal({
                                title: "Group User",
                                text: "Data group tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "group";
                            });
                        }
                        else{
                            swal({
                                title: "Group User",
                                text: "Data group tidak tersimpan!",
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
