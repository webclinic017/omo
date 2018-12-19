<div class="rawTradins form">
<?php echo $this->Form->create('RawTradin'); ?>
	<fieldset>
		<legend><?php echo __('Add Raw Tradin'); ?></legend>
	<?php
		echo $this->Form->input('dealer_id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('instrument_code');
		echo $this->Form->input('board');
		echo $this->Form->input('execute_time');
		echo $this->Form->input('execute_qty');
		echo $this->Form->input('price');
		echo $this->Form->input('oredr_id');
		echo $this->Form->input('execution_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Raw Tradins'), array('action' => 'index')); ?></li>
	</ul>
</div>
