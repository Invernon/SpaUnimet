<section id="main-content">
	
		<article>
			<header>
                <div class="row">
                	<h1> Sesiones retrasadas </h1>
                </div>
                
                
			</header>
			
			<div class="container">
				
			<div class="row caja_buscar1" >
					
				
               <div class="col col-xs-3 ">
      				<button type="button" class="btn btn-info  " onclick="window.location='<?php echo site_url("administrador/sesiones_ejecutadas/");?>'">Ejecutadas sin Pagar </button>
	           </div>
               
               <div class="col col-xs-2">
               		<button type="button" class="btn btn-info  disabled" onclick="window.location='<?php echo site_url();?>'">Retrasadas</button>
               </div>
               
               <div class="col col-xs-2">
	         		<button type="button" class="btn btn-info  " onclick="window.location='<?php echo site_url("administrador/sesiones_sinagenda/");?>'">Sin agendar</button>
               </div>
               
               <div class="col col-xs-3">
	         		<button type="button" class="btn btn-info  " onclick="window.location='<?php echo site_url("administrador/sesiones_ejecutadaspagadas/");?>'">Ejecutadas y Pagadas</button>
               </div>
	           
	    	</div>

                <?php if($sesion != NULL) : ?>
                
                	
   					 <?php foreach ($sesion as $sesion_item): 
				   			
   					 
   					 ?>
					
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-6 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo $sesion_item['nombre'].' '.$sesion_item['apellido']; 
                					  $editar = array('administrador','editar_sesion', $sesion_item['id']);
                					  $eliminar = array('administrador','eliminar_sesion', $sesion_item['id']);
                					  $ver = array('administrador','ver_sesion', $sesion_item['id']);
                				?> 
       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $sesion_item['descripcion'] ?> </p> </div> 
                		</div>
                				
                		<div class="col col-sm-6 col_botones" >
                				<div class="row" >
	                				<div class="col-xs-3" id="boton_lista">				
	                					<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($editar);?>'">Editar</button>
	                   				</div>
	                				<div class="col-xs-5" id="boton_lista">
	                					<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($ver);?>'">Ver</button>
	                				</div>
	                				<div class="col-xs-3" id="boton_lista">
	                					<button type="button" class="btn btn-danger  " onclick="window.location='<?php echo site_url($eliminar);?>'">Eliminar</button>
	                				</div>
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