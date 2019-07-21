<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
try {
    include_once './config/config.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $event = trim(htmlspecialchars($_POST['event']));
        $serverDBName = db_config::$db_conection_config['baul']['serverDBName'];
        $servername = db_config::$db_conection_config['baul']['dbName'];
        $username = db_config::$db_conection_config['baul']['dbUser'];
        $password = db_config::$db_conection_config['baul']['dbPassword'];


        if ($event == 'true') {
            if (!empty($_POST['code_auth']) && !empty($_POST['code_reference']) && !empty($_POST['email']) && !empty($_POST['amount']) && !empty($_POST['descrp'])) {
                $item = trim(htmlspecialchars($_POST['item']));
                $amount = trim(htmlspecialchars($_POST['amount']));
                $amount_r = trim(htmlspecialchars($_POST['amount_r']));
                $descrp = trim(htmlspecialchars($_POST['descrp']));
                $email = trim(htmlspecialchars($_POST['email']));

                $user_ip = getUserIP();
                $code_auth = trim(htmlspecialchars($_POST['code_auth']));
                $code_reference = trim(htmlspecialchars($_POST['code_reference']));

                if (isset($_POST['us'])) {
                    $idUser = trim(htmlspecialchars($_POST['us']));
                } else {
                    $idUser = null;
                }

                $db = new mysqli($serverDBName, $username, $password, $servername);
                if ($db->connect_error) {
                    header('Content-type: application/json');
                    $msg = array("Problemas de conexion con la DB: " . $db->connect_error);
                    echo json_encode($msg);
                    die();
                }
                $fecha_pedido = date('Y-m-d H:i:s');
                $stmt = $db->prepare("INSERT INTO pedidos (item, descripcion, monto, codigo_referencia, codigo_autorizacion, fecha_pedido, email, fecha_creacion, ip,idUser) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");
                $stmt->bind_param('ssssssssss', $item, $descrp, $amount, $code_reference, $code_auth, $fecha_pedido, $email, $fecha_pedido, $user_ip, $idUser);
                $stmt->execute();
                $stmt->close();
                $result = $db->close();

                $mail_to_client = new PHPMailer(true);
                $mail_to_client->isSMTP();
                $mail_to_client->CharSet = 'UTF-8';
                $mail_to_client->Encoding = 'base64';
                //$mail_to_client->SMTPDebug = 2; //Alternative to above constant
                $mail_to_client->Host = 'smtp.gmail.com';
                $mail_to_client->SMTPAuth = true;
                $mail_to_client->Username = 'bauldepeliculasgeneral@gmail.com';
                $mail_to_client->Password = 'Jt011@395';
                $mail_to_client->SMTPSecure = 'tls';
                $mail_to_client->Port = 587;
                $mail_to_client->setFrom('bauldepeliculas1@gmail.com', 'Baul de Peliculas & Series');
                $mail_to_client->addAddress($email);
                $mail_to_client->addBCC('hugocasanovam@gmail.com', 'Person Two');
                $mail_to_client->Subject = 'Gracias por tu Pedido: ' . $descrp;
                $message = '<h2>Gracias por confiar en nosotros!</h2><hr><br><h3>Los datos de tu pedido fue: ' . $descrp;
                $message .= '</h3><br><h3>Monto Pagado: ' . $amount_r . '</h3><br>';
                $message .= '</h4><br><h3>Codigo de Referencia: ' . $code_reference . '- -' . $code_auth; '</h4><br>';
                $message .= '<h4>Adjuntamos el pdf para poder acceder a nuestro contenido y disfrutar de la pelicula elegida.</h4>';
                $message .= '<h4>Aca tambien el link con el mismo archivo adjunto: </h4><a target="_blank" href=' . getBaseUrlReal() . '/media/pasos_y_cuenta_general.pdf>Clik Aqui</a>';
                $message .= '<h4>Cualquier cosa, comunicate con nosotros via whatsapp</h4><a target="_blank" href="http://bit.do/eS7dC" >http://bit.do/eS7dC </a>';
                $message .= '<h4>Al finalizar tu experiencia con nosotros, podrias comentarnoslo?</h4><a target="_blank" href="https://bauldepeliculas.info/reviews.html" >CLick aqui!</a>';
                $mail_to_client->AddAttachment($_SERVER['DOCUMENT_ROOT'] . '/media/pasos_y_cuenta_general_min.pdf', $name = 'pasos_y_cuenta_general_min.pdf', $encoding = 'base64', $type = 'application/pdf');
                $mail_to_client->msgHTML($message);
                $mail_to_client->send();
                header('Content-type: application/json');
                echo json_encode($mail_to_client);
            } else {
                header('Content-type: application/json');
                $msg = array('Faltan parametros para procesar su pago');
                echo json_encode($msg);
            }
        } else {
            if (!empty($_POST['codigo_error']) && !empty($_POST['merchant_message']) && !empty($_POST['amount']) && !empty($_POST['descrp'])) {

                $item = trim(htmlspecialchars($_POST['item']));
                $amount = trim(htmlspecialchars($_POST['amount']));
                $descrp = trim(htmlspecialchars($_POST['descrp']));
                $email = trim(htmlspecialchars($_POST['email']));

                if (isset($_POST['us'])) {
                    $idUser = trim(htmlspecialchars($_POST['us']));
                } else {
                    $idUser = null;
                }
                if ($email == '') {
                    $email = 'hugocasanovam@gmail.com';
                }
                $user_ip = getUserIP();

                $codigo_error = trim(htmlspecialchars($_POST['codigo_error']));
                $type = trim(htmlspecialchars($_POST['type']));
                $merchant_message = trim(htmlspecialchars($_POST['merchant_message']));
                $user_message = trim(htmlspecialchars($_POST['user_message']));
                $fecha_pedido = date('Y-m-d H:i:s');
                $db = new mysqli($serverDBName, $username, $password, $servername);
                if ($db->connect_error) {
                    header('Content-type: application/json');
                    $msg = array('Problemas de conexion con la DB: ');
                    echo json_encode($msg . $db->connect_error);
                    die();
                }
                $stmt = $db->prepare("INSERT INTO pedidos_error (item, descripcion, monto, type, codigo_error, merchant_message, user_message, fecha_pedido, email,ip,idUser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('sssssssssss', $item, $descrp, $amount, $type, $codigo_error, $merchant_message, $user_message, $fecha_pedido, $email, $user_ip, $idUser);
                $stmt->execute();
                $stmt->close();
                $result = $db->close();
                echo json_encode($result);
            } else {
                header('Content-type: application/json');
                $msg = array('Faltan parametros hubo un error al procesar su pago');
                echo json_encode($msg);
            }
        }
    } else {
        header('Content-type: application/json');
        $msg = array('No se puede acceder de esta manera');
        echo json_encode($msg);
    }
} catch (Exception $e) {
    header('Content-type: application/json');
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

/**
 * Suppose, you are browsing in your localhost 
 * http://localhost/myproject/index.php?id=8
 */
function getBaseUrl() {
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];

    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath);

    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';

    // return: http://localhost/myproject/
    return $protocol . '://' . $hostName . $pathInfo['dirname'] . "/";
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
