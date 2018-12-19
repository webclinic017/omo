<div class="markets index">
	<h2><?php echo __('Markets'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('trade_date'); ?></th>
			<th><?php echo $this->Paginator->sort('is_trading_day'); ?></th>
			<th><?php echo $this->Paginator->sort('market_started'); ?></th>
			<th><?php echo $this->Paginator->sort('market_closed'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th><?php echo $this->Paginator->sort('exchange_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($markets as $market): ?>
	<tr>
		<td><?php echo h($market['Market']['id']); ?>&nbsp;</td>
		<td><?php echo h($market['Market']['trade_date']); ?>&nbsp;</td>
		<td><?php echo h($market['Market']['is_trading_day']); ?>&nbsp;</td>
		<td><?php echo h($market['Market']['market_started']); ?>&nbsp;</td>
		<td><?php echo h($market['Market']['market_closed']); ?>&nbsp;</td>
		<td><?php echo h($market['Market']['comments']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($market['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $market['Exchange']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $market['Market']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $market['Market']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $market['Market']['id']), array(), __('Are you sure you want to delete # %s?', $market['Market']['id'])); ?>
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
        echo $this->Paginator->prev('< ' . __('previous  '), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ' | '));
        echo $this->Paginator->next(__('  next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Market'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Intradays'), array('controller' => 'data_banks_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Intraday'), array('controller' => 'data_banks_intradays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Index Values'), array('controller' => 'index_values', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Index Value'), array('controller' => 'index_values', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('controller' => 'market_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
