<div class="portfolios view">
<h2><?php echo __('Portfolio'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolio['User']['username'], array('controller' => 'users', 'action' => 'view', $portfolio['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio Value'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['portfolio_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cash Amount'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['cash_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio Name'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['portfolio_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Broker Fee'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['broker_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Broker'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['broker']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Alert'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['email_alert']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creation Date'); ?></dt>
		<dd>
			<?php echo h($portfolio['Portfolio']['creation_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Portfolio'), array('action' => 'edit', $portfolio['Portfolio']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Portfolio'), array('action' => 'delete', $portfolio['Portfolio']['id']), array(), __('Are you sure you want to delete # %s?', $portfolio['Portfolio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
