<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vuserlogin';

    $primaryKey = 'NoUser';

    $columns = array(
            array('db' => 'NoUser', 'dt' => 0),
            array('db' => 'NamaUser', 'dt' => 1),
            array('db' => 'NamaDepan', 'dt' => 2),
            array('db' => 'NamaBelakang', 'dt' => 3),
            array('db' => 'EmailUser', 'dt' => 4),
            array('db' => 'NamaGroup', 'dt' => 5),
            array('db' => 'action', 'dt' => 6)
    );
    
    $sql_details = array(
            'user' => $dbuser,
            'pass' => $dbpassword,
            'db'   => $database,
            'host' => $host
    );
    
    require('ssp.class.php');

    echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
