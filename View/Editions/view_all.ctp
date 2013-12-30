<div id="contentBody" class="row">
	<div class="editTop">
		<div class="edit largeL columns">
			<?php if (!empty($lastEdition)): ?>
				
				<a href="<?php echo $this->Html->url(array('controller'=>'Editions','action'=>'view','title'=>$lastEdition['Edition']['id'].'-'.$lastEdition['Edition']['permalink'])); ?>">
					<div class="image">
						<?php echo $this->Html->image(
				    		'/files/'.$lastEdition['Image']['seccion'].'/'.$lastEdition['Image']['id'].'.'.$lastEdition['Image']['extension'],
				    		array(
				    			'alt' => $lastEdition['Edition']['nombre'],
				    		)
				    	); ?>
						<div class="text">
							<div class="into">
								<h3><?php echo $lastEdition['Edition']['nombre']; ?></h3>
							</div>
						</div>
					</div>
				</a>

			<?php endif ?>
			
		</div>
		<div class="largeR columns">
			<div id="slide">
				<ul data-orbit data-options="bullets:false;timer_speed:4000;resume_on_mouseout: true;slide_number: false;">
					<?php if (is_array($articles)): ?>
						
						<?php foreach ($articles as $a): ?>
						  	<li>		
						    	<a href="<?php echo ($a['Article']['albume_id']==0)?$this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$a['Article']['id'].'-'.$a['Article']['permalink'])):$this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$a['Albume']['id'].'-'.$a['Albume']['permalink'])); ?>">
						    		<div class="image">
						    			<?php
										$widthLarge = 0;
										foreach ($a['Image'] as $I) {
											$src = $I['seccion'].'/'.$I['id'].'.'.$I['extension'];
											$this->Image->imagen(Configure::read('absolute_root').$src);
											$widthImg = $this->Image->image_width;
											if ($widthImg > $widthLarge) {
												$srcLarge = $src;
												$widthLarge = $widthImg;
											}
										}
										echo $this->Html->image(
								    		'/files/'.$srcLarge
								    	); ?>
						    		</div>
						    	</a>
						  	</li>
						<?php endforeach ?>

					<?php endif ?>
					
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div id="Editions" class="editAll row">

		<?php if (is_array($editions)): ?>
			
			<?php foreach ($editions as $e): ?>
				
				<div class="edit large-3 columns">
					<a href="<?php echo $this->Html->url(array('controller'=>'Editions','action'=>'view','title'=>$e['Edition']['id'].'-'.$e['Edition']['permalink'])); ?>">
						<div class="image">
							<?php echo $this->Html->image(
					    		'/files/'.$e['Image']['seccion'].'/'.$e['Image']['id'].'.'.$e['Image']['extension'],
					    		array(
					    			'alt' => $e['Edition']['nombre'],
					    		)
					    	); ?>
							<div class="text">
								<h3><?php echo $e['Edition']['nombre']; ?></h3>
							</div>
						</div>
					</a>
				</div>

			<?php endforeach ?>
			
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
	
	<?php if (!empty($pubEdiH['Image'])): ?>

		<div class="pubIntoH">
			<?php echo $this->Html->image(
	    		'/files/'.$pubEdiH['Image']['seccion'].'/'.$pubEdiH['Image']['id'].'.'.$pubEdiH['Image']['extension'],
	    		array(
	    			'alt' => $pubEdiH['Ad']['nombre'],
	    			'url' => $pubEdiH['Ad']['link']
	    		)
	    	); ?>
		</div>
		
	<?php endif ?>
	
</div>