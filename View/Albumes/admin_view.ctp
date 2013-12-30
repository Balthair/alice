<div class="albumes view">
<h2><?php  echo __('Albume'); ?></h2>
<div id="pics">	
	<?php
	if (isset($albume['Image'])) foreach($albume['Image'] as $a) {


		$src = $a['seccion'].'/'.$a['id'].'.'.$a['extension'];

		if (file_exists(Configure::read('absolute_root').$src)) {

			echo $this->Html->tag(
				'div',
				$this->Html->image(
					'/files/'.$src  ,
					array(
						'class' => 'pic'
					)
				).
				$this->Html->link(
					$this->Html->image(
						'admin/delete.png',
						array(
							'style' => 'position:absolute;right:10px;top:10px',
							'class' => 'icon_control'
						)
					),
					'/upload/delete_imagen/'.$a['id'],
					array(
						'class' => 'drop',
						'escape' => false,
						'data' => $a['id']
					)	
				),
				array(
					'class' => 'pic_wrapper',
					'id' => $a['id']
				)
			);
		}
	}
	?>
	</div>
	<div class="clear" style="height:1em"></div>
	<div class="head_upload">
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<a class="upload_all btn btn-success" style="position: relative;" href="javascript:$('#file_upload').uploadifive('upload')" title="Subir Archivos">
			<span class="glyphicon glyphicon-open"></span>
		</a>
	</div>
	<div id="queue">
		<div class="print_images"></div>
	</div>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Albume'), array('action' => 'edit', $albume['Albume']['id']),array('class'=>'btn btn-info')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Albume'), array('action' => 'delete', $albume['Albume']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $albume['Albume']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Albumes'), array('action' => 'index'),array('class'=>'btn btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Albume'), array('action' => 'add'),array('class'=>'btn btn-success')); ?> </li>
	</ul>
</div>


<script type="text/javascript">
	<?php 
	$timestamp = time();
	$seccion = base64_encode('albumes');
	$url = $this->Html->url('/upload/Upload_File/?seccion='.$seccion);
	$check = $this->Html->url('/upload/check_exists/?seccion='.$seccion);

	$img = @$albume['Albume']['id'];
	?>
	$(function() {

		$('#file_upload').uploadifive({
			'auto'             : false,
			'checkScript'      : '<?php echo $check ?>',
			'formData'         : {
								   'timestamp' : '<?php echo $timestamp;?>',
								   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			                     },
			'queueID'          : 'queue',
			'uploadScript'     : '<?php echo $url."&img=".$img."&multi=true" ?>',
			'onUploadComplete' : function(file, data) { 
				
				//$('.print_images').empty();

				$('.print_images').append(data);
				$('#pics').append(data);

			}
		});

		$('.drop').delete_img();
	});

</script>