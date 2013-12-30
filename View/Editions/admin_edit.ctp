<div class="editions form">
<?php echo $this->Form->create('Edition'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Edition'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre',array('class'=>'form-control'));
		echo $this->Form->input('user_id',array('class'=>'form-control', 'value'=>$this->request->data['User']['username'],'type'=>'text','disabled'=>'disabled'));
	?>
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
	<div class="text input">
		<?php echo $this->Form->label('Estado'); ?>
		<label class="switch-light well" onclick="">
			<?php echo $this->Form->input('estado',array('type'=>'checkbox','label'=>false,'div'=>false)); ?>
			<span>
				<span>Off</span>
				<span>On</span>
			</span>
			<a class="btn btn-primary"></a>
		</label>
	</div>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Guardar'),'class'=>'btn btn-success')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Edition.id')), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Edition.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listas Ediciones'), array('action' => 'index'), array('class'=>'btn btn-success')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Articulos'), array('controller' => 'articles', 'action' => 'index'), array('class'=>'btn btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Articulo'), array('controller' => 'articles', 'action' => 'add'), array('class'=>'btn btn-success')); ?> </li>
	</ul>
</div>

<script type="text/javascript">
	<?php 
	$timestamp = time();
	$seccion = base64_encode('editions');
	$url = $this->Html->url('/upload/Upload_File/?seccion='.$seccion);
	$check = $this->Html->url('/upload/check_exists/?seccion='.$seccion);
	$img = @$this->request->data['Edition']['id'];
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
			'uploadScript'     : '<?php echo $url."&img=".$img ?>',
			'onUploadComplete' : function(file, data) { 
				
				$('.print_images').empty();

				$('.print_images').append(data);

			}
		});
	});
</script>

