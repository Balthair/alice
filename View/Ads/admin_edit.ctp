<div class="ads form">
<?php echo $this->Form->create('Ad'); ?>
	<fieldset>
		<legend><?php echo __('Editar Publicidades'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre',array('class'=>'form-control'));
		echo $this->Form->input('link',array('class'=>'form-control'));
		echo $this->Form->input('orientacion',array(
			'class'=>'form-control',
			'options' => array('horizontal'=>'Horizontal','vertical'=>'Vertical')
			)
		);
		echo $this->Form->input('bloque',array(
			'class'=>'form-control',
			'options' => array('portada'=>'Portada','ediciones'=>'Ediciones','articulos'=>'Articulos','galerias'=>'Galerias')
			)
		);
		echo $this->Form->input('user_id',array('class'=>'form-control', 'value'=>$this->request->data['User']['username'],'type'=>'text','disabled'=>'disabled'));
	?>
	</fieldset>
	<div class="head_upload">
		<input id="file_upload" name="file_upload" type="file" multiple="false">
		<a class="upload_all btn btn-success" style="position: relative;" href="javascript:$('#file_upload').uploadifive('upload')" title="Subir Archivos">
			<span class="glyphicon glyphicon-open"></span>
		</a>
	</div>
	<div id="queue">
		<div class="print_images">
			<?php
			if (isset($this->request->data['Image'])) {
				$src = $this->request->data['Image']['seccion'].'/'.$this->request->data['Image']['id'].'.'.$this->request->data['Image']['extension'];
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
							'/upload/delete_imagen/'.$this->request->data['Image']['id'],
							array(
								'class' => 'drop',
								'escape' => false,
								'data' => $this->request->data['Image']['id']
							)	
						),
						array(
							'class' => 'pic_wrapper',
							'id' => $this->request->data['Image']['id']
						)
					);
				}
			}
			?>
		</div>
	</div>
<?php echo $this->Form->end(array('label'=>__('Guardar'),'class'=>'btn btn-success')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Ad.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Ad.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listas Publicidades'), array('action' => 'index')); ?></li>
	</ul>
</div>

<script type="text/javascript">
	<?php 
	$timestamp = time();
	$seccion = base64_encode('ads');
	$url = $this->Html->url('/upload/Upload_File/?seccion='.$seccion);
	$check = $this->Html->url('/upload/check_exists/?seccion='.$seccion);
	$img = @$this->request->data['Ad']['id'];
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
				
				$('.print_images').empty();

				$('.print_images').append(data);

			}
		});

		$('.drop').delete_img();
	});
</script>
