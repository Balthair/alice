<div id="slide">
	<ul data-orbit data-options="variable_height:true;bullets:false;timer_speed:4000;resume_on_mouseout: true;slide_number: false;">
		<?php foreach ($lastArticles as $lA): ?>
		  	<li>		
		    	<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$lA['Article']['id'].'-'.$lA['Article']['permalink'])); ?>">
		    		<div class="image">
		    			<?php
						$widthLarge = 0;
						foreach ($lA['Image'] as $I) {
							$src = $I['seccion'].'/'.$I['id'].'.'.$I['extension'];
							$this->Image->imagen(Configure::read('absolute_root').$src);
							$widthImg = $this->Image->image_width;
							if ($widthImg > $widthLarge) {
								$srcSmall = @$srcLarge;
								$srcLarge = $src;
								$widthLarge = $widthImg;
							} else {
								$srcSmall = $src;
							}
						}
		    			?>
		    			<img src="<?php echo $this->Html->url('/files/'.$srcLarge); ?>" data-interchange="[<?php echo $this->Html->url('/files/'.$srcSmall); ?>, (only screen and (min-width: 1px))], [<?php echo $this->Html->url('/files/'.$srcLarge); ?>, (only screen and (min-width: 769px))]">
		    		</div>
	    		<div class="edition-title">
	    			<h2><?php echo $lA['Article']['titulo']; ?></h2>
	    		</div>
	    	</a>
	  	</li>
		<?php endforeach ?>
	</ul>
</div>

