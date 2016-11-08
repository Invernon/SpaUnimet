<section id="main-content">
	
		<article>
			<header>
                <h1> Nueva Agenda </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
				
		<?php echo form_open("/administrador/recibir_nueva_agenda") ?>
		
		<?php
				
				
				$fecha = array (
				'name' => 'fecha',
				'class' => 'formulario_caja',
				'placeholder' => 'aaaa-mm-dd'
				);
				
				
				
		?>
               
               <label> Fecha </label>
               <div class="field"> 
               	<?php echo form_input($fecha) ?>
               </div>
               
               </br>
               
               <?= form_submit($enviar) ?>
               
               <?= form_close() ?>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>