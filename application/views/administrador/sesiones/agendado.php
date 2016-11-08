<section id="main-content">
	
		<article>
			<header>
                <h1> Agendado  </h1>
			</header>
			
	<div class="content">
				
		<div class="formulario"> 
				
			<?php echo form_open("/administrador/recibir_nueva_agenda") ?>
		
		<?php
				
				$fecha = array (
				'name' => 'fecha',
				'class' => 'formulario_caja',
				'placeholder' => '2016-11-29'
				
				);
				
				
				$hora_inicio = array (
				'8:00' 	=> '8:00 AM',
				'8:30'	=> '8:30 AM',
				'9:00'		=> '9:00 AM',
				'9:30' 	=> '9:30 AM',
				'10:00'	=> '10:00 AM',
				'10:30'		=> '10:30 AM',
				'11:00' 	=> '11:00 AM',
				'11:30'	=> '11:30 AM',
				'12:00'		=> '12:00 PM',
				);
				
				
				$id_sesion = array (
				'name' => 'id_sesion',
				'class' => 'formulario_caja',
				'placeholder' => '1',
				'value' => $sesion->result()[0]->id,
				'style'=> 'color:blue',
				'hidden' => 'hidden'
				);
			
				

				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
					)
				
		?>
               
               
          
       		
       			
                 <label> Fecha </label>
               <div class="field"> 
               	<?php echo form_input($fecha) ?>
               </div>
               
                 
               <label> Hora inicio </label>
               <div class="field"> 
               	<?php echo form_dropdown('hora_inicio',$hora_inicio,'administrador') ?>
               </div>
               </br>
             
               
               
                <label> </label>
               <div class="field"> 
               	<?php echo form_input($id_sesion) ?>
               </div>
               
               
             
               </br>
               
               <?= form_submit($enviar) ?>
               
               <?= form_close() ?>
	           
	    </div>
	    </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

</html>