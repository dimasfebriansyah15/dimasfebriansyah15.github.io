<?php
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
            <i class="material-icons">&#xe5c3;
                <span ui-include="'assets/images/i_1.svg'"></span>
            </i>
        </span> 
        <h6 class="text-muted">Tambah Alternatif</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="alternatifform" name="alternatifform" method="post" action="simpanalternatif">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="alternatifid">Alternatif Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="alternatifid" maxlength="3" name="alternatifid" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="namaalternatif">Nama Alternatif</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="namaalternatif" maxlength="25" name="namaalternatif" type="text" autofocus>
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
    function AlternatifId(){
        var AlternatifId = document.getElementById('alternatifid');
        var NamaAlternatif = document.getElementById('namaalternatif');
        $.ajax({
            dataType: 'json',
            url: "data/maxid.php",
            type: "GET",
            data:{kode:"4"},
            success: function(data){
                $.each(data, function(i, n){
                    var kode1 = n["id"];
                    AlternatifId.value = kode1;
                    NamaAlternatif.value = "";
                });
            }
        });
    }
    $(document).ready(function(){
        AlternatifId();
        $('#close').on('click', function(){
            window.location = "alternatif";
        });
        
        $('#close1').on('click', function(){
            window.location = "alternatif";
        });
        disabled(true);
        function disabled(boolean){
            $("#simpan").attr('disabled', boolean);
        }
        $('#namaalternatif').on('exit', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namaalternatif').val(), kode: 3},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Alternatif",
                            text: "Nama alternatif sudah ada!!, silahkan coba dengan yang lain",
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
        $('#namaalternatif').on('change', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namaalternatif').val(), kode: 3},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Alternatif",
                            text: "Nama alternatif sudah ada!!, silahkan coba dengan yang lain",
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
        $('#alternatifform').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:{
                namaalternatif : {
                    minlength : 3,
                    required : true
                }
            },
            messages:{
                namaalternatif: {
                    required : "Masukan Nama Alternatif",
                    minlength : "Masukan Nama Alternatif Minimal 3 Karakter"
                }
            },
            invalidHandler: function(event, validator){
                $('.alert-danger', $('#alternatifform')).show();
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
        $("#alternatifform").on('submit', function(e){
            e.preventDefault();
            var namaalternatif = $('#namaalternatif').val();
            var lennama = namaalternatif.length;
            if(namaalternatif === ''){return false;}
            else if(lennama < 3){return false;}
            else{
                $(this).ajaxSubmit({
                    success: function(data){
                        if(data === 'true'){
                            swal({
                                title: "Alternatif",
                                text: "Data alternatif tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "alternatif";
                            });
                        }
                        else{
                            swal({
                                title: "Alternatif",
                                text: "Data alternatif tidak tersimpan!",
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
