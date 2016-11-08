<section id="main-content">
	
		<article>
			<header>
                <h1> Nuevo Usuario </h1>
			</header>
			
			<div class="content">
				
		<div class="formulario"> 
				
		<?php echo form_open("/administrador/recibir_nuevo_usuario") ?>
		
		<?php
				
				
				$nombre = array (
				'name' => 'nombre',
				'class' => 'formulario_caja',
				'placeholder' => 'Juan'
				);
				
				$apellido = array (
				'name' => 'apellido',
				'class' => 'formulario_caja',
				'placeholder' => 'Gaviota',
				'value'=> ''
				);
				
				$telefono = array (
				'name' => 'telefono',
				'class' => 'formulario_caja',
				'placeholder' => '04145559555',
				'type' => 'tel'
				);
				
				$user = array (
				'name' => 'user',
				'class' => 'formulario_caja',
				'placeholder' => 'Administrador1'
				);
				
				$password = array (
				'name' => 'password',
				'class' => 'formulario_caja',
				'type' => 'password'
				);
				
				$password2 = array (
				'name' => 'password2',
				'class' => 'formulario_caja',
				'type' => 'password'
				);
				
				$correo = array (
				'name' => 'correo',
				'class' => 'formulario_caja',
				'placeholder' => 'abc@gmail.com',
				'type' => 'email'
				);
				
				$perfil = array (
				'admin' 	=> 'Administrador',
				'manager'	=> 'Manager',
				'user'		=> 'Especialista'
				);
				
				$enviar = array (
					'class' => 'btn btn-info ',
					'value' => 'Enviar' ,
					'style' => 'margin-bottom:10px; width:97%'
					)
				
		?>
               
               <label> Nombre </label>
               <div class="field"> 
               	<?php echo form_input($nombre) ?>
               </div>
               
               <label> Apellido </label>
               <div class="field"> 
               	<?php echo form_input($apellido) ?>
               </div>
               
               <label> Nombre de usuario </label>
               <div class="field"> 
               	<?php echo form_input($user) ?>
               </div>
               
               <label> Contraseña	</label>
               <div class="field"> 
               	<?php echo form_input($password) ?>
               </div>
               
               <label> Confirmacion de Contraseña	</label>
               <div class="field"> 
               	<?php echo form_input($password2) ?>
               </div>
               
               <label> Teléfono	</label>
               <div class="field"> 
               	<?php echo form_input($telefono) ?>
               </div>
               
               <label> Correo </label>
               <div class="field"> 
               	<?php echo form_input($correo) ?>
               </div>
               
               <label> Tipo de usuario </label>
               <div class="field"> 
               	<?php echo form_dropdown('perfil',$perfil,'administrador') ?>
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