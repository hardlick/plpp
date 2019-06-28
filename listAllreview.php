<?php

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aResponse['data'] = FALSE;
    $aResponse['code'] = 400;
    $db = new SQLite3('db/bdp.db');
    $res = $db->query('SELECT * FROM reviews');
    $data = [];
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data[] = $row;
    }
    
    $avg = $db->query('select round(avg(puntuacion),2)  promedio from reviews');
    $data_avg = [];
    while ($row_avg = $avg->fetchArray(SQLITE3_ASSOC)) {
        $data_avg[] = $row_avg;
    }
    $aResponse['code'] = 200;
    $aResponse['data'] =  $data;
    $aResponse['avg'] =  $data_avg;
    echo json_encode($aResponse);
        } else {
        $aResponse['data'] = 'Error al procesar  el Review - Informacion Erronea';
        $aResponse['code'] = 400;
        echo json_encode($aResponse);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
