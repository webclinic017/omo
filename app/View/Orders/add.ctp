<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Add Order'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('order_type');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('no_of_shares');
		echo $this->Form->input('price_type');
		echo $this->Form->input('order_ref_no');
		echo $this->Form->input('final_price');
		echo $this->Form->input('buy_start_range');
		echo $this->Form->input('buy_end_range');
		echo $this->Form->input('order_place_time');
		echo $this->Form->input('order_status');
		echo $this->Form->input('last_update');
		echo $this->Form->input('cancel_status');
		echo $this->Form->input('market_order_status');
		echo $this->Form->input('drip_quantity');
		echo $this->Form->input('terminal');
		echo $this->Form->input('totalorderTerminal1');
		echo $this->Form->input('totalorderTerminal2');
		echo $this->Form->input('order_by_mobile');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
