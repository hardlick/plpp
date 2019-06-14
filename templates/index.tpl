<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>[@Title]</title>
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min,local.mcss" />
	<link rel="stylesheet" type="text/css" href="css/local.css" />      
        
     <!--  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min,local_123.mcss" />-->
	
        <script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
        <script src="js/bootbox.min.js"></script>
	<script src="js/main.min.js"></script>
       
    <!--    <script src="/js/jquery-1.10.2.min,bootstrap.min,bootbox.min,main.min_123.mjs"></script>
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
                                    <div id="RetornoCatalogo" class="alert alert-success" role="alert"> Deseas saber cuales son los pasos para poder ver tu pelicula o serie en FULL HD <strong><a href="#" id="viewWhy" class="alert-link">click Aqui Para ver el manual</a></strong>,si la pelicula o serie no se encuentra disponible puedes hacernos tu pedido,<a href="#" id="order" class="alert-link">Click Aqui, Para hacer pedido nuevo</a> </div>
				<!-- CONTENT -->
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
<input id='amt' type='hidden' name='amt' value=''>
<input id='amt_r' type='hidden' name='amt_r' value=''>
</form>

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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142113171-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142113171-1');
</script>


</body>
</html>