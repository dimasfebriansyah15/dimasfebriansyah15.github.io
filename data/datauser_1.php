<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vuserlogin1';

    $primaryKey = 'NoUser';

    $columns = array(
            array('db' => 'NoUser', 'dt' => 0),
            array('db' => 'NamaUser', 'dt' => 1),
            array('db' => 'GroupId', 'dt' => 2),
            array('db' => 'NamaGroup', 'dt' => 3)
    );
    
    $sql_details = array(
            'user' => $dbuser,
            'pass' => $dbpassword,
            'db'   => $database,
            'host' => $host
    );
    
    $param = array(
        array('db' => 'groupid', 'dt' => $_GET['GroupId'])
    );

    require('ssp.class.php');

    echo json_encode(
            SSP::customvar($_GET, $sql_details, $table, $primaryKey, $columns, $param)
    );
