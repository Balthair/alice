<div id="contentBody" class="row">

	<?php if (isset($edition) and !empty($edition) and $edition != '' and !empty($articlePrinc) and !empty($articlesSec)): ?>

		<div class="editTop">
			<div class="editL large-9 columns">
				<div class="intoEdit row">
					<div class="large-4 columns">
						<div class="image">
							<?php echo $this->Html->image(
					    		'/files/'.$edition['Image']['seccion'].'/'.$edition['Image']['id'].'.'.$edition['Image']['extension'],
					    		array(
					    			'alt' => $edition['Edition']['nombre'],
					    		)
					    	); ?>
					    	<div class="editShare">
							<div class="fb-like" data-href="<?php echo $this->Html->url(array('controller'=>'Editions','action'=>'view','title'=>$edition['Edition']['id'].'-'.$edition['Edition']['permalink'])); ?>" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div>
							<div class="twitter">
								<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
							</div>
							<div class="clear"></div>
						</div>
						</div>
					</div>
					<div class="large-8 columns">
						<div class="authorShare">
							<h1><?php echo $edition['Edition']['nombre']; ?></h1>
							<div class="clear"></div>
						</div>
						<a href="<?php echo ($articlePrinc['Article']['albume_id']==0)?$this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$articlePrinc['Article']['id'].'-'.$articlePrinc['Article']['permalink'])):$this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$articlePrinc['Albume']['id'].'-'.$articlePrinc['Albume']['permalink'])); ?>">
							<div class="image">
								<?php
								$widthLarge = 0;
								foreach ($articlePrinc['Image'] as $I) {
									$src = $I['seccion'].'/'.$I['id'].'.'.$I['extension'];
									$this->Image->imagen(Configure::read('absolute_root').$src);
									$widthImg = $this->Image->image_width;
									if ($widthImg > $widthLarge) {
										$srcLarge = $src;
										$widthLarge = $widthImg;
									}
								}
								echo $this->Html->image(
						    		'/files/'.$srcLarge,
							    		array(
						    			'alt' => $articlePrinc['Article']['titulo'],
						    		)
						    	); ?>
							</div>
							<div class="title">
								<h2><?php echo $articlePrinc['Article']['titulo']; ?></h2>
							</div>
						</a>
					</div>
					<div class="clear"></div>
					<div class="artsInto columns">
						<?php foreach ($articlesSec as $aS): ?>
							<div class="art">
								<a href="<?php echo ($aS['Article']['albume_id']==0)?$this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$aS['Article']['id'].'-'.$aS['Article']['permalink'])):$this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$aS['Albume']['id'].'-'.$aS['Albume']['permalink'])); ?>">
									<div class="image">
										<?php
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
						    			?>
										<?php echo $this->Html->image(
								    		'/files/'.$I['seccion'].'/'.'thumbs/'.$srcSmall
								    	); ?>
									</div>
								</a>
								<div class="content">
									<a href="<?php echo ($aS['Article']['albume_id']==0)?$this->Html->url(array('controller'=>'Articles','action'=>'view','title'=>$aS['Article']['id'].'-'.$aS['Article']['permalink'])):$this->Html->url(array('controller'=>'Galery','action'=>'view','title'=>$aS['Albume']['id'].'-'.$aS['Albume']['permalink'])); ?>">
										<h2><?php echo $aS['Article']['titulo']; ?></h2>
									</a>
									<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'viewAll?author='.$aS['Editor']['permalink'])); ?>">
										<span class="editor"><?php echo $aS['Editor']['nombre']; ?></span>
									</a>
									<div class="text">
										<?php echo $aS['Article']['intro']; ?>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
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
		<?php if (!empty($lastEditions)): ?>
			
			<div class="EditionsBottom">
				<h4 class="titleB">Ediciones</h4>
				<div>
					<?php foreach ($lastEditions as $lE): ?>
						<div class="edit large-3 columns">
							<a href="<?php echo $this->Html->url(array('controller'=>'Editions','action'=>'view','title'=>$lE['Edition']['id'].'-'.$lE['Edition']['permalink'])); ?>">
								<div class="image">
									<?php echo $this->Html->image(
							    		'/files/'.$lE['Image']['seccion'].'/'.$lE['Image']['id'].'.'.$lE['Image']['extension'],
							    		array(
							    			'alt' => $lE['Edition']['nombre'],
							    		)
							    	); ?>
									<div class="text">
										<h3><?php echo $lE['Edition']['nombre']; ?></h3>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach ?>
				</div>
				<div class="clear"></div>
			</div>
			
		<?php endif ?>

	<?php else: ?>

		<?php echo $this->Element('error_404'); ?>

	<?php endif ?>

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
</div>