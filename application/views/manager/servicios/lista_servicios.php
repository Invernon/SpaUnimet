<section id="main-content">
	
		<article>
			<header>
                <h1> Lista de Servicios </h1>
			</header>
			
			<div class="container">
				<?php foreach ($servicio as $servicio_item):
					$editar = array('manager','editar_servicio', $servicio_item['id']);
                	$ver = array('manager','ver_servicio', $servicio_item['id']);
				?>

        		
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-10 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <p> <?php echo $servicio_item['descripcion']; ?>  
                					  
      						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $servicio_item['tipo'].' | '.$servicio_item['duracion'].' Minutos' ?> </p> </div> 
                		</div>
                				
                		<div class="col col-sm-2 col_botones" >
                				<div class="row" >
	                				<div class="col-xs-6" id="boton_lista">
	                					<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($ver);?>'">Ver</button>
	                				</div>
	                				
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