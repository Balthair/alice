<div id="contentBody" class="row">

	<?php if (!empty($articles) and $articles != ''): ?>

		<div class="editTop">
			<div class="editL large-9 columns">
				<div class="intoEdit row">
					<div class="artsInto allArt columns">
						<?php foreach ($articles as $aS): ?>
							<div class="art">
								<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$aS['Article']['id'].'-'.$aS['Article']['permalink'])); ?>">
									<div class="image">
										<?php
										if (!empty($aS['Image'])) {
											$widthSmall = 1280;
											foreach ($aS['Image'] as $I) {
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
									    	);
									    } else {
						    				echo $this->Html->image(
									    		'/files/defaultSmall.png'
									    	);
						    			} ?>
									</div>
									<div class="content">
										<h2><?php echo $aS['Article']['titulo']; ?></h2>
										<span class="editor"><?php echo $aS['Editor']['nombre']; ?></span>
										<div class="text">
											<?php echo $this->Text->truncate($aS['Article']['intro'], 200); ?>
										</div>
									</div>
								</a>
								<div class="clear"></div>
							</div>
						<?php endforeach ?>
					</div>
				</div>

				<div class="clear" style="height:1.5em;"></div>

	            <section class="pagination clear" style="float:rigth;">
	                <?php
	                if ($categoria != '') {
			        	$options['url'] = array_merge($this->passedArgs, array('?'=> 'categoria='.$categoria)); 
			        	$this->paginator->options($options); 	             
			        }
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
	            <div class="clear"></div>
			</div>
			<div class="editR large-3 columns">
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
			</div>
			<div class="clear"></div>
		</div>

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