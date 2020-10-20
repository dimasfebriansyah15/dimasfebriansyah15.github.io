<?php
    include '../config/connection.php';
    ini_set('max_execution_time', 600);
    session_start();

    $table = 'vbobot';

    $primaryKey = 'nobobot';

    $columns = array(
            array('db' => 'nobobot', 'dt' => 0),
            array('db' => 'NamaSubkriteria', 'dt' => 1),
            array('db' => 'NilaiBobot', 'dt' => 2),
            array('db' => 'KetNilai', 'dt' => 3),
            array('db' => 'action', 'dt' => 4),
            array('db' => 'KriteriaId', 'dt' => 5)
    );

    $sql_details = array(
            'user' => $dbuser,
            'pass' => $dbpassword,
            'db'   => $database,
            'host' => $host
    );

    $param = array(
        array('db' => 'kriteriaid', 'dt' => $_GET['KriteriaId'])
    );

    require('ssp.class.php');

    echo json_encode(
            SSP::customvar($_GET, $sql_details, $table, $primaryKey, $columns, $param)
    );
