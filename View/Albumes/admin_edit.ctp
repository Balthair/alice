<div class="albumes form">
<?php echo $this->Form->create('Albume'); ?>
	<fieldset>
		<legend><?php echo __('Edit Albume'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Albume.id')), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Albume.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Ver Album'), array('action' => 'view', $this->Form->value('Albume.id')), array('class'=>'btn btn-info')); ?></li>
		<li><?php echo $this->Html->link(__('List Albumes'), array('action' => 'index'),array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>
