<div class="portfolioLedgers index">
	<h2><?php echo __('Portfolio Ledgers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('portfolio_id'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_id'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('amount'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_time'); ?></th>
			<th><?php echo $this->Paginator->sort('commission'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($portfolioLedgers as $portfolioLedger): ?>
	<tr>
		<td><?php echo h($portfolioLedger['PortfolioLedger']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($portfolioLedger['Portfolio']['portfolio_name'], array('controller' => 'portfolios', 'action' => 'view', $portfolioLedger['Portfolio']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($portfolioLedger['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $portfolioLedger['Instrument']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($portfolioLedger['TransactionType']['description'], array('controller' => 'transaction_types', 'action' => 'view', $portfolioLedger['TransactionType']['id'])); ?>
		</td>
		<td><?php echo h($portfolioLedger['PortfolioLedger']['amount']); ?>&nbsp;</td>
		<td><?php echo h($portfolioLedger['PortfolioLedger']['rate']); ?>&nbsp;</td>
		<td><?php echo h($portfolioLedger['PortfolioLedger']['transaction_time']); ?>&nbsp;</td>
		<td><?php echo h($portfolioLedger['PortfolioLedger']['commission']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $portfolioLedger['PortfolioLedger']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $portfolioLedger['PortfolioLedger']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $portfolioLedger['PortfolioLedger']['id']), array(), __('Are you sure you want to delete # %s?', $portfolioLedger['PortfolioLedger']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Portfolio Ledger'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Types'), array('controller' => 'transaction_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Type'), array('controller' => 'transaction_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
