<section id="main-content">
	
		<article>
			<header>
                <h1> Ver Cliente </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
		
	           <label> Descripcion </label>
               <div class="field field_ver"> 
               	<?php echo $servicio->result()[0]->descripcion ?>
               </div>
               
               <label> Duracion </label>
               <div class="field field_ver"> 
               	<?php echo $servicio->result()[0]->duracion.' Minutos' ?>
               </div>
               
               <label> Precio </label>
               <div class="field field_ver"> 
               	<?php echo $servicio->result()[0]->precio.' Bs.' ?>
               </div>
               
               <label> Tipo	</label>
               <div class="field field_ver"> 
               	<?php echo $servicio->result()[0]->tipo ?>
               </div>
               
           		<label> Estado </label>
				<div class="field field_ver"> 
               		<?php echo $servicio->result()[0]->activo ?>
               	</div>
               
               	<label> Uso de equipo </label>
				<div class="field field_ver"> 
               		<?php echo $servicio->result()[0]->equipo?>
               	</div>

                </br>
               
               <button class="btn btn-info" style="margin-bottom:10px; width:97%;" onClick="window.location.href = '<?php echo base_url();?>administrador/lista_servicios';return false;">Regresar</button>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>