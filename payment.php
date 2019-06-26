<?php
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
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/util.min.css">
        <link rel="stylesheet" type="text/css" href="/css/main.min.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        <style>

            ul
            {
                list-style-type: none;
                padding: 0;
                margin: 0;
                text-align: left;
            }

            li
            {
                
                background-repeat: no-repeat;
                background-position: 100% .4em;
                padding-right: .6em;
            }
            hr{
                margin-top: 10px;
margin-bottom: 10px;
            }
        </style>

    </head>
    <body>
        <?php
        include_once './config/config.php';
        $environment = db_config::$db_conection_config['baul']['environment'];
        $url = 'url_' . $environment;
        $urlBase = db_config::$db_conection_config['baul'][$url];
        ?>
        <?php
        $desc ='';
        $__amount = '';
        $img_c = '';
        if (!empty($_POST['i']) && !empty($_POST['b']) && !empty($_POST['amt'])) {
            $item = htmlspecialchars($_POST['i']);
            $item = filter_var($item, FILTER_VALIDATE_INT);
            if ($item === false) {
                exit('Informacion Incorrecta');
            }
            $desc = htmlspecialchars($_POST['b']);
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
                var descrp = '<?= $item . ' - ' . $desc; ?>';
                var item = '<?= $item; ?>';
                var amount = '<?php echo $__amount; ?>';
                var amount_r = '<?php echo $__amount_r; ?>';     
                Culqi.publicKey = '<?= $__public_key; ?>';
            </script>
            <script src="js/p.min.js"></script>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-form validate-form">
                            <span class="login100-form-title p-b-26">
                                <strong style="font-size: 32px;"><?php echo $desc; ?></strong><br>
                                <img src="<?php echo $img_c; ?>">
                            </span>
                            <span class="login100-form-title p-b-1">
                                Tarjeta de Crédito o Débito<br>
                                 <strong style="font-size: 25px;">S/ <?php echo $__amount_r; ?></strong><br>
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
                                <strong>Alerta</strong> Si en caso deseas seleccionar otra pelicula o serie en vez de esta <b><a href="<?php echo $urlBase; ?>" class="alert-link"> Click Aquí para volver al Catálogo</a></b>, y poder volver a hacer tu pedido.
                            </div>
                        </div>
                    </div>
                </div>
            </div>         
            <!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "518981848157046", // Facebook page ID
            whatsapp: "+51943357937", // WhatsApp number
            call_to_action: "Escríbenos", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142113171-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
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
        ?>
    </body>
</html>