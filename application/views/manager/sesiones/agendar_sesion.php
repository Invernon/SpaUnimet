<section id="main-content">
	
		<article>
			<header>
                <div class="row">
                	<h1> Lista de Sesiones </h1>
                </div>
                
                
			</header>
			
			<div class="container">
				
			<div class="row caja_buscar" >
					
				
						
				<?php echo form_open("/manager/busqueda_nombre") ?>
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

                
                <?php foreach ($sesion as $sesion_item): ?>
				
        		<div class="lista_usuarios"> 
        			
       				<div class="row caja_completa"  >
       					<div class="col col-sm-6 col_nombre" >
       						
       						<div class="row caja_nombre">
       							 <?php echo $sesion_item['id'].' '.$sesion_item['id_agenda']; 
                					  $ver = array('manager','ver_sesion', $sesion_item['id']);
                				?> 
       						</div>
                			
                			<div class="row caja_perfil"> <p style='font-size:12px;'> <?php echo $sesion_item['id'] ?> </p> </div> 
                		</div>
                				
                		<div class="col col-sm-6 col_botones" >
                				<div class="row" >
	                				<div class="col-xs-5" id="boton_lista">
	                					<button type="button" class="btn btn-default  " onclick="window.location='<?php echo site_url($ver);?>'">Agendar</button>
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