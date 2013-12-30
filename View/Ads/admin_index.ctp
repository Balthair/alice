<div class="ads index">
	<h2><?php echo __('Ads'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('link'); ?></th>
			<th><?php echo $this->Paginator->sort('orientacion'); ?></th>
			<th><?php echo $this->Paginator->sort('bloque'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ads as $ad): ?>
	<tr>
		<td><?php echo h($ad['Ad']['id']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['link']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['orientacion']); ?>&nbsp;</td>
		<td><?php echo h($ad['Ad']['bloque']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ad['User']['username'], array('controller' => 'users', 'action' => 'view', $ad['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $ad['Ad']['id']),array('class'=>'btn btn-info')); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $ad['Ad']['id']), array('class'=>'btn btn-danger'), __('¿Estas seguro que deseas borrar este registro?', $ad['Ad']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, Mostrando {:current} registros de {:count} total, Iniciando registros en {:start}, Finalizando en {:end}')
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
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Agregar Publicidad'), array('action' => 'add'), array('class'=>'btn btn-success')); ?></li>
	</ul>
</div>
