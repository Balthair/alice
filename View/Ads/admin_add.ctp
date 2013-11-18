<div class="ads form">
<?php echo $this->Form->create('Ad',array('inputDefaults' => array('required' => false))); ?>
	<fieldset>
		<legend><?php echo __('Agregar Publicidad'); ?></legend>
	<?php
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
		echo $this->Form->input('user_id',array('class'=>'form-control', 'value'=>$dataUser['User']['username'],'type'=>'text','disabled'=>'disabled'));
	?>
	<div class="head_upload">
		<input id="file_upload" name="file_upload" type="file" multiple="false">
		<a class="upload_all btn btn-success" style="position: relative;" href="javascript:$('#file_upload').uploadifive('upload')" title="Subir Archivos">
			<span class="glyphicon glyphicon-open"></span>
		</a>
	</div>
	<div id="queue">
		<div class="print_images"></div>
	</div>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Guardar'),'class'=>'btn btn-success')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Publicidades'), array('action' => 'index'),array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>

<script type="text/javascript">
	<?php 
	$timestamp = time();
	$seccion = base64_encode('ads');
	$url = $this->Html->url('/upload/Upload_File/?seccion='.$seccion);
	$check = $this->Html->url('/upload/check_exists/?seccion='.$seccion);
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
			'uploadScript'     : '<?php echo $url ?>',
			'onUploadComplete' : function(file, data) { 
				
				$('.print_images').empty();

				$('.print_images').append(data);

			}
		});
	});
</script>
