<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_type'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_id'); ?></th>
			<th><?php echo $this->Paginator->sort('no_of_shares'); ?></th>
			<th><?php echo $this->Paginator->sort('price_type'); ?></th>
			<th><?php echo $this->Paginator->sort('order_ref_no'); ?></th>
			<th><?php echo $this->Paginator->sort('final_price'); ?></th>
			<th><?php echo $this->Paginator->sort('buy_start_range'); ?></th>
			<th><?php echo $this->Paginator->sort('buy_end_range'); ?></th>
			<th><?php echo $this->Paginator->sort('order_place_time'); ?></th>
			<th><?php echo $this->Paginator->sort('order_status'); ?></th>
			<th><?php echo $this->Paginator->sort('last_update'); ?></th>
			<th><?php echo $this->Paginator->sort('cancel_status'); ?></th>
			<th><?php echo $this->Paginator->sort('market_order_status'); ?></th>
			<th><?php echo $this->Paginator->sort('drip_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('terminal'); ?></th>
			<th><?php echo $this->Paginator->sort('totalorderTerminal1'); ?></th>
			<th><?php echo $this->Paginator->sort('totalorderTerminal2'); ?></th>
			<th><?php echo $this->Paginator->sort('order_by_mobile'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['User']['username'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['order_type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $order['Instrument']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['no_of_shares']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['price_type']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['order_ref_no']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['final_price']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['buy_start_range']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['buy_end_range']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['order_place_time']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['order_status']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['last_update']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['cancel_status']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['market_order_status']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['drip_quantity']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['terminal']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['totalorderTerminal1']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['totalorderTerminal2']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['order_by_mobile']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array(), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
