<?php

try {

    $aResponse['data'] = FALSE;
    $aResponse['code'] = 400;
    $db = new SQLite3('db/bdp.db');
    $res = $db->query('SELECT * FROM reviews');
    $data = [];
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data[] = $row;
    }
    $aResponse['code'] = 200;
    $aResponse['data'] =  $data;
    echo json_encode($aResponse);
} catch (Exception $e) {
    echo $e->getMessage();
}
