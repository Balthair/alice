
<div class="photographers index">
	<h2><?php echo __('Photographers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($photographers as $photographer): ?>
	<tr>
		<td><?php echo h($photographer['Photographer']['id']); ?>&nbsp;</td>
		<td><?php echo h($photographer['Photographer']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($photographer['Photographer']['created']); ?>&nbsp;</td>
		<td><?php echo h($photographer['Photographer']['user_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $photographer['Photographer']['id']),array('class'=>'btn btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $photographer['Photographer']['id']), array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $photographer['Photographer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Agregar Fotografo'), array('action' => 'add'),array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>
