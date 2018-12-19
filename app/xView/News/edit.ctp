<div class="news form">
<?php echo $this->Form->create('News'); ?>
	<fieldset>
		<legend><?php echo __('Edit News'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('instrument_id');
		echo $this->Form->input('title');
		echo $this->Form->input('details');
		echo $this->Form->input('post_date');
		echo $this->Form->input('expire_date');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('News.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('News.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List News'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
