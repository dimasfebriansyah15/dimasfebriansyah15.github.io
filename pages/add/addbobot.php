<?php
    include "../../config/connection.php";
    $linkk = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkk) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $links = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$links) {
        printf("Tidak bisa koneksi ke MySQL Server : ", mysqli_connect_error());
        exit;
    }
    $linkn = mysqli_connect($host, $dbuser, $dbpassword, $database, $port);
    if (!$linkn) {
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
            <i class="material-icons">&#xe8f0;
                <span ui-include="'assets/images/i_1.svg'"></span>
            </i>
        </span> 
        <h6 class="text-muted">Tambah Bobot Kriteria</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="bobotform" name="bobotform" method="post" action="simpanbobot">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="bobotid">Bobot Id</label>
                                <div class="col-md-3">
                                    <input class="form-control" id="bobotid" maxlength="3" name="bobotid" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="kriteriaid">Nama Kriteria</label>
                                <div class="col-md-9">
                                    <select data-placeholder="Pilih Kriteria ...." class="select" id="kriteriaid" name="kriteriaid">
<?php
    if ($result = mysqli_query($linkk, "call GetBrowseTable(4)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<option value=".$rec['KriteriaId'].">".$rec['NamaKriteria']."</option>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($linkk);
?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="subkriteriaid">Nama Sub Kriteria</label>
                                <div class="col-md-9">
                                    <select data-placeholder="Pilih Sub Kriteria ...." class="select" id="subkriteriaid" name="subkriteriaid">
<?php
    if ($result = mysqli_query($links, "Select * From subkriteria Where KriteriaId = 1")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<option value=".$rec['SubkriteriaId'].">".$rec['NamaSubkriteria']."</option>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($links);
?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label1" for="nilaiid">Jumlah Nilai</label>
                                <div class="col-md-9">
                                    <select data-placeholder="Pilih Nilai ...." class="select" id="nilaiid" name="nilaiid">
<?php
    if ($result = mysqli_query($linkn, "call GetBrowseTable(5)")){
        $nbrows = mysqli_num_rows($result);
        if($nbrows>0){
            while($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<option value=".$rec['NilaiId'].">".$rec['KetNilai']."</option>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($linkn);
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
<script src="libs/jquery/select2/dist/js/select2.min_1.js"></script>
<script src="libs/jquery/select2/dist/js/i18n/id.js"></script>
<script src="libs/jquery/validation/validate.min.js"></script>
<script src="libs/jquery/validation/localization/messages_id.min.js"></script>
<script src="libs/jquery/sweetalert2/dist/sweetalert2.all.js"></script>
<script>
    function BobotId(){
        var BobotId = document.getElementById('bobotid');
        $.ajax({
            dataType: 'json',
            url: "data/maxid.php",
            type: "GET",
            data:{kode:"7"},
            success: function(data){
                $.each(data, function(i, n){
                    var kode1 = n["id"];
                    BobotId.value = kode1;
                });
            }
        });
    }
    $(document).ready(function(){
        BobotId();
        $('#close').on('click', function(){
            window.location = "bobot";
        });
        
        $('#close1').on('click', function(){
            window.location = "bobot";
        });
        $('.select').select2({
            theme: 'bootstrap',
            width: '100%',
            language: 'id'
        });
        $('#kriteriaid').on('change', function(){
            var str = "";
            $("select option:selected").each(function() {
                str = $('#kriteriaid').val();
            });
            $.ajax({
                url: "data/filter.php",
                dataType: "json",
                data: {
                    kriteriaid: str
                },
                success: function(data){
                    $('#subkriteriaid').children().remove();
                    $('#subkriteriaid option').remove();
                    $.each(data.Kriteria, function(i, item){
                        $('#subkriteriaid').append(new Option(item.NamaSubkriteria, item.SubkriteriaId));
                    });
                },
                failure: function(){
                    $('#subkriteriaid').children().remove();
                    $('#subkriteriaid option').remove();
                }
            });
        });
        $("#bobotform").on('submit', function(e){
            e.preventDefault();
            $(this).ajaxSubmit({
                success: function(data){
                    if(data === 'true'){
                        swal({
                            title: "Bobot Kriteria",
                            text: "Data bobot kriteria tersimpan",
                            type: "success",
                            confirmButtonClass: "btn primary",
                            buttonsStyling: false
                        }).then(function(){
                            window.location = "bobot";
                        });
                    }
                    else if(data === 'false'){
                        swal({
                            title: "Bobot Kriteria",
                            text: "Data bobot kriteria tidak tersimpan!",
                            type: "error",
                            confirmButtonClass: "btn primary",
                            buttonsStyling: false
                        });
                    }
                    else{
                        swal({
                            title: "Bobot Kriteria",
                            text: "Data bobot kriteria sudah terentri...!",
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
