<?php

try {
    include_once './config/config.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require 'vendor/autoload.php';

        $culqi_environment = db_config::$db_conection_config['baul']['culqi_environment'];
        $culqi_key_private = 'culqi_private_' . $culqi_environment;
        $SECRET_KEY = db_config::$db_conection_config['baul'][$culqi_key_private];

        if (!empty($_POST['token']) && !empty($_POST['email']) && !empty($_POST['amount']) && !empty($_POST['descrp'])) {
            $culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
            $token = $_POST['token'];
            $amount = trim(htmlspecialchars($_POST['amount']));
            $amount = filter_var($amount, FILTER_VALIDATE_INT);
            if ($amount === false) {
                header('Content-type: application/json');
                $charge = array('Formato Incorrecto de Precio');
                echo json_encode($charge);
                die();
            }
            $descrp = trim(htmlspecialchars($_POST['descrp']));
            $email = trim(htmlspecialchars($_POST['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email === false) {
                header('Content-type: application/json');
                $charge = array('Formato de Email incorrecto');
                echo json_encode($charge);
                die();
            }
            $charge = $culqi->Charges->create(
                    array(
                        "amount" => $amount,
                        "capture" => true,
                        "currency_code" => "PEN",
                        "description" => $descrp,
                        "installments" => 0,
                        "email" => $email,
                        "source_id" => $token
                    )
            );
              header('Content-type: application/json');
               echo json_encode($charge);
                die();
        } else {
            header('Content-type: application/json');
            $charge = array('Error al procesar Pago - Informacion Erronea - Faltan Parametros');
            echo json_encode($charge);
            die();
        }
       
    } else {
        header('Content-type: application/json');
        $charge = array('Peticion Erronea - Mal metodo');
        echo json_encode($charge);
        die();
    }
} catch (Exception $e) {
    echo json_encode($e->getMessage());
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

function getBaseUrlReal() {
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];

    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath);

    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';

    // return: http://localhost/myproject/
    return $protocol . '://' . $hostName;
}