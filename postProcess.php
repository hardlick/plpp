<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
try {
    include_once './config/config.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $event = trim(htmlspecialchars($_POST['event']));
        if ($event == 'true') {
            if (!empty($_POST['code_auth']) && !empty($_POST['code_reference']) && !empty($_POST['email']) && !empty($_POST['amount']) && !empty($_POST['descrp'])) {

                $item = trim(htmlspecialchars($_POST['item']));
                $amount = trim(htmlspecialchars($_POST['amount']));
                $descrp = trim(htmlspecialchars($_POST['descrp']));
                $email = trim(htmlspecialchars($_POST['email']));
                $user_ip = getUserIP();
                $db = new SQLite3('db/bdp.db');

                $code_auth = trim(htmlspecialchars($_POST['code_auth']));
                $code_reference = trim(htmlspecialchars($_POST['code_reference']));
                $statement = $db->prepare('INSERT INTO "pedidos" ("item", "descripcion", "monto", "codigo_referencia", "codigo_autorizacion", "fecha_pedido", "email", "fecha_creacion", "ip")
    VALUES (:item, :descripcion, :monto, :codigo_referencia, :codigo_autorizacion, :fecha_pedido, :email, :fecha_creacion, :ip)');
                $statement->bindValue(':item', $item);
                $statement->bindValue(':descripcion', $descrp);
                $statement->bindValue(':monto', $amount);
                $statement->bindValue(':codigo_referencia', $code_reference);
                $statement->bindValue(':codigo_autorizacion', $code_auth);
                $statement->bindValue(':fecha_pedido', date('Y-m-d H:i:s'));
                $statement->bindValue(':email', $email);
                $statement->bindValue(':fecha_creacion', date('Y-m-d H:i:s'));
                $statement->bindValue(':ip', $user_ip);
                $result = $statement->execute();
                $result->finalize();

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true; 
                $mail->Username = 'bauldepeliculas1@gmail.com'; 
                $mail->Password = 'peliculas2019';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('bauldepeliculas1@gmail.com', 'Baul de Peliculas & Series');
                $mail->addAddress($email);
                $mail->Subject = 'Nuevo pedido:' .$code_reference. '- -'.$code_auth;
                $mail->msgHTML($descrp);
                $mail->send();
                 echo json_encode($result);
            } else {
                echo json_encode('Faltan parametros');
            }
        } else {
            if (!empty($_POST['codigo_error']) && !empty($_POST['merchant_message']) && !empty($_POST['amount']) && !empty($_POST['descrp'])) {
                
                $item = trim(htmlspecialchars($_POST['item']));
                $amount = trim(htmlspecialchars($_POST['amount']));
                $descrp = trim(htmlspecialchars($_POST['descrp']));
                $email = trim(htmlspecialchars($_POST['email']));
                if($email==''){
                    $email = 'hugocasanovam@gmail.com';
                }
                var_dump($email);
                die();
                $user_ip = getUserIP();
                $db = new SQLite3('db/bdp.db');
                $codigo_error = trim(htmlspecialchars($_POST['codigo_error']));
                $type = trim(htmlspecialchars($_POST['type']));
                $merchant_message = trim(htmlspecialchars($_POST['merchant_message']));
                $user_message = trim(htmlspecialchars($_POST['user_message']));

                $statement = $db->prepare('INSERT INTO "pedidos_error" ("item", "descripcion", "monto", "type","codigo_error", "merchant_message", "user_message", "fecha_pedido", "email", "ip")
    VALUES (:item, :descripcion, :monto,:type, :codigo_error, :merchant_message, :user_message, :fecha_pedido, :email, :ip)');
                $statement->bindValue(':item', $item);
                $statement->bindValue(':descripcion', $descrp);
                $statement->bindValue(':monto', $amount);
                $statement->bindValue(':type', $type);
                $statement->bindValue(':codigo_error', $codigo_error);
                $statement->bindValue(':merchant_message', $merchant_message);
                $statement->bindValue(':user_message', $user_message);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':fecha_pedido', date('Y-m-d H:i:s'));
                $statement->bindValue(':ip', $user_ip);
                $result = $statement->execute();
                $result->finalize();
                
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true; 
                $mail->Username = 'bauldepeliculas1@gmail.com'; 
                $mail->Password = 'peliculas2019';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('bauldepeliculas1@gmail.com', 'Baul de Peliculas & Series');
                $mail->addAddress($email);
                $mail->Subject = 'Error en pedido:' .$codigo_error. '- -'.$user_message;
                $mail->msgHTML($descrp.'-- ip: --'.$user_ip);
                $mail->send();
                echo json_encode($result);
            } else {
                echo json_encode('Faltan parametros');
            }
        }
    } else {
        echo json_encode('Peticion Erronea');
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
