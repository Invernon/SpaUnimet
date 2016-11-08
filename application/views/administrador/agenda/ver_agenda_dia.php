<section id="main-content">
	
		<article>
			<header>
                <h1> Agenda del dia </h1>
			</header>
			
			<div class="container">
				
			<?php if($agenda != NULL) : ?>
				<?php foreach ($agenda as $agenda_item): 
					$editar = array('administrador','editar_agenda', $agenda_item['id']);
                	//$eliminar = array('administrador','eliminar_servicio', $servicio_item['id']);
                	$ver = array('administrador','ver_agenda', $agenda_item['id']);
                ?>

        		
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa2"  >
       					<div class="col col-sm-10 col_nombre" >
       						
       						<div class="row caja_nombre">
       						
       							
       						
                				<?php echo 'Fecha: '.$agenda_item['fecha']  ?>
       							</br>
                				<?php echo 'Especialista: '.$agenda_item['nombre'].' '.$agenda_item['apellido']  ?>
       							
       							
   
       						

       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $agenda_item['hora_inicio'].' | '.$agenda_item['hora_finalizacion'] ?> </p> </div> 
                			</div>
                				
                		<div class="col col-sm-2 col_botones" >
                				<div class="row" >
	                				<div class="col-md-6" id="boton_lista">
	                			       	<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($editar);?>'">Editar</button>
	                				</div>
	                				<div class="col-md-6" id="boton_lista">
	                					<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($ver);?>'">Ver</button>
	                				</div>
	                				<!-- <div class="col-xs-3" id="boton_lista">
	                					<button type="button" class="btn btn-danger  " onclick="window.location='<?php //echo site_url($eliminar);?>'">Eliminar</button>
	                				</div> -->
                				</div>
                		</div>
       				</div>
        		</div>		

				<?php 
				endforeach; ?>
			<?php endif; ?>

			</div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>