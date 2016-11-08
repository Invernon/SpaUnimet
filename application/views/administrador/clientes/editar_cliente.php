<section id="main-content">
	
		<article>
			<header>
                <h1> Editar Cliente </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
				
		<?php echo form_open("/administrador/actualizar_cliente/".$id) ?>
		
		<?php
		
				$nombre = array (
				'name' => 'nombre',
				'class' => 'formulario_caja',
				'placeholder' => 'Juan',
				'value' => $cliente->result()[0]->nombre,
				'style'=> 'color:blue'
				
				);
				
				$apellido = array (
				'name' => 'apellido',
				'class' => 'formulario_caja',
				'placeholder' => 'Gaviota',
			    'value' => $cliente->result()[0]->apellido,
				'style'=> 'color:blue'
				);
				
				$telefono = array (
				'name' => 'telefono',
				'class' => 'formulario_caja',
				'placeholder' => '04145559555',
				'type' => 'tel',
				'value' => $cliente->result()[0]->telefono,
				'style'=> 'color:blue'
				);
				
				$cedula = array (
				'name' => 'cedula',
				'class' => 'formulario_caja',
				'placeholder' => 'abc@gmail.com',
				'value' => $cliente->result()[0]->cedula,
				'style'=> 'color:blue'
				);
				

				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
					);
				
		?>
		
	           <label> Nombre </label>
               <div class="field"> 
               	<?php echo form_input($nombre) ?>
               </div>
               
               <label> Apellido </label>
               <div class="field"> 
               	<?php echo form_input($apellido) ?>
               </div>
               
               <label> Teléfono	</label>
               <div class="field"> 
               	<?php echo form_input($telefono) ?>
               </div>
               
               <label> Cedula </label>
               <div class="field"> 
               	<?php echo form_input($cedula) ?>
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