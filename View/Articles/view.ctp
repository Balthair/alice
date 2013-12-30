<div id="contentBody" class="row">

	<?php if (isset($article) and !empty($article) and $article != ''): ?>
		
		<section class="articleInto large-9 columns">
			<h1><?php echo $article['Article']['titulo']; ?></h1>
			<div class="share">
				<div class="fb-like" data-href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$article['Article']['id'].'-'.$article['Article']['permalink']),true); ?>" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div>
				<div class="twitter">
					<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
				</div>
			</div>
			<div class="artAuthor">
				<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'viewAll?author='.$article['Editor']['permalink'])); ?>">
					<span>Por: <?php echo $article['Editor']['nombre']; ?></span>
				</a>
			</div>
			<div class="clear"></div>
			<?php if (!empty($article['Image'])): ?>
				
				<div class="imageInto">
					<?php
					$widthLarge = 0;
					foreach ($article['Image'] as $I) {
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
				<?php if (!empty($article['Article']['pie_foto'])): ?>
					<span class="photo"><?php echo $article['Article']['pie_foto']; ?></span>
				<?php endif ?>
			<?php endif ?>
			<div class="intro">
				<?php echo $article['Article']['intro']; ?>
			</div>
			<div class="nameEdit">
				<span><?php echo $article['Edition']['nombre']; ?></span>
			</div>
			<article id="artText" class="artText">
				<?php echo $article['Article']['contenido']; ?>
			</article>
			<div class="fb-comments" data-href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$article['Article']['id'].'-'.$article['Article']['permalink']),true); ?>" data-numposts="5" data-width="935"></div>
		</section>
		<aside class="asideR large-3 columns">
			<div class="otherArt">
				<span class="title">Otros art&iacute;culos de la edici&oacute;n</span>
				<div>
					<?php foreach ($moreOfEdition as $E): ?>
						<a class="other" href="<?php echo ($E['Article']['albume_id']==0)?$this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$E['Article']['id'].'-'.$E['Article']['permalink'])):$this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$E['Albume']['id'].'-'.$E['Albume']['permalink'])); ?>">
							<div class="image">
								<?php
								$widthSmall = 1280;
								foreach ($E['Image'] as $I) {
									$src = $I['id'].'.'.$I['extension'];
									$this->Image->imagen(Configure::read('absolute_root').$I['seccion'].'/'.$src);
									$widthImg = $this->Image->image_width;
									if ($widthImg < $widthSmall) {
										$srcSmall = $src;
										$widthSmall = $widthImg;
									}
								}
				    			echo $this->Html->image(
						    		'/files/'.$I['seccion'].'/'.'thumbs/'.$srcSmall
						    	); ?>
							</div>
							<div class="text">
								<h4><?php echo $E['Article']['titulo']; ?></h4>
							</div>
						</a>
					<?php endforeach ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="public">

				<?php if ($pubArtV): ?>
					<?php foreach ($pubArtV as $pAV): ?>
						<?php echo $this->Html->image(
				    		'/files/'.$pAV['Image']['seccion'].'/'.$pAV['Image']['id'].'.'.$pAV['Image']['extension'],
				    		array(
				    			'alt' => $pAV['Ad']['nombre'],
				    			'url' => $pAV['Ad']['link']
				    		)
				    	); ?>
					<?php endforeach ?>
				<?php endif ?>

			</div>
		</aside>
		<div class="clear"></div>

		<?php if (!empty($moreOfEditor)): ?>
			
			<aside class="asideB">
				<div class="title columns">
					<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'viewAll?author='.$article['Editor']['permalink'])); ?>">
						<span>Otros art&iacute;culos del autor</span>
					</a>
				</div>
				<div class="content columns">
					<ul>
						<?php foreach ($moreOfEditor as $Ed): ?>
							<li class="otherB">
								<a href="<?php echo ($Ed['Article']['albume_id']==0)?$this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$Ed['Article']['id'].'-'.$Ed['Article']['permalink'])):$this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$Ed['Albume']['id'].'-'.$Ed['Albume']['permalink'])); ?>">
									<?php
									$widthSmall = 1280;
									foreach ($Ed['Image'] as $I) {
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
									<div class="title">
										<h4><?php echo $Ed['Article']['titulo']; ?></h4>
									</div>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="clear"></div>
			</aside>
			
		<?php endif ?>
	
		<?php if (!empty($pubArtH['Image'])): ?>

			<div class="pubIntoH">
				<?php echo $this->Html->image(
		    		'/files/'.$pubArtH['Image']['seccion'].'/'.$pubArtH['Image']['id'].'.'.$pubArtH['Image']['extension'],
		    		array(
		    			'alt' => $pubArtH['Ad']['nombre'],
		    			'url' => $pubArtH['Ad']['link']
		    		)
		    	); ?>
			</div>
			
		<?php endif ?>

	<?php else: ?>

		<?php echo $this->Element('error_404'); ?>

	<?php endif ?>

</div>