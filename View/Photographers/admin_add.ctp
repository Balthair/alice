<div class="photographers form">
<?php echo $this->Form->create('Photographer'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Fotografo'); ?></legend>
	<?php
		echo $this->Form->input('nombre',array('class'=>'form-control'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Guardar'),'class'=>'btn btn-success')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Fotografos'), array('action' => 'index'),array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>
