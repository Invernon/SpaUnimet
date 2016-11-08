<section id="main-content">
	
		<article>
			<header>
                <div class="row">
                	<h1> Agendar Sesion </h1>
                </div>
                
                
			</header>
			
			<div class="container">
				
                <?php foreach ($sesion as $sesion_item): ?>
				
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa2"  >
       					<div class="col col-sm-10 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo 'Especialista: '.$sesion_item['nombre'].' '.$sesion_item['apellido']; 
                					  $agendado = array('administrador','agendado', $sesion_item['id']);
                				?> </br>
                				<?php echo 'Cliente: '.$sesion_item['nombre_cliente'].' '.$sesion_item['apellido_cliente']  ?>
       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $sesion_item['descripcion'] ?> </p> </div> 
                		</div>
                				
                		<div class="col col-sm-2 col_botones" >
                				<div class="row" >
	                				<div class="col-xs-5" id="boton_lista">
	                					<button type="button" class="btn btn-success  " onclick="window.location='<?php echo site_url($agendado);?>'">Agendar</button>
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