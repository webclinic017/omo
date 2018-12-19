<div class="rawTradins index">
	<h2><?php echo __('Raw Tradins'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('dealer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_code'); ?></th>
			<th><?php echo $this->Paginator->sort('board'); ?></th>
			<th><?php echo $this->Paginator->sort('execute_time'); ?></th>
			<th><?php echo $this->Paginator->sort('execute_qty'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('oredr_id'); ?></th>
			<th><?php echo $this->Paginator->sort('execution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($rawTradins as $rawTradin): ?>
	<tr>
		<td><?php echo h($rawTradin['RawTradin']['id']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['dealer_id']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['client_id']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['instrument_code']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['board']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['execute_time']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['execute_qty']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['price']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['oredr_id']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['execution_id']); ?>&nbsp;</td>
		<td><?php echo h($rawTradin['RawTradin']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rawTradin['RawTradin']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rawTradin['RawTradin']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rawTradin['RawTradin']['id']), array(), __('Are you sure you want to delete # %s?', $rawTradin['RawTradin']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Raw Tradin'), array('action' => 'add')); ?></li>
	</ul>
</div>
