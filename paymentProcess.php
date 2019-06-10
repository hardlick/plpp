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
                $charge = 'Formato Incorrecto de Precio';
            }
            $descrp = trim(htmlspecialchars($_POST['descrp']));
            $email = trim(htmlspecialchars($_POST['email']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email === false) {
                $charge = 'Formato de Email incorrecto';
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
        } else {
            $charge = 'Error al procesar Pago - Informacion Erronea';
        }
        
        echo json_encode($charge);
    } else {
        echo json_encode('Peticion Erronea');
    }
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}