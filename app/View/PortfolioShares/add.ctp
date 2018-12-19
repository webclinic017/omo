<div class="portfolioShares form">
<?php echo $this->Form->create('PortfolioShare'); ?>
	<fieldset>
		<legend><?php echo __('Add Portfolio Share'); ?></legend>
	<?php
		echo $this->Form->input('portfolio_id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('transaction_type_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('rate');
		echo $this->Form->input('transaction_time');
		echo $this->Form->input('is_spot');
		echo $this->Form->input('commission');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('dse_order_id');
		echo $this->Form->input('dse_execution_id');
		echo $this->Form->input('omo_order_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Portfolio Shares'), array('action' => 'index')); ?></li>
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
