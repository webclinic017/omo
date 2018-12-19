<div class="portfolioTransactions view">
<h2><?php echo __('Portfolio Transaction'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($portfolioTransaction['PortfolioTransaction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioTransaction['Portfolio']['portfolio_name'], array('controller' => 'portfolios', 'action' => 'view', $portfolioTransaction['Portfolio']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioTransaction['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $portfolioTransaction['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioTransaction['TransactionType']['description'], array('controller' => 'transaction_types', 'action' => 'view', $portfolioTransaction['TransactionType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($portfolioTransaction['PortfolioTransaction']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($portfolioTransaction['PortfolioTransaction']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Time'); ?></dt>
		<dd>
			<?php echo h($portfolioTransaction['PortfolioTransaction']['transaction_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comission'); ?></dt>
		<dd>
			<?php echo h($portfolioTransaction['PortfolioTransaction']['comission']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Portfolio Transaction'), array('action' => 'edit', $portfolioTransaction['PortfolioTransaction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Portfolio Transaction'), array('action' => 'delete', $portfolioTransaction['PortfolioTransaction']['id']), array(), __('Are you sure you want to delete # %s?', $portfolioTransaction['PortfolioTransaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Transactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Transaction'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Types'), array('controller' => 'transaction_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Type'), array('controller' => 'transaction_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
