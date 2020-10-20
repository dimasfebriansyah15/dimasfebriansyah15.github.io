<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vparameter';

    $primaryKey = 'noparameter';

    $columns = array(
            array('db' => 'noparameter', 'dt' => 0),
            array('db' => 'Tingkat', 'dt' => 1),
            array('db' => 'BonusKaryawan', 'dt' => 2),
            array('db' => 'Kondisi', 'dt' => 3),
            array('db' => 'Keterangan', 'dt' => 4),
            array('db' => 'action', 'dt' => 5)
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