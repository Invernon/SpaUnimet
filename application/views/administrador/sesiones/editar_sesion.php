<section id="main-content">
	
		<article>
			<header>
                <h1> Editar Sesion </h1> 
			</header>
			
			<div class="content">
			
		<div class="formulario"> 
				
		<?php echo form_open("/administrador/actualizar_sesion/".$id) ?>
		
		<?php
		
			$nombre_u = $usuario->result()[0]->nombre;
			$apellido_u = $usuario->result()[0]->apellido;
			$nombre_completo_u = ($nombre_u.' '.$apellido_u);
	
			$nombre_c = $cliente->result()[0]->nombre;
			$apellido_c = $cliente->result()[0]->apellido;
			$nombre_completo_c = ($nombre_c.' '.$apellido_c);
			
			if ( ($sesion->result()[0]->checkin) == 't'){
					
			
					
				$checkin = array(
    			'name'        => 'checkin',
				'id'          => 'Checkin',
    			'value'       =>  $sesion->result()[0]->checkin,
    			'checked'	   => TRUE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			);
    			
    			
			}else{
				
				$checkin = array(
    			'name'        => 'checkin',
				'id'          => 'Checkin',
    			'value'       =>  $sesion->result()[0]->checkin,
    			'checked'	   => FALSE,
				'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			);

			}
			
			if ( ($sesion->result()[0]->pagada) == 't'){
					
				$pagada = array(
    			'name'        => 'pagada',
				'id'          => 'Pagada',
    			'value'       =>  $sesion->result()[0]->pagada,
    			'checked'	   => TRUE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			);
    		
			}else{
				
				$pagada = array(
    			'name'        => 'pagada',
				'id'          => 'Pagada',
    			'value'       =>  $sesion->result()[0]->pagada,
    			'checked'	   => FALSE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			
    			);
			}
			
				$idcliente = array (
				'name' => 'idcliente',
				'class' => 'formulario_caja',
				'placeholder' => 'Ex. 14',
				'value' => $sesion->result()[0]->id_cliente,
				'type' => 'tel',
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				

				$idusuario = array (
				'name' => 'idusuario',
				'class' => 'formulario_caja',
				'type' => 'number',
				'value' => $sesion->result()[0]->id_usuario,
				'min' => '1',
				'max' => '50000000',
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				
				$idagenda = array (
				'name' => 'idagenda',
				'class' => 'formulario_caja',
				'type' => 'number',
				'value' => $sesion->result()[0]->id_agenda,
				'min' => '1',
				'max' => '50000000',
				'style'=> 'color:blue',
				'readonly' => 'readonly'
				);
				
				
			if ( (($sesion->result()[0]->checkin) == 't') && ( ($sesion->result()[0]->ejecutada == 'f') || ($sesion->result()[0]->ejecutada == NULL) ) )  {	
				
				$ejecutada = array(
    			'name'        => 'ejecutada',
				'id'          => 'Ejecutada',
				'value'       =>  $sesion->result()[0]->ejecutada,
    			'checked'	   => FALSE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion'
    			);
    			
			} else{
				
				$ejecutada = array(
    			'name'        => 'ejecutada',
				'id'          => 'Ejecutada',
    			'checked'	   => FALSE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion',
    			'disabled' => 'disabled'
    			);
			}
			
		if ( (($sesion->result()[0]->checkin) == 't') && ( ($sesion->result()[0]->ejecutada == 't') ) )  {	
			
				$ejecutada = array(
    			'name'        => 'ejecutada',
				'id'          => 'Ejecutada',
				'value'       =>  $sesion->result()[0]->ejecutada,
    			'checked'	   => TRUE,
    			'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion',
    			'disabled' => 'disabled'
    			);
    			
    			$checkin = array(
    			'name'        => 'checkin',
				'id'          => 'Checkin',
    			'value'       =>  $sesion->result()[0]->checkin,
    			'checked'	   => TRUE,
				'style'       => 'width:97%',
    			'class' => 'cuadro_eleccion',
    			'disabled' => 'disabled'
    			);
		}
		
				if( $sesion->result()[0]->id_agenda == NULL )
				{	
					//metodo para agregar al dropdown el nombre de los servicios disponibles
						$Push = array();
		
						foreach($servicio as $servicio_item){
						
						$idservicio =  $servicio_item['descripcion'];
						$Push[] = $idservicio;
						}
						
					//Asigna lista de Servicios. 
						$idservicio = $Push;
						$disable = ' ';
					// SI EL ID_AGENDA ES NULL ES PORQUE NO ESTA AGENDADO Y POR LO TANTO NO SE PUEDE 
					// VERIFICAR EL CHECK-IN. = HIDDEN
						
						$checkin = array(
		    			'name'        => 'checkin',
						'id'          => 'Checkin',
		    			'value'       =>  $sesion->result()[0]->checkin,
		    			'checked'	   => FALSE,
		    			'style'       => 'width:97%',
		    			'disabled' => 'disabled',
		    			'class' => 'cuadro_eleccion',
		    			'hidden' => 'hidden' 
		    			);		
		    			
		    			$ejecutada = array(
		    			'name'        => 'ejecutada',
						'id'          => 'Ejecutada',
						'value'       =>  $sesion->result()[0]->ejecutada,
		    			'checked'	   => FALSE,
		    			'style'       => 'width:97%',
		    			'class' => 'cuadro_eleccion',
		    			'disabled' => 'disabled',
		    			'hidden' => 'hidden'
		    			);
		    			
		    			$agendada = 'SIN AGENDAR';
		    			
				}else {
					
					$idservicio = array (
					);
					$disable = 'Disable => Disable';
					$agendada = 'AGENDADA';
					
				}
		
		//______________________________________________
		

				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
					);
				
		?>
		
	            <h3 style="text-align:center;" > <?php echo $agendada ?>	</h3>
	            
       			<div class="row " >
	
               		<div class="col col-xs-8 ">
               			<label> Pagada </label>
	           		</div>
               
               		<div class="col col-xs-4">
               			<?php echo form_checkbox($pagada);?>
        	 		</div>
       			</div>
               

               <label> Cliente </label>
               <div class="field "> 
               	<?php echo $nombre_completo_c ?>
               </div>
               
               <label> Especialista </label>
               <div class="field "> 
               	<?php echo $nombre_completo_u ?>
               </div>
               
               <label> Servicio	</label>
               <div class="field"> 
               	<?php
               	echo form_dropdown('idservicio',$idservicio,$disable)
               	?>
               </div>
               
              <div class="row " >
	
               		<div class="col col-xs-8 ">
               			<label> Check-In </label>
	           		</div>
               
               		<div class="col col-xs-4">
               			<?php echo form_checkbox($checkin);?>
        	 		</div>
       			</div>

               <div class="row " >
	
               		<div class="col col-xs-8 ">
               			<label> Ejecutada </label>
	           		</div>
               
               		<div class="col col-xs-4">
               			<?php echo form_checkbox($ejecutada);?>
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