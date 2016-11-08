<section id="main-content">
	
		<article>
			<header>
                <h1> Ver agenda </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
				
		
		
		<?php
		

					
		
				$fecha = array (
				'name' => 'fecha',
				'class' => 'formulario_caja',
				'placeholder' => '2016-11-29',
				'value' => $agenda->result()[0]->fecha,
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				
				$hora_inicio = array (
				'name' => 'hora_inicio',
				'class' => 'formulario_caja',
				'placeholder' => '4:20',
				'value' => $agenda->result()[0]->hora_inicio,
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				
				$hora_finalizacion = array (
				'name' => 'hora_finalizacion',
				'class' => 'formulario_caja',
				'placeholder' => '4:20',
				'value' => $agenda->result()[0]->hora_finalizacion,
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				
				$id_usuario = array (
				'name' => 'id_usuario',
				'class' => 'formulario_caja',
				'placeholder' => '1',
				'value' => $agenda->result()[0]->nombre.' '.$agenda->result()[0]->apellido,
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				
			
				
		?>
		
	           <label> Fecha </label>
               <div class="field"> 
               	<?php echo form_input($fecha) ?>
               </div>
               
               <label> Hora inicio </label>
               <div class="field"> 
               	<?php echo form_input($hora_inicio) ?>
               </div>
               
               <label> hora finalizacion </label>
               <div class="field"> 
               	<?php echo form_input($hora_finalizacion) ?>
               </div>
               
               <label> Especialista a ejecutar </label>
               <div class="field"> 
               	<?php echo form_input($id_usuario) ?>
               </div>
               
               


               </br>
               
          
               
               <?= form_close() ?>
	           
	           <button class="btn btn-info" style="margin-bottom:10px; width:97%;" onClick="window.location.href = '<?php echo base_url();?>usuario/calendario';return false;">Regresar</button>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>