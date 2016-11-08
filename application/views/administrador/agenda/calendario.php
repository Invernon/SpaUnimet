	<section id="main-content">
	
		<article>
			<header>
                <h1> Agendas </h1>
			</header>
			
			<div class="content">
			    
			<?php
			    
			   $data = array();
			   
					$fecha= array (
						09 => '' ,
						11 => '');
					print_r ($dias); 
			        echo $this->calendar->generate($year,$month,$dias);
			    ?>
               
	        </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

    </body>

</html>