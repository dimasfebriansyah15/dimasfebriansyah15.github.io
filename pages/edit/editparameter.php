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
    if($result = mysqli_query($link, "call GetEditTable(8, '$GroupId')")){
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
            <i class="material-icons">&#xe5c3;
                <span ui-include="'assets/images/i_1.svg'"></span>
            </i>
        </span> 
        <h6 class="text-muted">Tambah Parameter</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="parameterform" name="parameterform" method="post" action="editparameter">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="parameterid">Parameter Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="parameterid" maxlength="3" name="parameterid" type="text" readonly
                                        value="<?php echo $dataedit[0]['ParameterId']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="tingkat">Tingkat</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="tingkat" maxlength="25" name="tingkat" type="text" readonly
                                        value="<?php echo $dataedit[0]['Tingkat']?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="bonus">Bonus Karyawan</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="bonus" maxlength="12" name="bonus" type="text" autofocus
                                        value="<?php echo $dataedit[0]['BonusKaryawan']?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="kondisi">Kondisi</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="kondisi" maxlength="30" name="kondisi" type="text"
                                        value="<?php echo $dataedit[0]['Kondisi']?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="keterangan">Keterangan</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="keterangan" maxlength="30" name="keterangan" type="text"
                                        value="<?php echo $dataedit[0]['Keterangan']?>">
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
    $(document).ready(function(){
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
