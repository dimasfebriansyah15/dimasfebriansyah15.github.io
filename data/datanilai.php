<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vnilai';

    $primaryKey = 'nonilai';

    $columns = array(
            array('db' => 'nonilai', 'dt' => 0),
            array('db' => 'KetNilai', 'dt' => 1),
            array('db' => 'JmlNilai', 'dt' => 2),
            array('db' => 'action', 'dt' => 3)
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
