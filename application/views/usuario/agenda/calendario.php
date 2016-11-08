	<section id="main-content">
	
		<article>
			<header>
                <h1> Agendas </h1>
			</header>
			
			<div class="content">
			    
			    
			    
			    <?php
			        echo $this->calendar->generate($year,$month,$dias);
			    ?>
               
	        </div>
			
		</article> <!-- /article -->
	
	</section> <!-- / #main-content -->

    </body>

    </body>

</html>