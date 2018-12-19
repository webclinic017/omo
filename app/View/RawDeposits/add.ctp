<div class="rawDeposits form">
<?php echo $this->Form->create('RawDeposit'); ?>
	<fieldset>
		<legend><?php echo __('Add Raw Deposit'); ?></legend>
	<?php
		echo $this->Form->input('client_code');
		echo $this->Form->input('name');
		echo $this->Form->input('ref');
		echo $this->Form->input('mop');
		echo $this->Form->input('bank_name');
		echo $this->Form->input('branch_name');
		echo $this->Form->input('cheque_no');
		echo $this->Form->input('amount');
		echo $this->Form->input('portfolio_transaction_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Raw Deposits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Portfolio Transactions'), array('controller' => 'portfolio_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Transaction'), array('controller' => 'portfolio_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
