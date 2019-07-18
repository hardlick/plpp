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
            <link rel="stylesheet" href="/css/bootstrap.min.css?version=66669" id="bootstrap-css">

            <script src="js/jquery-1.10.2.min.js?version=66669"></script>
            <script src="js/bootstrap.min.js?version=66669"></script>
            <script src="js/bootbox.min.js?version=66669"></script>
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
                <script src="js/p2.js?version=66669"></script>      
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
<form  name="processPaymentTwo" id="processPaymentTwo" method="post" action="">

                <div class="container">
                    <div class="row">
                        
                       <div class="col-xs-12 col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    INFO DE PAGO
                                    </h4>      
                                    <div class="display-td" >                            
                                        <img style=" width: 50%; margin-right: -16px; margin-top: -30px;" class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                    </div>
                                </div>
                                <div class="panel-body">
                                      
                                        <div class="form-group">
                                            <label for="card[number]">
                                                NUMERO DE TARJETA</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="cardNumber" data-culqi="card[number]" id="card[number]" placeholder="Numero de Tarjeta" required autofocus />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7">
                                                <div class="form-group">
                                                    <label for="card[exp_month]">
                                                        FECHA EXPIRACION</label>
                                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                                        <input type="text" class="form-control" name="exp_month" maxlength="2"  data-culqi="card[exp_month]" id="card[exp_month]" placeholder="MM" required />
                                                    </div>
                                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                                        <input type="text" class="form-control" name="exp_year"  maxlength="4" data-culqi="card[exp_year]" id="card[exp_year]" placeholder="YYYY" required /></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="form-group">
                                                    <label for="card[cvv]">
                                                        CODIGO CVV</label>
                                                    <input type="password" class="form-control" name="cvv"  maxlength="3"  data-culqi="card[cvv]" id="card[cvv]" placeholder="CV" required />
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
                                  
                                </div>
                            </div>
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#"><span class="badge pull-right"><span style="font-size: 1.5em;">S/<?php echo $__amount_r; ?></span></span>MONTO A PAGAR</a>
                                </li>
                            </ul>
                            <br/>
                              <button type="submit"  id="SubmitReview" class="btn btn-success btn-lg btn-block">
                            PAGAR
                        </button>                           

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