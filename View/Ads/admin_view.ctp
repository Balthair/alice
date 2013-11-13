<div class="ads view">
<h2><?php  echo __('Ad'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ad['Ad']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($ad['Ad']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($ad['Ad']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orientacion'); ?></dt>
		<dd>
			<?php echo h($ad['Ad']['orientacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bloque'); ?></dt>
		<dd>
			<?php echo h($ad['Ad']['bloque']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ad['User']['username'], array('controller' => 'users', 'action' => 'view', $ad['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ad'), array('action' => 'edit', $ad['Ad']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ad'), array('action' => 'delete', $ad['Ad']['id']), null, __('Are you sure you want to delete # %s?', $ad['Ad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ad'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
