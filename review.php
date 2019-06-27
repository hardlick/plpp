<?php

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $aResponse['data'] = FALSE;
        $aResponse['code'] = 400;

        if (!empty($_POST['input-3-ltr-star-md']) && !empty($_POST['email']) && !empty($_POST['message']) && !empty($_POST['name'])) {

            $message = trim(htmlspecialchars($_POST['message']));
            $puntuacion = trim(htmlspecialchars($_POST['input-3-ltr-star-md']));
            $name = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $user_ip = getUserIP();

            if ($email === false) {
                $charge = 'Formato de Email incorrecto';
            }
            $db = new SQLite3('db/bdp.db');
            $statement = $db->prepare('INSERT INTO "reviews" ("nombre", "email", "comentario", "puntuacion", "ip", "fecha")
                                                        VALUES (:nombre, :email, :comentario, :puntuacion, :ip, :fecha)');
            $statement->bindValue(':nombre', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':comentario', $message);
            $statement->bindValue(':puntuacion', $puntuacion);
            $statement->bindValue(':ip', $user_ip);
            $statement->bindValue(':fecha', date('Y-m-d H:i:s'));
            $statement->bindValue(':ip', $user_ip);
            $result = $statement->execute();
            $result->finalize();
            $aResponse['data'] = $result;
            $aResponse['code'] = 200;
            echo json_encode($result);
        } else {
            $aResponse['data'] = 'Error al procesar  el Review - Informacion Erronea';
            $aResponse['code'] = 400;
            echo json_encode($result);
        }
    } else {
        $aResponse['data'] = 'Error al procesar  el Review - Informacion Erronea';
        $aResponse['code'] = 400;
        echo json_encode($result);
    }
} catch (Exception $exc) {
    $aResponse['data'] = json_encode($e->getMessage());
    $aResponse['code'] = 400;
    echo json_encode($result);
}


function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}
