<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>[@Title]</title>
        <meta name="description" content="Bienvenido a Baúl de películas & series. 
              Somos una multi-plataforma en línea que te ofrece más de 5000 películas y series disponibles en calidad Full HD y actualizadas semanalmente con los últimos estrenos.
              -Cómo lo hacemos?  Nos encargamos de seleccionar las mejores películas y series para reunirlas en un solo lugar, no tendrás que perder tiempo, buscando entre las mil páginas gratuitas que te ofrecen películas mal grabadas, series no disponibles, que vienen con más virus que minutos de reproducción.
              Baúl de películas & series será tu mejor opción, sabes por qué?
              🏡Desde la comodidad de tu hogar.
              📺 Para ver en Smart TV, 📲 dispositivos móviles.
              🎥 Calidad full HD
              🌐 Plataforma 100% segura y rápida.
              ⛔ Sin virus ni publicidad.
              ✌Aceptamos todas las tarjetas de crédito y débito.🕵‍♀¿No encuentras tu película o serie en nuestro catálogo?📲Haz tu pedido ya!">
        <meta name="og:description" content="Bienvenido a Baúl de películas & series. Somos una multi-plataforma en línea que te ofrece más de 5000 películas y series disponibles en calidad Full HD. Nos encargamos de seleccionar las mejores películas y series para reunirlas en un solo lugar">
        <meta name="keywords" content="peliculas,series,baul de peliculas">
        <meta name="author" content="Baúl  De series & Peliculas">
        <meta property="og:url" content="https://bauldepeliculas.info" />
        <meta property="og:image" content="https://bauldepeliculas.info/apple-icon-180x180.png" />	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css?version=8322222" />
	<link rel="stylesheet" type="text/css" href="/css/local.min.css?version=8322222" />
        <script src="/js/jquery-1.10.2.min.js?version=8322222"></script>
        <script src="/js/bootstrap.min.js?version=8322222"></script>
        <script src="/js/bootbox.min.js?version=8322222"></script>
        <script src="/js/main.min.js?version=8322222"></script>
[@Include]
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-brand">Baúl  De series & Peliculas</div>
                                <div id="navbar" class="navbar-collapse collapse" style="margin-left: 300px;">
                                <ul class="naver">
                                    <li><a href="index.html">Inicio</a></li>
                                    <li><a href="movies.php">Peliculas</a></li>
                                    <li><a href="series.php">Series</a></li>            
                                </ul>
                          </div>
			</div>
                            
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul id="active" class="nav navbar-nav side-nav">
[@Menu]
				</ul>
			</div>
		</nav>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
                                    <span>Ver todas las:&nbsp;&nbsp; [@Catalogo]</span>
                                    <br>
                                    <div id="onlyM">
                                    <div>
                                     Por Género:<br>
                                     [@generos]</div>
                                    <div>
                                      <br/>  Por Año:&nbsp;&nbsp;
                                      <select name="anio" id="anio" onchange="location = this.value;">
                                        <option value='' id="0">Seleccione...</option>
                                        <option value='?year=1990&item=1&type=library' id="1990">1990</option>
                                        <option value='?year=1991&item=1&type=library' id="1991">1991</option>
                                        <option value='?year=1992&item=1&type=library' id="1992">1992</option>
                                        <option value='?year=1993&item=1&type=library' id="1993">1993</option>
                                        <option value='?year=1994&item=1&type=library' id="1994">1994</option>
                                        <option value='?year=1995&item=1&type=library' id="1995">1995</option>
                                        <option value='?year=1996&item=1&type=library' id="1996">1996</option>
                                        <option value='?year=1997&item=1&type=library' id="1997">1997</option>
                                        <option value='?year=1998&item=1&type=library' id="1998">1998</option>
                                        <option value='?year=1999&item=1&type=library' id="1999">1999</option>
                                        <option value='?year=2000&item=1&type=library' id="2000">2000</option>
                                        <option value='?year=2001&item=1&type=library' id="2001">2001</option>
                                        <option value='?year=2002&item=1&type=library' id="2002">2002</option>
                                        <option value='?year=2003&item=1&type=library' id="2003">2003</option>
                                        <option value='?year=2004&item=1&type=library' id="2004">2004</option>
                                        <option value='?year=2005&item=1&type=library' id="2005">2005</option>
                                        <option value='?year=2006&item=1&type=library' id="2006">2006</option>
                                        <option value='?year=2007&item=1&type=library' id="2007">2007</option>
                                        <option value='?year=2008&item=1&type=library' id="2008">2008</option>
                                        <option value='?year=2009&item=1&type=library' id="2009">2009</option>
                                        <option value='?year=2010&item=1&type=library' id="2010">2010</option>
                                        <option value='?year=2011&item=1&type=library' id="2011">2011</option>
                                        <option value='?year=2012&item=1&type=library' id="2012">2012</option>
                                        <option value='?year=2013&item=1&type=library' id="2013">2013</option>
                                        <option value='?year=2014&item=1&type=library' id="2014">2014</option>
                                        <option value='?year=2015&item=1&type=library' id="2015">2015</option>
                                        <option value='?year=2016&item=1&type=library' id="2016">2016</option>
                                        <option value='?year=2017&item=1&type=library' id="2017">2017</option>
                                        <option value='?year=2018&item=1&type=library' id="2018">2018</option>
                                        <option value='?year=2019&item=1&type=library' id="2019">2019</option>                                        
                                       </select>
                                      <span>Año Seleccionado: <b id="anioSelected"></b></span>
                                     </div>
                                        </div>
                                    <div style="margin-top: 5px;" id="RetornoCatalogo" class="alert alert-warning" role="alert">¿Cómo ver una película o serie? <strong><a href="#" id="viewWhy" class="alert-link">click Aquí Para descubrirlo.</a></strong> No encuentro lo que estoy buscando <a href="#" id="order" class="alert-link">¡Quiero hacer un pedido!</a> </div>
                                    <div id="viewPacks" class="alert alert-warning" role="alert">Tambien tenemos Combos!,<strong><a href="/combos/combos.html" id="viewPacks" class="alert-link"> Click Aqui para conocerlos!</a></strong></div>				 
[@Errors]
[@Content]
				</div>
			</div>
		</div>          
	</div>
<form id='formToSecond' action='/payment.php' method="post">
<input id='token' type='hidden' name='token' value='=u72re8rdb6uvujqn6s31MXBNhsdgb'>
<input id='i' type='hidden' name='i' value=''>
<input id='b' type='hidden' name='b' value=''>
<input id='c' type='hidden' name='c' value=''>
<input id='d' type='hidden' name='d' value=''>
<input id='us' type='hidden' name='us' value=''>
<input id='amt' type='hidden' name='amt' value=''>
<input id='amt_r' type='hidden' name='amt_r' value=''>
</form>
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "518981848157046", // Facebook page ID
            call_to_action: "Haz tu pedido", // Call to action
            position: "right" // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142113171-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142113171-1');
</script>
</body>
</html>