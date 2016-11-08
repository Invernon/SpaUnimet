<section id="main-content">
	
		<article>
			<header>
				<div class="row">
                	<h1> Lista de Especialistas <button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("administrador/nuevo_especialista");?>'"> 
				Nuevo </button> </h1>
                </div>
			</header>
			
			<div class="container">
				<?php foreach ($especialista as $usuario_item): ?>

        		
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-8 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo $usuario_item['nombre'].' '.$usuario_item['apellido']; 
                					  $editar = array('administrador','editar_especialista', $usuario_item['id']);
                					  $eliminar = array('administrador','eliminar_especialista', $usuario_item['id']);
                					  $ver = array('administrador','ver_especialista', $usuario_item['id']);
                				?> 
       						</div>
                		
                		</div>
                				
                		<div class="col col-sm-4 col_botones" >
                				<div class="row" >
	                				<div class="col-xs-3" id="boton_lista">
	                			       	<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($editar);?>'">Editar</button>
	                				</div>
	                				<div class="col-xs-5" id="boton_lista">
	                					<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($ver);?>'">Ver</button>
	                				</div>
	                			<!--<div class="col-xs-3" id="boton_lista">
	                					<button type="button" class="btn btn-danger  " onclick="window.location='<?php echo site_url($eliminar);?>'">Eliminar</button>
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