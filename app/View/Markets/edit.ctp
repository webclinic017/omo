<div class="markets form">
<?php echo $this->Form->create('Market'); ?>
	<fieldset>
		<legend><?php echo __('Edit Market'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('trade_date');
		echo $this->Form->input('is_trading_day');
		echo $this->Form->input('market_started');
		echo $this->Form->input('market_closed');
		echo $this->Form->input('comments');
		echo $this->Form->input('exchange_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Market.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Market.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Markets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Intradays'), array('controller' => 'data_banks_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Intraday'), array('controller' => 'data_banks_intradays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Index Values'), array('controller' => 'index_values', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Index Value'), array('controller' => 'index_values', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('controller' => 'market_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
