<section id="main-content">
	
		<article>
			<header>
                <h1> Editar agenda </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
				
		<?php echo form_open("/manager/actualizar_agenda/".$id) ?>
		
		<?php
		
				$fecha = array (
				'name' => 'fecha',
				'class' => 'formulario_caja',
				'placeholder' => '2016-11-29',
				'value' => $agenda->result()[0]->fecha,
				'style'=> 'color:blue'
				);
				
				$hora_inicio = array (
				'name' => 'hora_inicio',
				'class' => 'formulario_caja',
				'placeholder' => '4:20',
				'value' => $agenda->result()[0]->hora_inicio,
				'style'=> 'color:blue'
				);
				

				$hora_finalizacion = array (
				'name' => 'hora_finalizacion',
				'class' => 'formulario_caja',
				'placeholder' => '4:20',
				'value' => $agenda->result()[0]->hora_finalizacion,
				'style'=> 'color:blue'
				);
				
				$nombre_completo = $agenda->result()[0]->nombre.' '.$agenda->result()[0]->apellido;
				
				$id_usuario = array (
				'name' => 'id_usuario',
				'class' => 'formulario_caja',
				'placeholder' => '1',
				'value' => $nombre_completo,
				'style'=> 'color:blue'
				);
				
				
				
				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
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
               
               <label> Especialista a ejecutar sesión </label>
               <div class="field"> 
               	<?php echo form_input($id_usuario) ?>
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