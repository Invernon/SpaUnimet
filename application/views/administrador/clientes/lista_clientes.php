<section id="main-content">
	
		<article>
			<header>
			<div class="row ">
				<h1> Lista de Clientes  <button type="button" class="btn btn-default" onclick="window.location='<?php echo site_url("administrador/nuevo_cliente");?>'"> 
				Nuevo </button> 
				</h1>                        

            </div>
                
                
			</header>
			
			<div class="container">
				
			<div class="row caja_buscar" >
	
				<?php echo form_open("/administrador/busqueda_cliente") ?>
				<?php
				
				$nombre = array ('name' => 'nombre','class' => 'cuadro_buscar','placeholder' => 'Buscar');
				
				$busqueda = array ('nombre'=> 'Nombre','apellido'=> 'Apellido','cedula'=> 'Cedula' ,'correo'=>'Correo');
				
				$enviar = array ('class' => 'btn btn-info ','value' => 'Buscar' ,'style' => 'width:97%', 
					)
				
			?>
               <div class="col col-xs-6 ">
               		<?php echo form_input($nombre) ?>
	           </div>
               
               <div class="col col-xs-3">
               		<?php echo form_dropdown('perfil',$busqueda,'Nombre',"class='cuadro_eleccion'") ?>
               </div>
               
               <div class="col col-xs-3">
               		<?= form_submit($enviar) ?>
               		<?= form_close() ?>
               </div>
	           
	    	</div>
			
			<div class="container">
				<?php foreach ($cliente as $cliente_item): ?>

        		
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-6 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo $cliente_item['nombre'].' '.$cliente_item['apellido']; 
                					  $editar = array('administrador','editar_cliente', $cliente_item['id']);
                					  $eliminar = array('administrador','eliminar_cliente', $cliente_item['id']);
                					  $ver = array('administrador','ver_cliente', $cliente_item['id']);
                				?> 
       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> CI: <?php echo $cliente_item['cedula'] ?> </p> </div> 
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