<div class="corporateActions form">
<?php echo $this->Form->create('CorporateAction'); ?>
	<fieldset>
		<legend><?php echo __('Add Corporate Action'); ?></legend>
	<?php
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('action');
		echo $this->Form->input('value');
		echo $this->Form->input('premium');
		echo $this->Form->input('record_date');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Corporate Actions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
