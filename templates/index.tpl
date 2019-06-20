<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>[@Title]</title>
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/local.min.css" />
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        <script src="js/main.min.js"></script>
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
				<div class="navbar-brand">[@Title]</div>
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
                                    <div id="RetornoCatalogo" class="alert alert-warning" role="alert">¿Cómo ver una película o serie? <strong><a href="#" id="viewWhy" class="alert-link">click Aquí Para descubrirlo.</a></strong> No encuentro lo que estoy buscando <a href="#" id="order" class="alert-link">¡Quiero hacer un pedido!</a> </div>
				
[@Errors]
[@Content]
				</div>
			</div>
		</div>
	</div>
<form id='formToSecond' action='/payment.php' method="post">
<input id='i' type='hidden' name='i' value=''>
<input id='b' type='hidden' name='b' value=''>
<input id='c' type='hidden' name='c' value=''>
<input id='d' type='hidden' name='d' value=''>
<input id='amt' type='hidden' name='amt' value=''>
<input id='amt_r' type='hidden' name='amt_r' value=''>
</form>

<script type="text/javascript">
    (function () {
        var options = {
            facebook: "518981848157046", // Facebook page ID
            whatsapp: "+51943357937", // WhatsApp number
            call_to_action: "Escríbenos", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,whatsapp" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>

</body>
</html>