<!DOCTYPE html>
<html>
    <head>
        <title>Catalogo de Peliculas & Series - Pago</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        <style>
            #RetornoCatalogo{
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
        include_once './config/config.php';
        $environment = db_config::$db_conection_config['baul']['environment'];
        $url = 'url_' . $environment;
        $urlBase = db_config::$db_conection_config['baul'][$url];            
       
        if (!empty($_POST['i']) && !empty($_POST['b']) && !empty($_POST['amt'])) {
            $item = htmlspecialchars($_POST['i']);
            $item = filter_var($item, FILTER_VALIDATE_INT);
            if ($item === false) {
                exit('Informacion Incorrecta');
            }
            $desc = htmlspecialchars($_POST['b']);
            $__amount = trim(htmlspecialchars($_POST['amt']));
            $culqi_environment = db_config::$db_conection_config['baul']['culqi_environment'];
            $culqi_key_public = 'culqi_public_' . $culqi_environment;
            $__public_key = db_config::$db_conection_config['baul'][$culqi_key_public];
            ?>
            <script src="https://checkout.culqi.com/js/v3"></script>
            <script>
                var urlBase = '<?= $urlBase; ?>';
                var descrp = '<?= $item . ' - ' . $desc; ?>';
                var amount = '<?php echo $__amount; ?>';
                Culqi.publicKey = '<?= $__public_key; ?>';
                Culqi.settings({
                    title: 'Baul de Peliculas & Series',
                    currency: 'PEN',
                    description: descrp,
                    amount: amount
                });
                $(document).ready(function () {
                    Culqi.open();
                    $('#RetornoCatalogo').show();
                });
                function culqi() {
                   
                    if (Culqi.token) {                        
                        var dialog;
                        var token = Culqi.token.id;
                        $.ajax({
                            type: "POST",
                            data: {
                                token: token,
                                amount: amount,
                                descrp: descrp,
                                email: Culqi.token.email
                            },
                            dataType: 'json',
                            url: '/paymentProcess.php',
                            beforeSend: function () {
                                dialog = bootbox.dialog({
                                    message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i>Por favor, espere un momento...<img src="/images/Spinner-1s-73px.gif" title="Procesando..."/></p>',
                                    closeButton: false
                                });
                            },
                            complete: function (event, r) {
                                dialog.modal('hide');
                            },
                            success: function (response) {
                                var result = "";
                                if (response.constructor == String) {
                                    result = JSON.parse(response);
                                }
                                if (response.constructor == Object) {
                                    result = JSON.parse(JSON.stringify(response));
                                }
                                console.log(response);
                                if (result.object === 'charge') {
                                    bootbox.alert(response.outcome.user_message + ' Codigo Autorizacion: ' + response.reference_code, function () {
                                        window.location.replace("http://bauldepeliculas/index.php");
                                        return false;
                                    });
                                }
                                if (result.object === 'error') {
                                    bootbox.alert('Hubo un problema con la transaccion:' + result.user_message);
                                }

                            },
                            error: function (response) {
                                bootbox.alert('Hubo un problema con la transaccion' + response);
                            }
                        });

                    } else {
                        alert(Culqi.error.user_message);
                    }
                }
            </script>
            <?php
        } else {
            ?>
            <script>
                bootbox.alert('Hubo un Error al procesar la informacion, volver a la pagina principal', function () {
                    window.location.replace(urlBase);
                    return false;
                });
            </script>
            <?php
        }
        ?>
        <div id="RetornoCatalogo" class="alert alert-info" role="alert"> <strong>Y ahora?</strong> Click <a href="<?php echo $urlBase; ?>" class="alert-link">Para volver al catalogo</a>, y poder volver a hacer tu pedido. </div>
    </body>
</html>