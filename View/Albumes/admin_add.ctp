<div class="albumes form">
<?php echo $this->Form->create('Albume',array('inputDefaults' => array('required' => false))); ?>
	<fieldset>
		<legend><?php echo __('Add Albume'); ?></legend>
	<?php
		echo $this->Form->input('nombre',array('class'=>'form-control'));
		echo $this->Form->input('photographer_id',array('class'=>'form-control'));
		echo $this->Form->input('descripcion',array('class'=>'form-control'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Guardar'),'class'=>'btn btn-success')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Albumes'), array('action' => 'index'),array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>
