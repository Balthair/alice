<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0">
	<meta property="fb:admins" content="1708398893">
	<meta property="fb:app_id" content="595006310565831">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('normalize');
		echo $this->Html->css('foundation');
		echo $this->Html->css('default');
		echo $this->Html->css('perfect-scrollbar');

		echo $this->Html->script('zurb/vendor/custom.modernizr.js');
		echo $this->Html->script('zurb/vendor/jquery.js');
		echo $this->Html->script('zurb/foundation.min.js');
		echo $this->Html->script('jquery.mousewheel.js');
		echo $this->Html->script('perfect-scrollbar.js');
		echo $this->Html->script('jquery.mb.mediaEmbedder.js');
		echo $this->Html->script('common.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=490550194375409";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	<div id="container">
		<div id="header">
			<?php echo $this->element('header'); ?>
		</div>
		<div class="titleTop">
			<div class="row">
				<?php
				/*echo $this->Form->create(
					false,
					array(
						'url' => array(
							'controller' => 'Articles', 
							'action' => 'viewAll'
						),
						'inputDefaults' => array(
							'label' => false,
							'div' => false
						),
						'class' => 'searchForm'
					)
				);
				echo $this->Form->submit('search.png');
				echo $this->Form->input(
					'keyword', 
					array(
						'class' => 'inputSearch',
						'placeholder' => 'Buscar Artículo'
					)
				);
				echo $this->Form->end();*/
				?>
				<form method="GET" action="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'viewAll')); ?>" class="searchForm">
					<?php echo $this->Form->submit('search.png'); ?>
					<input type="text" id="keyword" placeholder="Buscar Art&iacute;culo..." name="keyword" class="inputSearch"/>
				</form>
				<h2><?php echo $title_for_section; ?></h2>
				<div class="clear"></div>
			</div>
		</div>
		<div id="content">

			<?php //echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div class="linea">
		</div>
		<div id="footer" class="row">
			<?php echo $this->element('footer'); ?>
		</div>
		<aside class="logoPiggy" class="row">
			Dise&ntilde;o y Desarrollo
			<?php
			echo $this->Html->image(
				'logoPiggy.png'
			);
			?>
		</aside>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
	<script>
	  	$(document).foundation();
	</script>
</body>
</html>
