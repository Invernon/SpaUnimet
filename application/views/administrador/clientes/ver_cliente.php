<section id="main-content">
	
		<article>
			<header>
                <h1> Ver Cliente </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
		
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
				'placeholder' => '25518282',
				'value' => $cliente->result()[0]->cedula,
				'style'=> 'color:blue'
				);
				
				$enviar = array (
					'class' => 'btn btn-info',
					'value' => 'Regresar' ,
					'name'	=> 'button',
					'style' => 'margin-bottom:10px; width:97%;'
					);
				
		?>
		
	           <label> Nombre </label>
               <div class="field field_ver"> 
               	<?php echo ($nombre['value'])?>
               </div>
               
               <label> Apellido </label>
               <div class="field field_ver"> 
               	<?php echo ($apellido['value']) ?>
               </div>
               
               <label> Teléfono	</label>
               <div class="field field_ver"> 
               	<?php echo ($telefono['value']) ?>
               </div>
               
               <label> Cedula </label>
               <div class="field field_ver"> 
               	<?php echo ($cedula['value']) ?>
               </div>
               
               </br>
               
               <button class="btn btn-info" style="margin-bottom:10px; width:97%;" onClick="window.location.href = '<?php echo base_url();?>administrador/lista_clientes';return false;">Regresar</button>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>