<section id="main-content">
	
		<article>
			<header>
                <div class="row">
                	<h1> Lista de usuarios <button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("administrador/nuevo_usuario");?>'"> 
				Nuevo </button> </h1>
                </div>
                
                
			</header>
			
			<div class="container">
				
			<div class="row caja_buscar" >
					
				
						
				<?php echo form_open("/administrador/busqueda_nombre") ?>
				<?php
				
				$nombre = array ('name' => 'nombre','class' => 'cuadro_buscar','placeholder' => 'Buscar');
				
				$perfil = array ('nombre'=> 'Nombre','apellido'=> 'Apellido','user'=> 'Usuario');
				
				$enviar = array ('class' => 'btn btn-info ','value' => 'Buscar' ,'style' => 'width:97%', 
					)
				
			?>
               <div class="col col-xs-6 ">
               		<?php echo form_input($nombre) ?>
	           </div>
               
               <div class="col col-xs-3">
               		<?php echo form_dropdown('perfil',$perfil,'Nombre',"class='cuadro_eleccion'") ?>
               </div>
               
               <div class="col col-xs-3">
               		<?= form_submit($enviar) ?>
               		<?= form_close() ?>
               </div>
	           
	    	</div>

                
                <?php foreach ($usuario as $usuario_item): ?>
				
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-6 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo $usuario_item['nombre'].' '.$usuario_item['apellido']; 
                					  $editar = array('administrador','editar_usuario', $usuario_item['id']);
                					  $eliminar = array('administrador','eliminar_usuario', $usuario_item['id']);
                					  $ver = array('administrador','ver_usuario', $usuario_item['id']);
                				?> 
       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $usuario_item['perfil'] ?> </p> </div> 
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
			

			</div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>