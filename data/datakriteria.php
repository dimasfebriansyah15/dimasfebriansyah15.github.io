<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vkriteria';

    $primaryKey = 'nokriteria';

    $columns = array(
            array('db' => 'nokriteria', 'dt' => 0),
            array('db' => 'NamaKriteria', 'dt' => 1),
            array('db' => 'TipeKriteria', 'dt' => 2),
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
