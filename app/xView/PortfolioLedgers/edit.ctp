<div class="portfolioLedgers form">
<?php echo $this->Form->create('PortfolioLedger'); ?>
	<fieldset>
		<legend><?php echo __('Edit Portfolio Ledger'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('portfolio_id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('transaction_type_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('rate');
		echo $this->Form->input('transaction_time');
		echo $this->Form->input('commission');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PortfolioLedger.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('PortfolioLedger.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolio Ledgers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Types'), array('controller' => 'transaction_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Type'), array('controller' => 'transaction_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
