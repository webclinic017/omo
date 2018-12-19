<div class="dataBanksEods form">
<?php echo $this->Form->create('DataBanksEod'); ?>
	<fieldset>
		<legend><?php echo __('Add Data Banks Eod'); ?></legend>
	<?php
		echo $this->Form->input('market_id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('open');
		echo $this->Form->input('high');
		echo $this->Form->input('low');
		echo $this->Form->input('close');
		echo $this->Form->input('adj_close');
		echo $this->Form->input('volume');
		echo $this->Form->input('trade');
		echo $this->Form->input('tradevalues');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Data Banks Eods'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
