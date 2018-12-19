<div class="rawWithdraws view">
<h2><?php echo __('Raw Withdraw'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Code'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['client_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ref'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['ref']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mop'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['mop']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bank Name'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['bank_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Branch Name'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['branch_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cheque No'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['cheque_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($rawWithdraw['RawWithdraw']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio Transaction'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rawWithdraw['PortfolioTransaction']['portfolio_id'], array('controller' => 'portfolio_transactions', 'action' => 'view', $rawWithdraw['PortfolioTransaction']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Raw Withdraw'), array('action' => 'edit', $rawWithdraw['RawWithdraw']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Raw Withdraw'), array('action' => 'delete', $rawWithdraw['RawWithdraw']['id']), array(), __('Are you sure you want to delete # %s?', $rawWithdraw['RawWithdraw']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Raw Withdraws'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Raw Withdraw'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Transactions'), array('controller' => 'portfolio_transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Transaction'), array('controller' => 'portfolio_transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
