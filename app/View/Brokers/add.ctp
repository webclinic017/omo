<div class="brokers form">
<?php echo $this->Form->create('Broker'); ?>
	<fieldset>
		<legend><?php echo __('Add Broker'); ?></legend>
	<?php
		echo $this->Form->input('broker_name');
		echo $this->Form->input('member_id');
		echo $this->Form->input('address');
		echo $this->Form->input('mob');
		echo $this->Form->input('broker_user_id');
		echo $this->Form->input('broker_password');
		echo $this->Form->input('registration_date');
		echo $this->Form->input('last_login_time');
		echo $this->Form->input('allow_IP');
		echo $this->Form->input('accept_order');
		echo $this->Form->input('message_for_user');
		echo $this->Form->input('show_user_msg');
		echo $this->Form->input('default_commision');
		echo $this->Form->input('is_ip_check');
		echo $this->Form->input('is_freeshare_check');
		echo $this->Form->input('terminal1');
		echo $this->Form->input('terminal2');
		echo $this->Form->input('totalorderTerminal1');
		echo $this->Form->input('totalorderTerminal2');
		echo $this->Form->input('allow_day_trading');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Brokers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
