<section id="main-content">
	
		<article>
			<header>
                <h1> Ver Sesion </h1>
			</header>
			
			<div class="content">
				
				<?php

				$nombre_u = $usuario->result()[0]->nombre;
				$apellido_u = $usuario->result()[0]->apellido;
				$nombre_completo_u = ($nombre_u.' '.$apellido_u);
	
				$nombre_c = $cliente->result()[0]->nombre;
				$apellido_c = $cliente->result()[0]->apellido;
				$nombre_completo_c = ($nombre_c.' '.$apellido_c);
				
				?>
				
		<div class="formulario"> 
		
	           <label> Cliente </label>
               <div class="field field_ver"> 
               	<?php echo $nombre_completo_c ?>
               </div>
               
               <label> Especialista </label>
               <div class="field field_ver"> 
               	<?php echo $nombre_completo_u ?>
               </div>
               
               <label> Precio </label>
               <div class="field field_ver"> 
               	<?php echo $servicio->result()[0]->precio.' Bs.' ?>
               </div>
               
               <label> Servicio	</label>
               <div class="field field_ver"> 
               	<?php echo $servicio->result()[0]->descripcion ?>
               </div>
               
           		<label> Estado </label>
				<div class="field field_ver"> 
               		<?php echo $sesion->result()[0]->ejecutada ?>
               	</div>
               
               	<label> Check-In? </label>
				<div class="field field_ver"> 
               		<?php echo $sesion->result()[0]->checkin ?>
               	</div>
               	
               	<label> Pago </label>
				<div class="field field_ver"> 
               		<?php echo $sesion->result()[0]->pagada ?>
               	</div>

                </br>
               
               <button class="btn btn-info" style="margin-bottom:10px; width:97%;" onClick="window.location.href = '<?php echo base_url();?>manager/lista_sesiones';return false;">Regresar</button>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>