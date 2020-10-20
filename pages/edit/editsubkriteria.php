<?php
    include "../../config/connection.php";
    $SubkriteriaId = $_GET['id'];
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$link) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $dataedit = array();
    $linkd = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$linkd) {
        printf("Tidak Bisa Koneksi ke MySQL: ", mysqli_connect_error());
        exit;
    }
    if($result = mysqli_query($linkd, "call GetEditTable(6, '$SubkriteriaId')")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $dataedit[] = $rec;
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($linkd);
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
        <h6 class="text-muted">Edit Sub Kriteria</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="subkriteria1form" name="subkriteria1form" method="post" action="editsubkriteria">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="subkriteriaid">Sub Kriteria Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="subkriteriaid" maxlength="3" name="subkriteriaid" type="text" readonly
                                        value="<?php echo $dataedit[0]['SubkriteriaId']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="kriteriaid">Nama Kriteria</label>
                                <div class="col-md-9">
                                    <select data-placeholder="Pilih Kriteria ...." class="select" id="kriteriaid" name="kriteriaid">
<?php
    $KriteriaIdd = (int) $dataedit[0]['KriteriaId'];
    if ($result = mysqli_query($link, "call GetBrowseTable(4)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $kriteriaid = (int) $rec['KriteriaId'];
                if($kriteriaid === $KriteriaIdd){echo "<option value=".$rec['KriteriaId']." selected>".$rec['NamaKriteria']."</option>";}
                else{echo "<option value=".$rec['KriteriaId'].">".$rec['NamaKriteria']."</option>";}
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="namasubkriteria">Nama Sub Kriteria</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="namasubkriteria" maxlength="25" name="namasubkriteria" type="text"
                                        value="<?php echo $dataedit[0]['NamaSubkriteria']?>">
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
<script src="libs/jquery/select2/dist/js/select2.min.js"></script>
<script src="libs/jquery/select2/dist/js/i18n/id.js"></script>
<script src="libs/jquery/validation/validate.min.js"></script>
<script src="libs/jquery/validation/localization/messages_id.min.js"></script>
<script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>
<script>
    $(document).ready(function(){
        $('#close').on('click', function(){
            window.location = "subkriteria";
        });
        
        $('#close1').on('click', function(){
            window.location = "subkriteria";
        });
        $('.select').select2({
            theme: 'bootstrap',
            width: '100%',
            language: 'id'
        });
        disabled(true);
        function disabled(boolean){
            $("#simpan").attr('disabled', boolean);
        }
        $('#namasubkriteria').on('exit', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namasubkriteria').val(), kode: 5, value2: $('#kriteriaid').val()},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Sub Kriteria",
                            text: "Nama sub kriteria sudah ada!!, silahkan coba dengan yang lain",
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
        $('#namasubkriteria').on('change', function(){
            $.ajax({
                url: "data/cekdataentri.php",
                type: "GET",
                data:{value: $('#namasubkriteria').val(), kode: 5, value2: $('#kriteriaid').val()},
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Sub Kriteria",
                            text: "Nama sub kriteria sudah ada!!, silahkan coba dengan yang lain",
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
        $('#subkriteria1form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules:{
                namasubkriteria : {
                    minlength : 3,
                    required : true
                }
            },
            messages:{
                namasubkriteria: {
                    required : "Masukan Nama Sub Kriteria",
                    minlength : "Masukan Nama Sub Kriteria Minimal 3 Karakter"
                }
            },
            invalidHandler: function(event, validator){
                $('.alert-danger', $('#subkriteriaform')).show();
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
        $("#subkriteria1form").on('submit', function(e){
            e.preventDefault();
            var namasubkriteria = $('#namasubkriteria').val();
            var lennama = namasubkriteria.length;
            if(namasubkriteria === ''){return false;}
            else if(lennama < 3){return false;}
            else{
                $(this).ajaxSubmit({
                    success: function(data){
                        if(data === 'true'){
                            swal({
                                title: "Sub Kriteria",
                                text: "Data sub kriteria tersimpan",
                                type: "success",
                                confirmButtonClass: "btn primary",
                                buttonsStyling: false
                            }).then(function(){
                                window.location = "subkriteria";
                            });
                        }
                        else{
                            swal({
                                title: "Sub Kriteria",
                                text: "Data sub kriteria tidak tersimpan!",
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
