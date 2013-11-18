<div id="contentBody" class="row">

	<?php if (!empty($galery)): ?>
		
		<div class="galeryCont">
			<div class="large-12 columns">
				<h1><?php echo $galery['Albume']['nombre']; ?></h1>
				<div class="share">
					<div class="fb-like" data-href="<?php echo $this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$galery['Albume']['id'].'-'.$galery['Albume']['permalink']),true); ?>" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div>
					<div class="twitter">
						<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
					</div>
				</div>
				<?php foreach ($galery['Image'] as $Img) {

					if (file_exists(Configure::read('absolute_root').$Img['seccion'].'/'.$Img['id'].'.'.$Img['extension'])) {
					
					echo $this->Html->image(
			    		'/files/'.$Img['seccion'].'/'.$Img['id'].'.'.$Img['extension'],
			    		array(
			    			'class' => 'galImg'
			    		)
			    	);

			    	}	

				} ?>
				<div class="fb-comments" data-href="<?php echo $this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$galery['Albume']['id'].'-'.$galery['Albume']['permalink']),true); ?>" data-numposts="5" data-width="1232"></div>
			</div>
			<div class="clear"></div>
		</div>
		
	<?php endif ?>

	<?php if (!empty($otherG)): ?>

		<div class="galBottom">
			<h4 class="titleB">Otras Galer&iacute;as</h4>
			<div class="content">

				<?php foreach ($otherG as $oG): ?>
					
					<div class="otherB large-4 small-6 columns">
						<a href="<?php echo $this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$oG['Albume']['id'].'-'.$oG['Albume']['permalink'])); ?>">
							<div class="image">
								<?php echo $this->Html->image(
						    		'/files/'.$oG['Image'][0]['seccion'].'/thumbs/'.$oG['Image'][0]['id'].'.'.$oG['Image'][0]['extension']
						    	); ?>
								<div class="text">
									<h3><?php echo $oG['Albume']['nombre']; ?></h3>
								</div>
							</div>
						</a>
					</div>
					
				<?php endforeach ?>

			</div>
			<div class="clear"></div>
		</div>
		
	<?php endif ?>

	<?php if (!empty($pubAlbH['Image'])): ?>

		<div class="pubIntoH">
			<?php echo $this->Html->image(
	    		'/files/'.$pubAlbH['Image']['seccion'].'/'.$pubAlbH['Image']['id'].'.'.$pubAlbH['Image']['extension'],
	    		array(
	    			'alt' => $pubAlbH['Ad']['nombre'],
	    			'url' => $pubAlbH['Ad']['link']
	    		)
	    	); ?>
		</div>
		
	<?php endif ?>

</div>