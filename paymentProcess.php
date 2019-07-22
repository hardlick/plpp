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
             
                $msg = array(
                    'rp'=>'<a target="_blank" href=' . getBaseUrlReal() . '/media/pasos_y_cuenta_general.pdf>Click Aqui</a>'
                    );
                echo json_encode($msg);
        } else {
            header('Content-type: application/json');
            $charge = array('Error al procesar Pago - Informacion Erronea - Faltan Parametros');
            echo json_encode($charge);
            die();
        }
        header('Content-type: application/json');
        echo json_encode($charge);
    } else {
        header('Content-type: application/json');
        $charge = array('Peticion Erronea - Mal metodo');
        echo json_encode($charge);
        die();
    }
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}