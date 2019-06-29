<?php

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $aResponse['data'] = FALSE;
        $aResponse['code'] = 400;
        include_once './config/config.php';
        if (!empty($_POST['input-3-ltr-star-md']) && !empty($_POST['email']) && !empty($_POST['message']) && !empty($_POST['name'])) {
            
        $serverDBName = db_config::$db_conection_config['baul']['serverDBName'];
        $servername = db_config::$db_conection_config['baul']['dbName'];
        $username = db_config::$db_conection_config['baul']['dbUser'];
        $password = db_config::$db_conection_config['baul']['dbPassword'];
            if(isset($_POST['profileid'])){
            $profileid = trim(htmlspecialchars($_POST['profileid']));
            }else{
                $profileid =NULL;
            }
            $message = trim(htmlspecialchars($_POST['message']));
            $puntuacion = trim(htmlspecialchars($_POST['input-3-ltr-star-md']));
            $name = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $user_ip = getUserIP();

            if ($email === false) {
                $charge = 'Formato de Email incorrecto';
            }
            
            $db = new mysqli($serverDBName, $username, $password,$servername);
                if ($db->connect_error) {
                    echo json_encode("Problemas de conexion con la DB: " . $db->connect_error);
                    die();
                }
                $fecha_pedido =date('d/m/Y h:i A');
                $fecha_real = date('Y-m-d H:i:s');
                $stmt = $db->prepare("INSERT INTO reviews (nombre,email,comentario, puntuacion, ip,fecha,profileid,fecha_real) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
                $stmt->bind_param('ssssssss',$name, $email,$message,$puntuacion,$user_ip,$fecha_pedido,$profileid,$fecha_real);               
                $stmt->execute();
                $stmt->close();
                $db->close();          
            
            $aResponse['data'] ='Ok';
            $aResponse['code'] = 200;
            echo json_encode($aResponse);
        } else {
            $aResponse['data'] = 'Error al procesar  el Review - Informacion Erronea';
            $aResponse['code'] = 400;
            echo json_encode($aResponse);
        }
    } else {
        $aResponse['data'] = 'Error al procesar  el Review - Informacion Erronea';
        $aResponse['code'] = 400;
        echo json_encode($aResponse);
    }
} catch (Exception $exc) {
    $aResponse['data'] = json_encode($e->getMessage());
    $aResponse['code'] = 400;
    echo json_encode($aResponse);
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
