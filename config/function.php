<?php
    session_start();
    include "connection.php";

    function DeleteImage($fupload_name, $directory){
        $vdir_upload = $directory;
        $vfile_upload = $vdir_upload . $fupload_name;

        if(file_exists($vfile_upload)){
            unlink($vfile_upload);
        }
    }

    function UploadImage($fupload_name, $directory, $foto){
        //directory picture
        $vdir_upload = $directory;
        $vfile_upload = $vdir_upload . $fupload_name;

        //Saving picture in normal size
        if (is_dir($vdir_upload)){
            while(is_file($vfile_upload) == TRUE){
                chmod($vfile_upload, 0666);
                unlink($vfile_upload);
            }
            move_uploaded_file($foto, $vfile_upload);

        }
        else{
            while(is_file($vfile_upload) == TRUE){
                chmod($vfile_upload, 0666);
                unlink($vfile_upload);
            }
            mkdir($vdir_upload, 0777, true);
            move_uploaded_file($foto, $vfile_upload);
        }
    }

    function getMax($ColId, $tbName, $link){
        $query = "select IfNull(Max($ColId)+1, 1) as id ";
        $query .= "from $tbName ";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $id = $row[0];
            }
        }
        else{
            $id = 1;
        }
        if($id === NULL ){
                $id = 1;
        }
        return $id;
    }
    
    function add_date($orgDate, $mth){
        $cd = strtotime($orgDate);
        $retDAY = date('Y-m-d', mktime(0, 0, 0, date('m', $cd) + $mth, date('d', $cd), date('Y', $cd)));
        return $retDAY;
    }
?>
