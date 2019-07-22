<?php

try {
    include_once './config/config.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['c'])) {
            $code_auth = trim(htmlspecialchars($_GET['c']));
            $serverDBName = db_config::$db_conection_config['baul']['serverDBName'];
            $servername = db_config::$db_conection_config['baul']['dbName'];
            $username = db_config::$db_conection_config['baul']['dbUser'];
            $password = db_config::$db_conection_config['baul']['dbPassword'];
            $db = new mysqli($serverDBName, $username, $password, $servername);
            if ($db->connect_error) {
                header('Content-type: application/json');
                echo json_encode("Problemas de conexion con la DB: " . $db->connect_error);
                die();
            }
            $confirm = $db->prepare('select * from pedidos where codigo_autorizacion=?');
            $confirm->bind_param('s', $code_auth);
            $confirm->execute();
            $result = $confirm->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $html='<html>
    <head>
        <title>Baúl  De series & Peliculas - Dejanos tu Experiencia!</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min4.1.3.css" />
        <link rel="stylesheet" type="text/css" href="/fonts/fontawesome-5.3.1/css/all.min.css">
        <script src="/js/jquery_3.2.1_jquery.min.js"></script>
        <script src="/js/bootstrap.min4.1.3.js"></script>
        <script type="text/javascript">
    $(window).on("load",function(){  $("#modalPush").modal("show"); });
</script>
    </head>
    <body>

<!--Modal: modalPush-->
<div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
         <h5 class="modal-title">Gracias por confiar en nosotros!!&#129321;&#129321;&#129321;&#129321;</h5>
      </div>
      <div class="modal-body">
        <i class="fas fa-bell fa-2x animated rotateIn mb-2"></i>
        <p>Aca la informacion de tu transaccion</p>
        <ul  class="list-group">
        <li class="list-group-item"><b>Códigos de Autorización:</b>&nbsp;'.$row['codigo_autorizacion'].'</li>
        <li class="list-group-item"><b>Códigos de Referencia:</b>&nbsp;'.$row['codigo_referencia'].'</li>
        <li class="list-group-item"><b>Tu pedido:</b>&nbsp;'.$row['descripcion'].'</li>
        <li class="list-group-item"><b>Monto Pagado:</b>&nbsp;S/ '.$row['monto_real'].'</li>
        </ul><br>
        <div class="alert alert-warning" role="alert">
  No te llego el email de confirmación?&nbsp;&nbsp; <a target="_blank" href=' . getBaseUrlReal() .' "/media/pasos_y_cuenta_general.pdf">Click Aqui</a>
</div>
<div class="alert alert-primary" role="alert">
  No te olvides de dejarnos tu experiencia!!! &nbsp;&nbsp; <a target="_blank" href="https://bauldepeliculas.info/reviews.html">Click Aqui</a>
</div>
<p>Disfruta de tu pelicula &#x1F60D;&#x1F60D; cualquier cosa estamos para apoyarte escribiendonos al Facebook &#129330;&#129330;</p>
      </div>

      <div class="modal-footer flex-center">
        <a href="https://bauldepeliculas.info/combos/combos.html" target="_blank" class="btn btn-info">Ver Combos</a>
        <a href="https://bauldepeliculas.info" target="_blank" class="btn btn-info">Terminar</a>
        
      </div>
    </div>
  </div>
</div>
    </body>';
                    
                 header('Content-Type: text/html; charset=utf-8');
                    $msg = array(
                        'rp' => '<a target="_blank" href=' . getBaseUrlReal() . '/media/pasos_y_cuenta_general.pdf>Clik Aqui</a>',
                        'rc' => $row
                    );
                    echo $html;
                    die();
                }
            } else {
                header('Content-type: application/json');
                $msg = array('Codigo no identificado');
                echo json_encode($msg);
                die();
            }
        } else {
            header('Content-type: application/json');
            $msg = array('No se puede acceder de esta manera');
            echo json_encode($msg);
            die();
        }
    } else {
        header('Content-type: application/json');
        $msg = array('No se puede acceder de esta manera');
        echo json_encode($msg);
        die();
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
