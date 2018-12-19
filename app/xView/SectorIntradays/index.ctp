<div class="sectorIntradays index">
	<h2><?php echo __('Sector Intradays'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('market_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sector_list_id'); ?></th>
			<th><?php echo $this->Paginator->sort('index_change'); ?></th>
			<th><?php echo $this->Paginator->sort('index_change_per'); ?></th>
			<th><?php echo $this->Paginator->sort('price_change'); ?></th>
			<th><?php echo $this->Paginator->sort('volume'); ?></th>
			<th><?php echo $this->Paginator->sort('contribution'); ?></th>
			<th><?php echo $this->Paginator->sort('index_date'); ?></th>
			<th><?php echo $this->Paginator->sort('index_time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($sectorIntradays as $sectorIntraday): ?>
	<tr>
		<td><?php echo h($sectorIntraday['SectorIntraday']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sectorIntraday['Market']['id'], array('controller' => 'markets', 'action' => 'view', $sectorIntraday['Market']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($sectorIntraday['SectorList']['name'], array('controller' => 'sector_lists', 'action' => 'view', $sectorIntraday['SectorList']['id'])); ?>
		</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['index_change']); ?>&nbsp;</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['index_change_per']); ?>&nbsp;</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['price_change']); ?>&nbsp;</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['volume']); ?>&nbsp;</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['contribution']); ?>&nbsp;</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['index_date']); ?>&nbsp;</td>
		<td><?php echo h($sectorIntraday['SectorIntraday']['index_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sectorIntraday['SectorIntraday']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sectorIntraday['SectorIntraday']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sectorIntraday['SectorIntraday']['id']), array(), __('Are you sure you want to delete # %s?', $sectorIntraday['SectorIntraday']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
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
		<li><?php echo $this->Html->link(__('New Sector Intraday'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Lists'), array('controller' => 'sector_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector List'), array('controller' => 'sector_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
