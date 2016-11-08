<section id="main-content">
	
		<article>
			<header>
                <h1> Editar Servicios </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
				
		<?php echo form_open("/manager/actualizar_servicio/".$id) ?>
		
		<?php
		
				$descripcion = array (
				'name' => 'descripcion',
				'class' => 'formulario_caja',
				'placeholder' => 'Ej. Baño de chocolate',
				'value' => $servicio->result()[0]->descripcion
				);
				
				$duracion = array (
				'name' => 'duracion',
				'class' => 'formulario_caja',
				'placeholder' => '60',
				'type' => 'number',
				'min' => '0',
				'step' => '15',
				'value' => $servicio->result()[0]->duracion
				);
				
				$precio = array (
				'name' => 'precio',
				'class' => 'formulario_caja',
				'placeholder' => 'Ej. 1500',
				'type' => '1500',
				'value' => $servicio->result()[0]->precio
				);
				
				$tipo = array (
				'masajes' => 'Masajes',
				'piedras' => 'Piedras',
				'terapias' => 'Terapias',
				'pedicure' => 'Pedicure',
				'manicure' => 'Manicure'
				);
				

				$activo = array(
    				'name'        => 'activo',
					'id'          => 'Activo',
					'value' => $servicio->result()[0]->activo,
					'checked'     =>  TRUE,
    				'style'       => 'width:97%',
    				'class' => 'cuadro_eleccion'
    			);
				
				
				$equipo = array(
    				'name'        => 'equipo',
					'id'          => 'Equipo',
					'value' => $servicio->result()[0]->equipo,
					'checked'     =>  TRUE,
    				'style'       => 'width:97%',
    				'class' => 'cuadro_eleccion'
    			);
				
				
				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
				);
				
		?>
		
	           <label> Descripcion </label>
               <div class="field"> 
               	<?php echo form_input($descripcion) ?>
               </div>
               
               <label> Duracion (Minutos) </label>
               <div class="field"> 
               	<?php echo form_input($duracion) ?>
               </div>
               
               <label> Precio (Bs) </label>
               <div class="field"> 
               	<?php echo form_input($precio) ?>
               </div>
               
               <label> Tipo	</label>
               <div class="field"> 
               	<?php echo form_dropdown('tipo',$tipo,$servicio->result()[0]->tipo) ?>
               </div>
               
        <div class="row " >
	
               	<div class="col col-xs-8 ">
               		<label> Activo </label>
	           	</div>
               
               	<div class="col col-xs-4">
               		<?php echo form_checkbox($activo);?>
        	 	</div>
        </div>
               
        <div class="row" >
	
               <div class="col col-xs-8 ">
               		<label> ¿Usa Equipo? </label>
	           </div>
               
               <div class="col col-xs-4">
               		<?php echo form_checkbox($equipo);?>
        		</div>
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