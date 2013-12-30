<div class="articles form">
<?php echo $this->Form->create('Article'); ?>
	<fieldset>
		<legend><?php echo __('Edit Article'); ?></legend>
	<div class="head_upload">
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<a class="upload_all btn btn-success" style="position: relative;" href="javascript:$('#file_upload').uploadifive('upload')" title="Subir Archivos">
			<span class="glyphicon glyphicon-open"></span>
		</a>
	</div>
	<div id="queue">
		<div class="print_images">
			<?php
			if (isset($this->request->data['Image'])) foreach($this->request->data['Image'] as $a) {


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
	</div>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('titulo',array('class'=>'form-control'));
		echo $this->Form->input('intro',array('class'=>'form-control','required'=>false));
		echo $this->Form->input('contenido',array('class'=>'form-control wysiwyg'));
		echo $this->Form->input('editor_id',array('class'=>'form-control'));
		echo $this->Form->input('pie_foto',array('class'=>'form-control'));
		echo $this->Form->input('edition_id',array('class'=>'form-control'));
		echo $this->Form->input('categoria_id',array('class'=>'form-control'));
		echo $this->Form->input('albume_id',array('class'=>'form-control','div'=>array('style'=>@$this->request->data['Article']['categoria_id']!=5?'display:none':'')));
		echo $this->Form->input('relevancia_id',array('class'=>'form-control'));
	?>
	<script>	
		$(function() {
			$("#ArticleCategoriaId").change(function(){
				if($("#ArticleCategoriaId").val() != 5)
					$("#ArticleAlbumeId").parent().hide("slow");
				else 
					$("#ArticleAlbumeId").parent().show("slow");
			});
		});
		$(function(){
			tinymce.init({
		      relative_urls: false,
		      selector: "textarea.wysiwyg",
		      plugins: [
		                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
		                "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
		                "table contextmenu directionality emoticons paste textcolor filemanager"
		            ],
		            image_advtab: true,
		      toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image | preview code",
		      height : 300,
		      resize : false
		  });
		});
	</script>
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
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Article.id')), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Article.id'))); ?></li>
		<li><?php echo $this->Html->link(__('New Article'), array('action' => 'add'),array('class' => 'btn btn-success','escape'=>false)); ?></li>
		<li><?php echo $this->Html->link(__('List Editors'), array('controller' => 'editors', 'action' => 'index'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link(__('New Editor'), array('controller' => 'editors', 'action' => 'add'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link(__('List Editions'), array('controller' => 'editions', 'action' => 'index'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link(__('New Edition'), array('controller' => 'editions', 'action' => 'add'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
	</ul>
</div>

<script type="text/javascript">
	<?php 
	$timestamp = time();
	$seccion = base64_encode('articles');
	$url = $this->Html->url('/upload/Upload_File/?seccion='.$seccion);
	$check = $this->Html->url('/upload/check_exists/?seccion='.$seccion);
	$img = @$this->request->data['Article']['id'];
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

			}
		});

		$('.drop').delete_img();
	});
</script>
