<div class="portfolioTransactions form">
<?php echo $this->Form->create('PortfolioTransaction'); ?>
	<fieldset>
		<legend><?php echo __('Add Portfolio Transaction'); ?></legend>
	<?php
		echo $this->Form->input('portfolio_id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('transaction_type_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('rate');
		echo $this->Form->input('transaction_time');
		echo $this->Form->input('comission');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Portfolio Transactions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Types'), array('controller' => 'transaction_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Type'), array('controller' => 'transaction_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
