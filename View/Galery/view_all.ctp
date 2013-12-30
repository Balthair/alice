<div id="contentBody" class="row">
	<div class="galeryCont">
		<div class="large-12 columns">
			
			<?php if (!empty($galeryP)): ?>
				
				<a href="<?php echo $this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$galeryP['Albume']['id'].'-'.$galeryP['Albume']['permalink'])); ?>">
					<h1><?php echo $galeryP['Albume']['nombre']; ?></h1>
					<div id="slide">
						<ul data-orbit data-options="bullets:false;animation_speed:300;timer_speed:4000;animation:'fade';resume_on_mouseout:true;slide_number:false;">
							<?php foreach ($galeryP['Image'] as $Img): ?>

								<?php if (file_exists(Configure::read('absolute_root').$Img['seccion'].'/'.$Img['id'].'.'.$Img['extension'])): ?>
									
								  	<li>		
							    		<div class="image">
									    	<?php echo $this->Html->image(
									    		'/files/'.$Img['seccion'].'/'.$Img['id'].'.'.$Img['extension']
									    	); ?>
							    		</div>
								  	</li>

								<?php endif ?>
							<?php endforeach ?>
						  	
						</ul>
					</div>
				</a>

			<?php endif ?>

			<?php if (!empty($galeries)): ?>

				<div class="galeryBottom">
					<h2>Otras Galer&iacute;as</h2>
					<div class="content row">

						<div class="large-9 columns">

							<?php foreach ($galeries as $gal): ?>

								<div class="otherB large-6 small-6 columns">
									<a href="<?php echo $this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$gal['Albume']['id'].'-'.$gal['Albume']['permalink'])); ?>">
										<div class="image">
									    	<?php echo $this->Html->image(
									    		'/files/'.$gal['Image'][0]['seccion'].'/thumbs/'.$gal['Image'][0]['id'].'.'.$gal['Image'][0]['extension']
									    	); ?>
								    		<div class="text">
												<h3><?php echo $gal['Albume']['nombre']; ?></h3>
											</div>
							    		</div>
									</a>
								</div>
								
							<?php endforeach ?>

						</div>

						<div class="large-3 columns">

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
						</div>

					</div>
				</div>

				<div class="clear" style="height:1.5em;"></div>

				<section class="pagination clear">
					<?php
					echo $this->Paginator->prev('«', null, null, array('class' => 'disabled prev'));
				    echo $this->Paginator->numbers(
				    	array(
				    		'separator'=>'',
				    		'tag'=>'span',
				    		'class'=>'numbers rad'
				    	)
				    ); 
				    echo $this->Paginator->next('»', null, null, array('class' => 'disabled next'));
				    ?>
				</section>
				
			<?php endif ?>
		</div>
		<div class="clear"></div>
	</div>

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