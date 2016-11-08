<section id="main-content">
	
		<article>
			<header>
                <h1> Nueva Sesion </h1>
			</header>
			
	<div class="content">
				
		<div class="formulario"> 
				
			<?php echo form_open("/manager/recibir_nueva_sesion") ?>
		
		<?php
				
				
				$checkin = array(
    			'name'        => 'checkin',
				'id'          => 'Checkin',
    			'value'       => 'TRUE',
				'checked'     =>  TRUE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			);
				
				
				
				$pagada = array(
    			'name'        => 'pagada',
				'id'          => 'Pagada',
    			'value'       => 'TRUE',
				'checked'     =>  TRUE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			);
				
				
				//metodo para agregar al dropdown el nombre de los servicios disponibles
				$Push = array();
				$Push_Cliente = array();
				$Push_Especialista = array();
				
				foreach($servicio as $servicio_item){
				
				$idservicio =  $servicio_item['descripcion'];
				$Push[] = $idservicio;
				}
				
				//Asigna lista de Servicios. 
				$idservicio = $Push;
				//-----------------------------fin de dropdown------------------------------------
				
				foreach($cliente as $cliente_item){
				
				$nombre = $cliente_item['nombre'];
				$apellido = $cliente_item['apellido'];
				$nombre_completo = ($nombre.' '.$apellido);	//Esto va en Parentesis para que se pase como un array y no como un Vector Enumerado
				
				$idcliente = $nombre_completo;
				$Push_Cliente[] = $nombre_completo;
				}
				
				//Asigna lista de Clientes. 
				$idcliente = $Push_Cliente;
				//------------------------------------------------------------------------
				
				foreach($especialista as $especialista_item){
					
				$nombre_e = $especialista_item['nombre'];
				$apellido_e = $especialista_item['apellido'];	
				$nombre_completo_e = ($nombre_e.' '.$apellido_e);
				
				$Push_Especialsta[] = $nombre_completo_e;
				}
				
				//Asigna lista de Especialista.
				$idusuario = $Push_Especialsta;
				//------------------------------------------------------------------------
				

				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
					)
				
		?>
               
               
            <!--   
               	<div class="row " >
	           		<div class="col col-xs-8 ">
               			<label> Check-In </label>
	           		</div>
               
               		<div class="col col-xs-4">
               			<?//php echo form_checkbox($checkin);?>
        	 		</div>
       			</div>
       		-->	
       		
       			
               <label> Cliente </label>
               <div class="field"> 
               	<?php echo form_dropdown('idcliente',$idcliente) ?>
               </div>
               
               <label> Especialista	</label>
               <div class="field"> 
               	<?php echo form_dropdown('idusuario',$idusuario) ?>
               </div>
               
               <label> Servicio	</label>
               <div class="field"> 
               	<?php echo form_dropdown('idservicio',$idservicio) ?>
               </div>
               
               <div class="row " >
	
               		<div class="col col-xs-8 ">
               			<label> Pagada </label>
	           		</div>
               
               		<div class="col col-xs-4">
               			<?php echo form_checkbox($pagada);?>
        	 		</div>
       			</div>
               
               <!-- <label> id de la agenda	</label>
               <div class="field"> 
               	<?//php echo form_input($idagenda) ?>
               </div>
               -->
             
               </br>
               
               <?= form_submit($enviar) ?>
               
               <?= form_close() ?>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>