<?php

include_once './config/config.php';
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $serverDBName = db_config::$db_conection_config['baul']['serverDBName'];
        $servername = db_config::$db_conection_config['baul']['dbName'];
        $username = db_config::$db_conection_config['baul']['dbUser'];
        $password = db_config::$db_conection_config['baul']['dbPassword'];
        $aResponse['data'] = FALSE;
        $aResponse['code'] = 400;

        $db = new mysqli($serverDBName, $username, $password, $servername);
        if ($db->connect_error) {
            header('Content-type: application/json');
            echo json_encode("Problemas de conexion con la DB: " . $db->connect_error);
            die();
        }
        $res = $db->query('SELECT * FROM reviews');
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        $avg = $db->query('select round(avg(puntuacion),2)  promedio from reviews');
        $data_avg = [];
        while ($row_avg = $avg->fetch_assoc()) {
            $data_avg[] = $row_avg;
        }
        header('Content-type: application/json');
        $aResponse['code'] = 200;
        $aResponse['data'] = $data;
        $aResponse['avg'] = $data_avg;
        echo json_encode($aResponse);
    } else {
        header('Content-type: application/json');
        $aResponse['data'] = 'Error al procesar  el Review - Informacion Erronea';
        $aResponse['code'] = 400;
        echo json_encode($aResponse);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
