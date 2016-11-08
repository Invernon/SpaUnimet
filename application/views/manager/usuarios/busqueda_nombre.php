<section id="main-content">
	
		<article>
			<header>
                <div class="row">
                	<h1> Busqueda Usuarios </h1>
                </div>
			</header>
			
			<div class="container">
				
			<?php foreach ($usuario as $usuario_item): ?>
				
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-10 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo $usuario_item['nombre'].' '.$usuario_item['apellido']; 
                					  $editar = array('manager','editar_usuario', $usuario_item['id']);
                					  $eliminar = array('manager','eliminar_usuario', $usuario_item['id']);
                					  $ver = array('manager','ver_usuario', $usuario_item['id']);
                				?> 
       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $usuario_item['perfil'] ?> </p> </div> 
                		</div>
                				
                		<div class="col col-sm-2 col_botones" >
                				<div class="row" >
	                				
	                				<div class="col" id="boton_lista">
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