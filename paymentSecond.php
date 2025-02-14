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
            <title>Baúl de Películas & Series - Segunda Opcion de Pago</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/css/bootstrap.min.css?version=68710332" id="bootstrap-css">
            <script src="js/jquery-1.10.2.min.js?version=68710332"></script>
            <script src="js/bootstrap.min.js?version=68710332"></script>
            <script src="js/bootbox.min.js?version=68710332"></script>
            <script src="/js/jquery.validate.min.js"></script>
            <script src="/js/additional-methods.min.js"></script>
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
                    var descrp = '<?= $item . ' - ' . $desc; ?>';
                    var item = '<?= $item; ?>';
                    var us = '<?= $idUser; ?>';
                    var amount = '<?php echo $__amount; ?>';
                    var amount_r = '<?php echo $__amount_r; ?>';
                    Culqi.publicKey = '<?= $__public_key; ?>';
                    Culqi.init();
                </script>
                <script src="js/p2.min.js?version=68710332"></script>      
                <style>
                    body {margin: 0px; 
                          padding: 0px; 
                          box-sizing: border-box;}
                    .panel-title {display: inline;font-weight: bold;}
                    .checkbox.pull-right { margin: 0; }
                    .pl-ziro { padding-left: 0px; }
                    .display-td {
                        display: table-cell;
                        vertical-align: middle;
                        width: 50%;
                    }
                    .display-td img {
                        min-width: 180px;
                    }
                </style>
                <form  name="processPaymentTwo" id="processPaymentTwo" method="post" action="" autocomplete="off">

                    <div class="container">
                        <div class="row">                           

                            <div class="col-xs-12 col-md-4">
                                 <div class="panel panel-default">
                                     <div class="panel-heading">
                                <h4 class="panel-title">
                                    INFO DE PAGO 
                                </h4>      
                                <div class="display-td" >                            
                                    <img style=" width: 50%; margin-right: -16px; margin-top: -30px;" class="img-responsive pull-right" src="/images/accepted_c22e0.png">
                                </div>
                            </div>
                                    <div class="panel-heading"><center>
                                <h4 class="panel-title">
                                  <strong style="font-size: 22px;"><?php echo $desc; ?></strong><br>
                               
                                </h4>     
                                 <img style="padding-top: 5px; max-width: 300px" src="<?php echo $img_c; ?>">
                                  </center>
                            </div>
                            
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label for="card[number]">
                                                NUMERO DE TARJETA</label>
                                            <div class="input-group">
                                                <input autocomplete="false" type="text" class="form-control" name="cardNumber" data-culqi="card[number]" id="card[number]" placeholder="Numero de Tarjeta" required autofocus />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="form-group">
                                                    <label for="card[exp_month]">
                                                        FECHA EXPIRACION</label>
                                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                                        <input autocomplete="false" type="text" class="form-control" name="exp_month" maxlength="2"  data-culqi="card[exp_month]" id="card[exp_month]" placeholder="MM" required />
                                                    </div>
                                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                                        <input autocomplete="false" type="text" class="form-control" name="exp_year"  maxlength="4" data-culqi="card[exp_year]" id="card[exp_year]" placeholder="YYYY" required /></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="form-group">
                                                    <label for="card[cvv]">
                                                        CODIGO CVV</label>
                                                    <input autocomplete="false" type="text" class="form-control" name="cvv"  maxlength="3"  data-culqi="card[cvv]" id="card[cvv]" placeholder="CV" required />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="card[email]">
                                                EMAIL</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="email" data-culqi="card[email]" id="card[email]" placeholder="Correo Electronico" required autofocus />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                            </div>
                                        </div>                                 
                                <ul class="nav nav-pills nav-stacked" style="padding-bottom: 5px;">
                                    <li class="active"><a href="#"><span class="badge pull-right"><span style="font-size: 1.5em;">S/<?php echo $__amount_r; ?></span></span>MONTO A PAGAR</a>
                                    </li>
                                </ul>
                                <button type="submit"  id="SubmitReview" class="btn btn-success btn-lg btn-block">
                                    PAGAR
                                </button>                           
                                <span class="txt1">
                                    <ul>                                        
                                        <li>Toda la información de pago es segura</li>
                                        <li>Algunas de las tarjetas de débito con CVV podrían ser rechazadas por la plataforma de pago que utilizamos debido a las políticas de seguridad del banco</li>
                                        <li>Contamos con protección SSL para transacciones seguras
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
                                 <div class=" wow fadeInLeft" data-wow-delay="0.9s">                                                     
                            <p>El tiempo de acceso a nuestra plataforma depende de tu tipo de pedido. <br>Te detallamos los días de acceso disponibles según tu pedido.</p>
                            <strong>PELICULAS:</strong>
                            <ul>
                                <li> 1 Pelicula: 1 Semana</li>
                                <li> Combo 3 Peliculas: 2 Semanas</li>
                                <li> Combo 5 Peliculas: 1 Mes</li>
                                <li> Combo 10 Peliculas: 2 Meses</li>                                   
                            </ul>
                            <strong>SERIES:</strong>
                            <ul>
                                <li>Por un capítulo :  2 días</li>
                                <li>Por una temporada : 2 Semanas</li>
                                <li>Serie completa: 1 Mes</li>                                   
                                <li>Combo 2 Series: 2 Meses</li>      
                                <li>Combo 3 Series: 3 Meses</li>      
                                <li>Combo 5 Series: 5 Meses</li>
                            </ul>
                            <a  id="help" href="/combos/combos.html" class="alert-link">Deseas saber mas de nuestros combos? - Click Aqui</a>

                        </div>
                                           </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            } else {
                ?>
                <script>
                    var urlBase = '<?= $urlBase; ?>';
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