<div class="rawDeposits view">
<h2><?php echo __('Raw Deposit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Code'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['client_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ref'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['ref']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mop'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['mop']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Name'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['bank_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Branch Name'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['branch_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cheque No'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['cheque_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($rawDeposit['RawDeposit']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio Transaction'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rawDeposit['PortfolioTransaction']['portfolio_id'], array('controller' => 'portfolio_transactions', 'action' => 'view', $rawDeposit['PortfolioTransaction']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Raw Deposit'), array('action' => 'edit', $rawDeposit['RawDeposit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Raw Deposit'), array('action' => 'delete', $rawDeposit['RawDeposit']['id']), array(), __('Are you sure you want to delete # %s?', $rawDeposit['RawDeposit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Raw Deposits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Raw Deposit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Transactions'), array('controller' => 'portfolio_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Transaction'), array('controller' => 'portfolio_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
