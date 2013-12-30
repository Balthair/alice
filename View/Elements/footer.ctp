<div class="large-3 columns">
	<span class="title-footer">S&iacute;guenos</span>
	<ul class="">
  		<li class="socialF">
  			<?php echo $this->Html->image(
  				'facebook.png',
  				array(
  					'alt' => 'Facebook',
            		'style' => 'width:30px;',
  					'url' => 'https://www.facebook.com/pages/Revista-Alice/170806799626737'
  				)
      		); ?>
  			<?php echo $this->Html->image(
  				'twitter.png',
  				array(
  					'alt' => 'Twitter',
            		'style' => 'width:30px;',
  					'url' => 'http://twitter.com'
  				)
  			); ?>
      	</li>
	</ul>
</div>
<div class="large-3 columns">
	<span class="title-footer">Men&uacute;</span>
	<ul>
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
				'Ediciones Anteriores',
				array(
					'controller' => 'Editions',
					'action' => 'viewAll'
				)
			);
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link(
				'Galerías de Fotos',
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
	</ul>
</div>
<div class="large-3 columns">
	<span class="title-footer">Acerca de Alice</span>
	<ul>
		<li>
			<?php
			echo $this->Html->link(
				'Sobre Nosotros',
				array(
					'controller' => 'Abouts',
					'action' => 'view',
					'title' => 'sobre-nosotros'
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
		<li>
			<?php
			echo $this->Html->link(
				'Términos de Uso',
				array(
					'controller' => 'Abouts',
					'action' => 'view',
					'title' => 'terminos-de-uso'
				)
			);
			?>
		</li>
	</ul>
</div>
<div class="large-3 columns">
	<span class="title-footer">Cont&aacute;ctenos</span>
	<ul>
		<li>
			<span>Bolonia, Hospital SUMEDICO 3 c. al oeste, Managua</span>
		</li>
		<li>
			<span>C&oacute;digo Postal: LV04</span>
		</li>
		<li>
			<span>+(505) 2266 3722</span></br><span>+(505) 2268 3916</span>
		</li>
		<li>
			<span>revista@alice.com.ni</span>
		</li>
	</ul>
</div>
<div class="clear"></div>