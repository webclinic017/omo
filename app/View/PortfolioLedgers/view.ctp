<div class="portfolioLedgers view">
<h2><?php echo __('Portfolio Ledger'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($portfolioLedger['PortfolioLedger']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioLedger['Portfolio']['portfolio_name'], array('controller' => 'portfolios', 'action' => 'view', $portfolioLedger['Portfolio']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioLedger['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $portfolioLedger['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioLedger['TransactionType']['description'], array('controller' => 'transaction_types', 'action' => 'view', $portfolioLedger['TransactionType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($portfolioLedger['PortfolioLedger']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($portfolioLedger['PortfolioLedger']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Time'); ?></dt>
		<dd>
			<?php echo h($portfolioLedger['PortfolioLedger']['transaction_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission'); ?></dt>
		<dd>
			<?php echo h($portfolioLedger['PortfolioLedger']['commission']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Portfolio Ledger'), array('action' => 'edit', $portfolioLedger['PortfolioLedger']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Portfolio Ledger'), array('action' => 'delete', $portfolioLedger['PortfolioLedger']['id']), array(), __('Are you sure you want to delete # %s?', $portfolioLedger['PortfolioLedger']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Ledgers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Ledger'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Types'), array('controller' => 'transaction_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Type'), array('controller' => 'transaction_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
