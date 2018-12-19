<div class="portfolioShares view">
<h2><?php echo __('Portfolio Share'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['Portfolio']['portfolio_name'], array('controller' => 'portfolios', 'action' => 'view', $portfolioShare['Portfolio']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $portfolioShare['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['TransactionType']['description'], array('controller' => 'transaction_types', 'action' => 'view', $portfolioShare['TransactionType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Time'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['transaction_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Spot'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['is_spot']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['commission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Portfolio Share'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['ParentPortfolioShare']['id'], array('controller' => 'portfolio_shares', 'action' => 'view', $portfolioShare['ParentPortfolioShare']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dse Order Id'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['dse_order_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dse Execution Id'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['dse_execution_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Omo Order Id'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['omo_order_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Portfolio Share'), array('action' => 'edit', $portfolioShare['PortfolioShare']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Portfolio Share'), array('action' => 'delete', $portfolioShare['PortfolioShare']['id']), array(), __('Are you sure you want to delete # %s?', $portfolioShare['PortfolioShare']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Shares'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Share'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Portfolio Shares'); ?></h3>
	<?php if (!empty($portfolioShare['ChildPortfolioShare'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Portfolio Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Transaction Type Id'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Transaction Time'); ?></th>
		<th><?php echo __('Is Spot'); ?></th>
		<th><?php echo __('Commission'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Dse Order Id'); ?></th>
		<th><?php echo __('Dse Execution Id'); ?></th>
		<th><?php echo __('Omo Order Id'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($portfolioShare['ChildPortfolioShare'] as $childPortfolioShare): ?>
		<tr>
			<td><?php echo $childPortfolioShare['id']; ?></td>
			<td><?php echo $childPortfolioShare['portfolio_id']; ?></td>
			<td><?php echo $childPortfolioShare['instrument_id']; ?></td>
			<td><?php echo $childPortfolioShare['transaction_type_id']; ?></td>
			<td><?php echo $childPortfolioShare['amount']; ?></td>
			<td><?php echo $childPortfolioShare['rate']; ?></td>
			<td><?php echo $childPortfolioShare['transaction_time']; ?></td>
			<td><?php echo $childPortfolioShare['is_spot']; ?></td>
			<td><?php echo $childPortfolioShare['commission']; ?></td>
			<td><?php echo $childPortfolioShare['parent_id']; ?></td>
			<td><?php echo $childPortfolioShare['dse_order_id']; ?></td>
			<td><?php echo $childPortfolioShare['dse_execution_id']; ?></td>
			<td><?php echo $childPortfolioShare['omo_order_id']; ?></td>
			<td><?php echo $childPortfolioShare['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'portfolio_shares', 'action' => 'view', $childPortfolioShare['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'portfolio_shares', 'action' => 'edit', $childPortfolioShare['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'portfolio_shares', 'action' => 'delete', $childPortfolioShare['id']), array(), __('Are you sure you want to delete # %s?', $childPortfolioShare['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Portfolio Share'), array('controller' => 'portfolio_shares', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
