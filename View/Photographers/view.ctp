<div class="photographers view">
<h2><?php  echo __('Photographer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($photographer['Photographer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($photographer['Photographer']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Permalink'); ?></dt>
		<dd>
			<?php echo h($photographer['Photographer']['permalink']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($photographer['Photographer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($photographer['Photographer']['user_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photographer'), array('action' => 'edit', $photographer['Photographer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photographer'), array('action' => 'delete', $photographer['Photographer']['id']), null, __('Are you sure you want to delete # %s?', $photographer['Photographer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photographers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photographer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