<div id="container-body">
	
	<?php if (!empty($pubArtH['Image'])): ?>

		<div class="pub-horizontal">
			<?php echo $this->Html->image(
	    		'/files/'.$pubArtH['Image']['seccion'].'/'.$pubArtH['Image']['id'].'.'.$pubArtH['Image']['extension'],
	    		array(
	    			'alt' => $pubArtH['Ad']['nombre'],
	    			'url' => $pubArtH['Ad']['link']
	    		)
	    	); ?>
		</div>
		
	<?php endif ?>

	<div class="article-title">
		<span>Articulos</span>
	</div>
	<div class="articles">
		<script type="text/javascript">
		    $(document).ready(function ($) {
		        $('.arts').perfectScrollbar({
		          	wheelSpeed: 20,
		          	wheelPropagation: false
		        });
		    });
	    </script>
		<div class="arts">
			<?php foreach ($lastArticles as $lA): ?>
				<div class="art">
					<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$lA['Article']['id'].'-'.$lA['Article']['permalink'])); ?>">
						<div class="image">
							<?php
							$widthSmall = 1280;
							foreach ($lA['Image'] as $I) {
								$src = $I['id'].'.'.$I['extension'];
								$this->Image->imagen(Configure::read('absolute_root').$I['seccion'].'/'.$src);
								$widthImg = $this->Image->image_width;
								if ($widthImg < $widthSmall) {
									$srcSmall = $src;
									$widthSmall = $widthImg;
								}
							}
			    			?>
							<?php echo $this->Html->image(
					    		'/files/'.$I['seccion'].'/'.'thumbs/'.$srcSmall
					    	); ?>
						</div>
						<div class="content">
							<h2><?php echo $lA['Article']['titulo']; ?></h2>
							<span class="editor"><?php echo $lA['Editor']['nombre']; ?></span>
							<div class="text">
								<?php echo $this->Text->truncate($lA['Article']['intro'], 200); ?>
							</div>
						</div>
					</a>
					<div class="clear"></div>
				</div>
			<?php endforeach ?>
		</div>
		<div class="pub">
			<?php if (!empty($pubArtV)): ?>
				<?php foreach ($pubArtV as $pAV): ?>
					
				<div class="image">
					<?php echo $this->Html->image(
			    		'/files/'.$pAV['Image']['seccion'].'/'.$pAV['Image']['id'].'.'.$pAV['Image']['extension'],
			    		array(
			    			'alt' => $pAV['Ad']['nombre'],
			    			'url' => $pAV['Ad']['link']
			    		)
			    	); ?>
				</div>

				<?php endforeach ?>
			<?php endif ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php if (!empty($pubEdiH['Image'])): ?>

		<div class="pub-horizontal">
			<?php echo $this->Html->image(
	    		'/files/'.$pubEdiH['Image']['seccion'].'/'.$pubEdiH['Image']['id'].'.'.$pubEdiH['Image']['extension'],
	    		array(
	    			'alt' => $pubEdiH['Ad']['nombre'],
	    			'url' => $pubEdiH['Ad']['link']
	    		)
	    	); ?>
		</div>
		
	<?php endif ?>
	<div class="editions row">
		<?php foreach ($lastEditions as $lE): ?>
			<div class="large-4 small-4 columns edition">
				<?php echo $this->Html->image(
		    		'/files/'.$lE['Image']['seccion'].'/'.$lE['Image']['id'].'.'.$lE['Image']['extension'],
		    		array(
		    			'alt' => $lE['Edition']['nombre'],
		    			'url' => array(
		    				'controller' => 'Editions',
		    				'action' => 'view',
		    				'title' => $lE['Edition']['id'].'-'.$lE['Edition']['permalink']
		    			)
		    		)
		    	); ?>
			</div>
		<?php endforeach ?>
	</div>

	<?php if (isset($albumes) and !empty($albumes)): ?>
		
		<div class="article-title">
			<span>Galer&iacute;as</span>
		</div>
		<div class="galeries">
			<div class="gal row">

				<?php foreach ($albumes as $alb): ?>

					<?php if (isset($alb['Image'][0]) and $alb['Image'][0] != ''): ?>
						
						<div class="large-4 small-6 columns">
							<div class="image">
								<?php echo $this->Html->image(
						    		'/files/'.$alb['Image'][0]['seccion'].'/thumbs/'.$alb['Image'][0]['id'].'.'.$alb['Image'][0]['extension']
						    	); ?>
								<div class="text">
									<h4><?php echo $alb['Albume']['nombre']; ?></h4>
									<a href="<?php echo $this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$alb['Albume']['id'].'-'.$alb['Albume']['permalink'])); ?>">Continuar</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>

					<?php endif ?>
					
				<?php endforeach ?>

			</div>

			<?php if (!empty($pubAlbV['Image'])): ?>

				<div class="pub">
					<?php echo $this->Html->image(
			    		'/files/'.$pubAlbV['Image']['seccion'].'/'.$pubAlbV['Image']['id'].'.'.$pubAlbV['Image']['extension'],
			    		array(
			    			'alt' => $pubAlbV['Ad']['nombre'],
			    			'url' => $pubAlbV['Ad']['link']
			    		)
			    	); ?>
					
				</div>
				
			<?php endif ?>
			<div class="clear"></div>
		</div>

	<?php endif ?>

	<?php if (!empty($pubAlbH['Image'])): ?>

		<div class="pub-horizontal">
			<?php echo $this->Html->image(
	    		'/files/'.$pubAlbH['Image']['seccion'].'/'.$pubAlbH['Image']['id'].'.'.$pubAlbH['Image']['extension'],
	    		array(
	    			'alt' => $pubAlbH['Ad']['nombre'],
	    			'url' => $pubAlbH['Ad']['link']
	    		)
	    	); ?>
		</div>
		
	<?php endif ?>

	<div class="pubHome">


		<?php if (!empty($pubHome)): ?>

			<?php foreach ($pubHome as $pH): ?>

				<?php if (!empty($pH['Image'])): ?>

					<div class="pubFixed">
						<?php echo $this->Html->image(
				    		'/files/'.$pH['Image']['seccion'].'/'.$pH['Image']['id'].'.'.$pH['Image']['extension'],
				    		array(
				    			'alt' => $pH['Ad']['nombre'],
				    			'url' => $pH['Ad']['link']
				    		)
				    	); ?>
					</div>
					
				<?php endif ?>
				
			<?php endforeach ?>
			
		<?php endif ?>
		
	</div>

</div>