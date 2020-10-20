<?php
    include "../config/connection.php";
    if(isset($_GET['kriteriaid'])){$kriteriaid = $_GET['kriteriaid'];} else {$kriteriaid = $_POST['kriteriaid'];}
    $link = mysqli_connect($host, $dbuser, $dbpassword, $database);
    if (!$link) {
        printf("Tidak Bisa Koneksi ke MySQL. Kode Error: %s\n", mysqli_connect_error());
        exit;
    }
    $output = array("Kriteria" => array());
    $sqlcheck = "Select SubkriteriaId, NamaSubkriteria from subkriteria where KriteriaId = '$kriteriaid'";
    $result = mysqli_query($link, $sqlcheck);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $output['Kriteria'][] = $row;
    }
    echo json_encode($output);
?>