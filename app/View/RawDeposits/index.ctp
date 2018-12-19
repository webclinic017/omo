<div class="rawDeposits index">
	<h2><?php echo __('Raw Deposits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('client_code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('ref'); ?></th>
			<th><?php echo $this->Paginator->sort('mop'); ?></th>
			<th><?php echo $this->Paginator->sort('bank_name'); ?></th>
			<th><?php echo $this->Paginator->sort('branch_name'); ?></th>
			<th><?php echo $this->Paginator->sort('cheque_no'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('portfolio_transaction_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($rawDeposits as $rawDeposit): ?>
	<tr>
		<td><?php echo h($rawDeposit['RawDeposit']['id']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['client_code']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['name']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['ref']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['mop']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['bank_name']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['branch_name']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['cheque_no']); ?>&nbsp;</td>
		<td><?php echo h($rawDeposit['RawDeposit']['amount']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($rawDeposit['PortfolioTransaction']['portfolio_id'], array('controller' => 'portfolio_transactions', 'action' => 'view', $rawDeposit['PortfolioTransaction']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rawDeposit['RawDeposit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rawDeposit['RawDeposit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rawDeposit['RawDeposit']['id']), array(), __('Are you sure you want to delete # %s?', $rawDeposit['RawDeposit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Raw Deposit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolio Transactions'), array('controller' => 'portfolio_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Transaction'), array('controller' => 'portfolio_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
