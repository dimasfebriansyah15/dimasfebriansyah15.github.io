<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'valternatif';

    $primaryKey = 'noalternatif';

    $columns = array(
            array('db' => 'noalternatif', 'dt' => 0),
            array('db' => 'NamaAlternatif', 'dt' => 1),
            array('db' => 'action', 'dt' => 2)
    );

    $sql_details = array(
            'user' => $dbuser,
            'pass' => $dbpassword,
            'db'   => $database,
            'host' => $host
    );


    require('ssp.class.php');

    echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, null, null)
    );
?>