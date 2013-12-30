<nav class="top-bar">
  	<ul class="title-area">
    	<!-- Title Area -->
    	<li class="name"></li>
    	<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  	</ul>

  	<section class="top-bar-section">
	    <!-- Left Nav Section -->
    	<ul class="left">
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Inicio', 
      				array(
      					'controller' => 'Home'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Editorial', 
      				array(
      					'controller' => 'Articles',
      					'action' => 'viewAll?categoria=editorial'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Mujeres Destacadas', 
      				array(
      					'controller' => 'Articles',
      					'action' => 'viewAll?categoria=mujeres-destacadas'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Cultura', 
      				array(
      					'controller' => 'Articles',
      					'action' => 'viewAll?categoria=cultura'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Relaciones Interpersonales', 
      				array(
      					'controller' => 'Articles',
      					'action' => 'viewAll?categoria=relaciones-interpersonales'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Otros', 
      				array(
      					'controller' => 'Articles',
      					'action' => 'viewAll?categoria=otros'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Foto Reportajes', 
      				array(
      					'controller' => 'Articles',
      					'action' => 'viewAll?categoria=foto-reportajes'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Galerías', 
      				array(
      					'controller' => 'Galery',
      					'action' => 'viewAll'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Videos', 
      				array(
      					'controller' => 'Videos',
      					'action' => 'viewAll'
      				)
      			);
      			?>
      		</li>
      		<li>
      			<?php
      			echo $this->Html->link(
      				'Autores', 
      				array(
      					'controller' => 'Abouts',
						'action' => 'view',
						'title' => 'autores'
      				)
      			);
      			?>
      		</li>
    	</ul>
  	</section>
</nav>
<div class="social">
	<?php 
	echo $this->Html->image(
		'facebook.png',
		array(
			'alt' => 'Facebook Alice Revista',
			'url' => 'https://www.facebook.com/pages/Revista-Alice/170806799626737'
		)
	);
	echo $this->Html->image(
		'twitter.png',
		array(
			'alt' => 'Twitter Alice Revista',
			'url' => 'https://www.twitter.com/'
		)
	); 
	?>
</div>
<div id="logo">
	<?php echo $this->Html->image(
		'logo_alice.png',
		array(
			'alt' => 'Logo Alice Revista',
			'url' => array(
				'controller' => 'Home'
			)	
		)
	); ?>
</div>