<!DOCTYPE HTML>

<html>
	<head>
		<title>Spa</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="<?= base_url()?>plantilla/css/main.css" />
		
		<noscript><link rel="stylesheet" href="<?= base_url()?> plantila/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class="box"> <img src=" <?php echo base_url('plantilla/images/WebSpaLogo.png');  ?>"  width=350 height=150 alt="" /></span>
							<h1>Bienvenidos</h1>
						</header>
						
						<hr/>
						
						<?php echo validation_errors(); ?>
						<?php echo form_open("/welcome/login"); 
							
							$usuario = array (
							'name' => 'user',
							'id' => 'user',
							'placeholder' => 'Usuario',
							'value' => NULL
							);
							
							$password = array (
							'name' => 'password',
							'id' => 'password',
							'type' => 'password',
							'placeholder' => 'Contraseña',
							);
							
							$enviar = array (
							'class' => 'btn btn-info ',
							'value' => 'Ingresar'
							
							)
						
						?>
						
						<form method="Login" >
							<div class="field">
								<?php echo form_input($usuario) ?>
							</div>
							<div class="field">
								<?php echo form_input($password) ?>
							</div>
							
						<?= form_submit($enviar) ?>
               
      					</form>
      					
						<?= form_close() ?>
						<hr/>
						
					
					</section> 

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; Unimet</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>