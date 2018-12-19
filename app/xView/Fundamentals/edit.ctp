<div class="fundamentals form">
<?php echo $this->Form->create('Fundamental'); ?>
	<fieldset>
		<legend><?php echo __('Edit Fundamental'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('meta_id');
		echo $this->Form->input('meta_value');
		echo $this->Form->input('meta_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Fundamental.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Fundamental.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamentals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
