<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//$ip = $_SERVER['REMOTE_ADDR'];
//$dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
//if (isset($dataArray->geoplugin_countryName) AND $dataArray->geoplugin_countryName != 'Peru') {
//   header("Location: https://google.com");
//    die();
//}
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Catalogo de Peliculas & Series - Pago</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/css/bootstrap.min.css?version=66669">
            <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css?version=21155454">
            <link rel="stylesheet" type="text/css" href="/css/util.min.css?version=21155454">
            <link rel="stylesheet" type="text/css" href="/css/main.min.css?version=21155454">
            <script src="js/jquery-1.10.2.min.js?version=21155454"></script>
            <script src="js/bootstrap.min.js?version=21155454"></script>
            <script src="js/bootbox.min.js?version=21155454"></script>
        </head>
        <body>
            <?php
            include_once './config/config.php';
            $environment = db_config::$db_conection_config['baul']['environment'];
            $url = 'url_' . $environment;
            $urlBase = db_config::$db_conection_config['baul'][$url];
            ?>
            <?php
            $desc = '';
            $__amount = '';
            $img_c = '';
            $idUser = '';
            if (!empty($_POST['i']) && !empty($_POST['b']) && !empty($_POST['amt'])) {
                $item = htmlspecialchars($_POST['i']);
                $item = filter_var($item, FILTER_VALIDATE_INT);
                if ($item === false) {
                    exit('Informacion Incorrecta');
                }
                $desc = htmlspecialchars($_POST['b']);
                $idUser = htmlspecialchars($_POST['us']);
                $img_c = $_POST['c'];
                $__amount = trim(htmlspecialchars($_POST['amt']));
                $__amount_r = trim(htmlspecialchars($_POST['amt_r']));
                $culqi_environment = db_config::$db_conection_config['baul']['culqi_environment'];
                $culqi_key_public = 'culqi_public_' . $culqi_environment;
                $__public_key = db_config::$db_conection_config['baul'][$culqi_key_public];
                ?>
                <script src="https://checkout.culqi.com/js/v3"></script>
                <script>
                    var urlBase = '<?= $urlBase; ?>';
                    var b = '<?= $desc; ?>';
                    var descrp = '<?= $item . ' - ' . $desc; ?>';
                    var item = '<?= $item; ?>';
                    var us = '<?= $idUser; ?>';
                    var amount = '<?php echo $__amount; ?>';
                    var amount_r = '<?php echo $__amount_r; ?>';                   
                    Culqi.publicKey = '<?= $__public_key; ?>';
                </script>
                <script src="js/p.min.js?version=21155454"></script>
                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100">
                            <div class="login100-form validate-form">
                                <span class="login100-form-title p-b-7">
                                    <strong style="font-size: 22px;"><?php echo $desc; ?></strong><br>
                                    <img style="padding-top: 5px;" src="<?php echo $img_c; ?>">
                                </span>
                                <span class="login100-form-title p-b-1">
                                    Tarjeta de Crédito/Débito<br>
                                    <strong style="font-size: 20px;">S/ <?php echo $__amount_r; ?></strong>
                                </span>
                                <span class="login100-form-title p-b-5">
                                    <i class="zmdi zmdi-font"></i>
                                </span>
                                <center> Paga tus pedidos  de peliculas y/o series usando tus tarjetas de débito o crédito VISA, Mastercard, American Express o Diners que tengan código CVV.
                                    <img src="/images/icono-tarjetas.png" style="width: 250px;">
                                </center>
                                <div class="container-login100-form-btn">
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button  id="procesarPedido" class="login100-form-btn">
                                            Pagar
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center p-t-10">
                                    <span class="txt1">
                                        <ul>
                                            <li><a id="help"><b>* Click aqui para saber cuales son los pasos a seguir</b></a> </li>
                                            <li>* Toda la información de pago es segura</li>
                                            <li>* Algunas de las tarjetas de débito con CVV podrían ser rechazadas por la plataforma de pago que utilizamos debido a las políticas de seguridad del banco</li>
                                            <li>* Contamos con protección SSL para transacciones seguras
                                                <script type="text/javascript"> //<![CDATA[
                    var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
                    document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
                    //]]></script>
                                                <script language="JavaScript" type="text/javascript">
                                                    TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none");
                                                </script>
                                            </li>

                                        </ul>
                                    </span>
                                    <hr>
                                    <strong>Alerta</strong> Si en caso deseas seleccionar otra pelicula o serie en vez de esta <b><a  id="help" href="<?php echo $urlBase; ?>" class="alert-link"> Click Aquí para volver al Catálogo</a></b>, y poder volver a hacer tu pedido.
                                    <hr>
                                    <form id='formToThree' action='/paymentSecond.php' method="post">
                                        <input id='token' type='hidden' name='token' value='=789543455gdf23xvsKSJHh23'>
                                        <input id='i' type='hidden' name='i' value=''>
                                        <input id='b' type='hidden' name='b' value=''>
                                        <input id='c' type='hidden' name='c' value=''>
                                        <input id='d' type='hidden' name='d' value=''>
                                        <input id='us' type='hidden' name='us' value=''>
                                        <input id='amt' type='hidden' name='amt' value=''>
                                        <input id='amt_r' type='hidden' name='amt_r' value=''>
                                        <button type="submit"  id="OtherPayment" class="alert-link">Tienes problemas con el pago? Click Aqui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>         


                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142113171-2"></script>
                <script>
                                                    window.dataLayer = window.dataLayer || [];
                                                    function gtag() {
                                                        dataLayer.push(arguments);
                                                    }
                                                    gtag('js', new Date());

                                                    gtag('config', 'UA-142113171-2');
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
        } else {
            exit('Upss....');
        }
        ?>
    </body>
</html>