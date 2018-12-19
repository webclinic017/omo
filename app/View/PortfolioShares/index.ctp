<div class="portfolioShares index">
	<h2><?php echo __('Portfolio Shares'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('is_spot'); ?></th>
			<th><?php echo $this->Paginator->sort('commission'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('dse_order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('dse_execution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('omo_order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($portfolioShares as $portfolioShare): ?>
	<tr>
		<td><?php echo h($portfolioShare['PortfolioShare']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($portfolioShare['Portfolio']['portfolio_name'], array('controller' => 'portfolios', 'action' => 'view', $portfolioShare['Portfolio']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($portfolioShare['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $portfolioShare['Instrument']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($portfolioShare['TransactionType']['description'], array('controller' => 'transaction_types', 'action' => 'view', $portfolioShare['TransactionType']['id'])); ?>
		</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['amount']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['rate']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['transaction_time']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['is_spot']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['commission']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($portfolioShare['ParentPortfolioShare']['id'], array('controller' => 'portfolio_shares', 'action' => 'view', $portfolioShare['ParentPortfolioShare']['id'])); ?>
		</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['dse_order_id']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['dse_execution_id']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['omo_order_id']); ?>&nbsp;</td>
		<td><?php echo h($portfolioShare['PortfolioShare']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $portfolioShare['PortfolioShare']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $portfolioShare['PortfolioShare']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $portfolioShare['PortfolioShare']['id']), array(), __('Are you sure you want to delete # %s?', $portfolioShare['PortfolioShare']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Portfolio Share'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Types'), array('controller' => 'transaction_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Type'), array('controller' => 'transaction_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Shares'), array('controller' => 'portfolio_shares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Portfolio Share'), array('controller' => 'portfolio_shares', 'action' => 'add')); ?> </li>
	</ul>
</div>
