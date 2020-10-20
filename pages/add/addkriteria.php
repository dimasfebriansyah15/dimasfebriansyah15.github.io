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
        <h6 class="text-muted">Tambah Kriteria</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="kriteriaform" name="kriteriaform" method="post" action="simpankriteria">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="kriteriaid">Kriteria Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="kriteriaid" maxlength="3" name="kriteriaid" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="namakriteria">Nama Kriteria</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="namakriteria" maxlength="25" name="namakriteria" type="text" autofocus>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label" for="tipekriteria">Tipe Kriteria</label>
                                <div class="col-md-9">
                                    <select data-placeholder="Pilih Tipe Kriteria ...." class="select" id="tipekriteria" name="tipekriteria">
<?php
    $tipekri = array("Cost", "Benefit");
    for($j=0; $j<count($tipekri); $j++){
        echo "<option value='$tipekri[$j]'>$tipekri[$j]</option>";
    }
?>
                                    </select>
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
<script src="libs/jquery/select2/dist/js/select2.min.js"></script>
<script src="libs/jquery/select2/dist/js/i18n/id.js"></script>
<script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>
<script>
    function KriteriaId(){
        var KriteriaId = document.getElementById('kriteriaid');
        var NamaKriteria = document.getElementById('namakriteria');
        $.ajax({
            dataType: 'json',
            url: "data/maxid.php",
            type: "GET",
            data:{kode:"3"},
            success: function(data){
                $.each(data, function(i, n){
                    var kode1 = n["id"];
                    KriteriaId.value = kode1;
                    NamaKriteria.value = "";
                });
            }
        });
    }
    $(document).ready(function(){
        KriteriaId();
        $('#close').on('click', function(){
            window.location = "kriteria";
        });
        
        $('#close1').on('click', function(){
            window.location = "kriteria";
        });
        $('.select').select2({
            width: '70%'
        });
        disabled(true);
        function disabled(boolean){
            $("#simpan").attr('disabled', boolean);
        }
        $('#namakriteria').on('exit', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namakriteria').val(), kode: 2},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Kriteria",
                            text: "Nama kriteria sudah ada!!, silahkan coba dengan yang lain",
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
        $('#namakriteria').on('change', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namakriteria').val(), kode: 2},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Kriteria",
                            text: "Nama kriteria sudah ada!!, silahkan coba dengan yang lain",
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
        $('#kriteriaform').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:{
                namakriteria : {
                    minlength : 3,
                    required : true
                }
            },
            messages:{
                namakriteria: {
                    required : "Masukan Nama Kriteria",
                    minlength : "Masukan Nama Kriteria Minimal 3 Karakter"
                }
            },
            invalidHandler: function(event, validator){
                $('.alert-danger', $('#kriteriaform')).show();
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
        $("#kriteriaform").on('submit', function(e){
            e.preventDefault();
            var namakriteria = $('#namakriteria').val();
            var lennama = namakriteria.length;
            if(namakriteria === ''){return false;}
            else if(lennama < 3){return false;}
            else{
                $(this).ajaxSubmit({
                    success: function(data){
                        if(data === 'true'){
                            swal({
                                title: "Kriteria",
                                text: "Data kriteria tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "kriteria";
                            });
                        }
                        else{
                            swal({
                                title: "Kriteria",
                                text: "Data kriteria tidak tersimpan!",
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
