<html>

     <head>
        
        <title>Manager - Sesiones </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

	
		<link rel="stylesheet" href="<?= base_url()?>plantilla/bootstrap/dist/css/bootstrap.css" />
		<link rel="stylesheet" href="<?= base_url()?>plantilla/css/style.css" />
		
		<noscript><link rel="stylesheet" href="<?= base_url()?> plantila/css/noscript.css" /></noscript>
    </head>


<body>
    
    <header id="main-header">
    
    <a id="logo-header" href="../index.html">
				<img src=" <?php echo base_url('images/WebSpaLogoLetras.png'); ?>" weight=150 height=100 alt="" >
			<!--	<span class="site-desc">Tranquilidad absoluta</span> -->
	</a> <!-- / #logo-header -->
			
	<a id="salir-header" href="../index.html">
		<span> Salir </span>
	</a>
	
  	</header><!-- / #main-header -->
	
	<div id="container">
		<div id='menu'>
			<ul>
                <li> <a class='menu-agenda' href="agenda.html"> </a> </li>
				<li> <a class='menu-sesiones-active'> </a> </li>
				<li> <a class='menu-clientes' href="clientes.html" > </a> </li>
				<li> <a class='menu-especialistas' href='especialistas.html'> </a> </li>
				<li> <a class='menu-servicios' href='servicios.html'> </a> </li>
				<li> <a class='menu-usuarios' href='usuarios.html'> </a> </li>
			</ul>
		</div>
	</div>
	
	<section id="main-content">
	
		<article>
			<header>
                <h1> Sesiones </h1>
			</header>
			
            <div class="content">
               
               <button type="button" class="btn btn-default btn-lg btn-block" > Lista de Sesiones </button>
               
	           <button type="button" class="btn btn-default btn-lg btn-block" > Nueva Sesion </button> 
	           
	           <button type="button" class="btn btn-default btn-lg btn-block" > Agendar Sesion </button>
	           
	        	</div>
	        	
			</div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

    </body>

</html>