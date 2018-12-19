<div class="portfolioShares form">
<?php echo $this->Form->create('PortfolioShare'); ?>
	<fieldset>
		<legend><?php echo __('Add Portfolio Share'); ?></legend>
	<?php
		echo $this->Form->input('portfolio_id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('no_of_shares');
		echo $this->Form->input('buying_price');
		echo $this->Form->input('buying_date');
		echo $this->Form->input('is_active');
		echo $this->Form->input('share_status');
		echo $this->Form->input('sell_price');
		echo $this->Form->input('sell_date');
		echo $this->Form->input('commission');
		echo $this->Form->input('exchange_id');
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
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
	</ul>
</div>
