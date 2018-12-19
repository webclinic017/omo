<div class="sectors form">
<?php echo $this->Form->create('Sector'); ?>
	<fieldset>
		<legend><?php echo __('Add Sector'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('full_name');
		echo $this->Form->input('dse_sector_id');
		echo $this->Form->input('exchange_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sectors'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Intradays'), array('controller' => 'sector_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector Intraday'), array('controller' => 'sector_intradays', 'action' => 'add')); ?> </li>
	</ul>
</div>
