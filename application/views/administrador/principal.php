<!DOCTYPE html>
<?php

		$nombre = $this->session->userdata('nombre');
		$apellido = $this->session->userdata('apellido');

?>
<html>
    <head>
        
        <title>Administrardor Principal</title>
		<meta charset="utf-8" />
		
		<link rel="stylesheet" href="<?= base_url()?>plantilla/bootstrap/dist/css/bootstrap.css" />
		<link rel="stylesheet" href="<?= base_url()?>plantilla/css/style.css" />
		
		<noscript><link rel="stylesheet" href="<?= base_url()?> plantila/css/noscript.css" /></noscript>
    </head>
    
<body>
        
    <header id="main-header">
    
    <a id="logo-header" href="">
				<img src=" <?php echo base_url('plantilla/images/WebSpaLogoLetras.png');  ?>" weight=150 height=100 alt="" >
	
	</a> <!-- / #logo-header -->
			
	<a id="salir-header" onclick=<?php session_destroy() ?> >
		<span> Salir </span>
	</a>
	
  	</header><!-- / #main-header -->
	
	<div id="container">
		<div id='menu'>
			<ul>
				<li> <a class='menu-agenda' onclick="window.location='<?php echo site_url("administrador/agenda");?>'"> </a> </li>
				<li> <a class='menu-sesiones'onclick="window.location='<?php echo site_url("administrador/sesiones");?>'"> </a> </li>
				<li> <a class='menu-clientes' onclick="window.location='<?php echo site_url("administrador/clientes");?>'"> </a> </li>
				<li> <a class='menu-especialistas' onclick="window.location='<?php echo site_url("administrador/especialistas");?>'"> </a> </li>
				<li> <a class='menu-servicios' onclick="window.location='<?php echo site_url("administrador/servicios");?>'"> </a> </li>
				<li> <a class='menu-usuarios' onclick="window.location='<?php echo site_url("administrador/usuarios");?>'"> </a> </li>
			</ul>
		</div>
	</div>
	
	<section id="main-content">
	
		<article>
			<header>
				<h1>	Bienvenido:   <?php echo $nombre.' '.$apellido ?>
  				</h1>
			</header>
			
			<div class="content">
				
			</div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>
</html>