<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');

		echo $this->Form->input('username',array('class'=>'form-control'));
		echo $this->Form->input('password',array('class'=>'form-control'));
		echo $this->Form->input('role',array('class'=>'form-control'));

		/*echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role');*/

	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Guardar'),'class'=>'btn btn-success')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('User.id')), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Ver Usuarios'), array('action' => 'index'), array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>
