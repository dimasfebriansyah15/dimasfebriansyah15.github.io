<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vgroupuser';

    $primaryKey = 'nogroup';

    $columns = array(
            array('db' => 'nogroup', 'dt' => 0),
            array('db' => 'NamaGroup', 'dt' => 1),
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
