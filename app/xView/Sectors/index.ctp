<div class="sectors index">
	<h2><?php echo __('Sectors'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('full_name'); ?></th>
			<th><?php echo $this->Paginator->sort('dse_sector_id'); ?></th>
			<th><?php echo $this->Paginator->sort('exchange_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sectors as $sector): ?>
	<tr>
		<td><?php echo h($sector['Sector']['id']); ?>&nbsp;</td>
		<td><?php echo h($sector['Sector']['name']); ?>&nbsp;</td>
		<td><?php echo h($sector['Sector']['full_name']); ?>&nbsp;</td>
		<td><?php echo h($sector['Sector']['dse_sector_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sector['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $sector['Exchange']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sector['Sector']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sector['Sector']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sector['Sector']['id']), array(), __('Are you sure you want to delete # %s?', $sector['Sector']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Sector'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Intradays'), array('controller' => 'sector_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector Intraday'), array('controller' => 'sector_intradays', 'action' => 'add')); ?> </li>
	</ul>
</div>
