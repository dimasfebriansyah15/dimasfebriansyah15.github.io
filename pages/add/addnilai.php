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
        <h6 class="text-muted">Tambah Nilai Preferensi</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="nilaiform" name="nilaiform" method="post" action="simpannilai">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="nilaiid">Nilai Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="nilaiid" maxlength="3" name="nilaiid" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="ketnilai">Keterangan Nilai</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="ketnilai" maxlength="25" name="ketnilai" type="text" autofocus>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="jmlnilai">Jumlah Nilai</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="jmlnilai" maxlength="5" name="jmlnilai" type="text" style="text-align: right">
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
<script src="libs/jquery/jquery/dist/jquery.inputmask.bundle.js"></script>
<script>
    function NilaiId(){
        var NilaiId = document.getElementById('nilaiid');
        var KetNilai = document.getElementById('ketnilai');
        $.ajax({
            dataType: 'json',
            url: "data/maxid.php",
            type: "GET",
            data:{kode:"5"},
            success: function(data){
                $.each(data, function(i, n){
                    var kode1 = n["id"];
                    NilaiId.value = kode1;
                    KetNilai.value = "";
                });
            }
        });
    }
    $(document).ready(function(){
        NilaiId();
        $('#close').on('click', function(){
            window.location = "nilai";
        });
        
        $('#close1').on('click', function(){
            window.location = "nilai";
        });
        $("#jmlnilai").inputmask({"mask": "9,99", "repeat":5, "greedy": false});
        disabled(true);
        function disabled(boolean){
            $("#jmlnilai").attr('readOnly', boolean);
            $("#simpan").attr('disabled', boolean);
        }
        $('#ketnilai').on('exit', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#ketnilai').val(), kode: 4},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Nilai Preferensi",
                            text: "Keterangan nilai sudah ada!!, silahkan coba dengan yang lain",
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
        $('#ketnilai').on('change', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#ketnilai').val(), kode: 4},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Nilai Preferensi",
                            text: "Keterangan nilai sudah ada!!, silahkan coba dengan yang lain",
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
        $('#nilaiform').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:{
                ketnilai : {minlength : 3, required : true},
                jmlnilai : {minlength : 1, required : true}
            },
            messages:{
                ketnilai: {
                    required : "Masukan Keterangan Nilai",
                    minlength : "Masukan Keterangan Nilai Minimal 3 Karakter"
                },
                jmlnilai: {
                    required : "Masukan Nilai",
                    minlength : "Masukan Nilai Minimal 1 Karakter"
                }
            },
            invalidHandler: function(event, validator){
                $('.alert-danger', $('#nilaiform')).show();
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
        $("#nilaiform").on('submit', function(e){
            e.preventDefault();
            var ketnilai = $('#ketnilai').val();
            var jmlnilai = $('#jmlnilai').val();
            var lenket = ketnilai.length;
            var lenjml = jmlnilai.length;
            if(ketnilai === '' || jmlnilai === ''){return false;}
            else if(lenket < 3 || lenjml < 1){return false;}
            else{
                $(this).ajaxSubmit({
                    success: function(data){
                        if(data === 'true'){
                            swal({
                                title: "Nilai Preferensi",
                                text: "Data nilai preferensi tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "nilai";
                            });
                        }
                        else{
                            swal({
                                title: "Nilai Preferensi",
                                text: "Data nilai preferensi tidak tersimpan!",
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
