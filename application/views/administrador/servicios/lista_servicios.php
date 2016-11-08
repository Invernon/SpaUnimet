<section id="main-content">
	
		<article>
			<header>
                <h1> Lista de servicios <button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("administrador/nuevo_servicio");?>'"> 
				Nuevo </button></h1>
			</header>
			
			<div class="container">
				<?php foreach ($servicio as $servicio_item): 
					$editar = array('administrador','editar_servicio', $servicio_item['id']);
                	//$eliminar = array('administrador','eliminar_servicio', $servicio_item['id']);
                	$ver = array('administrador','ver_servicio', $servicio_item['id']);
                ?>

        		
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-8 col_nombre" >
       						
       						<div class="row caja_nombre">
       							<p> <?php echo $servicio_item['descripcion']; ?>  
   
       							</p> 

       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $servicio_item['tipo'].' | '.$servicio_item['duracion'].' Minutos' ?> </p> </div> 
                			</div>
                				
                		<div class="col col-sm-4 col_botones" >
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
			

			</div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>