<!DOCTYPE html>
<html>
    <head>
        
        <title>Usuario Principal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

	
		<link rel="stylesheet" href="<?= base_url()?>plantilla/bootstrap/dist/css/bootstrap.css" />
		<link rel="stylesheet" href="<?= base_url()?>plantilla/css/style.css" />
		
		<noscript><link rel="stylesheet" href="<?= base_url()?> plantila/css/noscript.css" /></noscript>
    </head>
    
<body>
        
    <header id="main-header">
    
    <a id="logo-header" href="">
				<img src=" <?php echo base_url('plantilla/images/WebSpaLogoLetras.png');  ?>" weight=150 height=100 alt="" >
	</a> <!-- / #logo-header -->
			
	<a id="salir-header" onclick="window.location='<?php echo base_url("");?>' " > 
		<span> Salir </span>
	</a>
	
  	</header><!-- / #main-header -->
	
	<div id="container">
		<div id='menu-usuario'>
			<ul>
				<li> <a class='menu-agenda' onclick="window.location='<?php echo site_url("usuario/agenda");?>'"> </a> </li>
			
			</ul>
		</div>
	</div>
	
	<section id="main-content">
	
		<article>
			<header>
				<h1>	Bienvenido:   <?php echo $nombre.' '.$apellido ?>
			
			</header>
			
			<div class="content">
				
			</div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>
</html>