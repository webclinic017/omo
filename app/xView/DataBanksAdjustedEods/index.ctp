<div class="dataBanksAdjustedEods index">
	<h2><?php echo __('Data Banks Adjusted Eods'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('market_id'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_id'); ?></th>
			<th><?php echo $this->Paginator->sort('open'); ?></th>
			<th><?php echo $this->Paginator->sort('high'); ?></th>
			<th><?php echo $this->Paginator->sort('low'); ?></th>
			<th><?php echo $this->Paginator->sort('close'); ?></th>
			<th><?php echo $this->Paginator->sort('volume'); ?></th>
			<th><?php echo $this->Paginator->sort('trade'); ?></th>
			<th><?php echo $this->Paginator->sort('tradevalues'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($dataBanksAdjustedEods as $dataBanksAdjustedEod): ?>
	<tr>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dataBanksAdjustedEod['Market']['id'], array('controller' => 'markets', 'action' => 'view', $dataBanksAdjustedEod['Market']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dataBanksAdjustedEod['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $dataBanksAdjustedEod['Instrument']['id'])); ?>
		</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['open']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['high']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['low']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['close']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['volume']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['trade']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['tradevalues']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['date']); ?>&nbsp;</td>
		<td><?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id']), array(), __('Are you sure you want to delete # %s?', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Data Banks Adjusted Eod'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
