<div class="articles form">
<?php echo $this->Form->create('Article',array('inputDefaults' => array('required' => false))); ?>
	<fieldset>
		<legend><?php echo __('Agregar Articulo'); ?></legend>
	<?php
		echo $this->Form->input('titulo',array('class'=>'form-control'));
		echo $this->Form->input('intro',array('class'=>'form-control','required'=>false));
		echo $this->Form->input('contenido',array('class'=>'form-control wysiwyg'));
		echo $this->Form->input('editor_id',array('class'=>'form-control'));
		echo $this->Form->input('pie_foto',array('class'=>'form-control'));
		echo $this->Form->input('edition_id',array('class'=>'form-control'));
		echo $this->Form->input('categoria_id',array('class'=>'form-control'));
		echo $this->Form->input('albume_id',array('class'=>'form-control','div'=>array('style'=>'display:none')));
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

		<li><?php echo $this->Html->link(__('New Article'), array('action' => 'add'),array('class' => 'btn btn-success','escape'=>false)); ?></li>
		<li><?php echo $this->Html->link(__('List Editors'), array('controller' => 'editors', 'action' => 'index'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link(__('New Editor'), array('controller' => 'editors', 'action' => 'add'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link(__('List Editions'), array('controller' => 'editions', 'action' => 'index'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link(__('New Edition'), array('controller' => 'editions', 'action' => 'add'),array('class' => 'btn btn-success','escape'=>false)); ?> </li>
	</ul>
</div>