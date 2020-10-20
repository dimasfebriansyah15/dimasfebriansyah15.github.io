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
        <h6 class="text-muted">Tambah Parameter</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="parameterform" name="parameterform" method="post" action="simpanparameter">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="parameterid">Parameter Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="parameterid" maxlength="3" name="parameterid" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="tingkat">Tingkat</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="tingkat" maxlength="25" name="tingkat" type="text" autofocus>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="bonus">Bonus Karyawan</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="bonus" maxlength="12" name="bonus" type="text">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="kondisi">Kondisi</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="kondisi" maxlength="30" name="kondisi" type="text">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="keterangan">Keterangan</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="keterangan" maxlength="30" name="keterangan" type="text">
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
<script src="libs/jquery/select2/dist/js/select2.min.js"></script>
<script src="libs/jquery/select2/dist/js/i18n/id.js"></script>
<script src="libs/jquery/jquery/dist/jquery.inputmask.bundle.js"></script>
<script>
    function ParameterId(){
        var ParameterId = document.getElementById('parameterid');
        var NamaParameter = document.getElementById('tingkat');
        var Kondisi = document.getElementById('kondisi');
        var Keterangan = document.getElementById('keterangan');
        $.ajax({
            dataType: 'json',
            url: "data/maxid.php",
            type: "GET",
            data:{kode:"8"},
            success: function(data){
                $.each(data, function(i, n){
                    var kode1 = n["id"];
                    ParameterId.value = kode1;
                    NamaParameter.value = "";
                    Kondisi.value = "";
                    Keterangan.value = "";
                });
            }
        });
    }
    $(document).ready(function(){
        ParameterId();
        $('#close').on('click', function(){
            window.location = "parameter";
        });
        
        $('#close1').on('click', function(){
            window.location = "parameter";
        });
        $('#bonus').inputmask({
            'alias': 'decimal',
            'autoUnmask': true,
            'radixPoint': '.',
            'groupSeparator': '.',
            'autoGroup': true
        });
        $('.select').select2({
            width: '70%'
        });
        disabled(true);
        function disabled(boolean){
            $("#simpan").attr('disabled', boolean);
        }
        $('#tingkat').on('exit', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#tingkat').val(), kode: 6},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Parameter",
                            text: "Nama tingkat sudah ada!!, silahkan coba dengan yang lain",
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
        $('#tingkat').on('change', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#tingkat').val(), kode: 6},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Parameter",
                            text: "Nama tingkat sudah ada!!, silahkan coba dengan yang lain",
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
        $('#parameterform').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:{
                tingkat : {minlength : 3, required : true},
                kondisi : {minlength : 3, required : true},
                keterangan : {minlength : 3, required : true}
            },
            messages:{
                tingkat: {required : "Masukan Nama Tingkat", minlength : "Masukan Nama Tingkat Minimal 3 Karakter"},
                kondisi: {required : "Masukan Kondisi", minlength : "Masukan Kondisi Minimal 3 Karakter"},
                keterangan: {required : "Masukan Keterangan", minlength : "Masukan Keterangan Minimal 3 Karakter"}
            },
            invalidHandler: function(event, validator){
                $('.alert-danger', $('#parameterform')).show();
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
        $("#parameterform").on('submit', function(e){
            e.preventDefault();
            var namaparameter = $('#tingkat').val();
            var kondisi = $('#kondisi').val();
            var keterangan = $('#keterangan').val();
            var lennama = namaparameter.length;
            var lenkondisi = kondisi.length;
            var lenketerangan = keterangan.length;
            if(namaparameter === '' || kondisi === '' || keterangan === ''){return false;}
            else if(lennama < 3 || lenkondisi < 3 || lenketerangan < 3){return false;}
            else{
                $(this).ajaxSubmit({
                    success: function(data){
                        if(data === 'true'){
                            swal({
                                title: "Parameter",
                                text: "Data parameter tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "parameter";
                            });
                        }
                        else{
                            swal({
                                title: "Parameter",
                                text: "Data parameter tidak tersimpan!",
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
