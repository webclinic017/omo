<div class="applications form">
<?php echo $this->Form->create('Application'); ?>
	<fieldset>
		<legend><?php echo __('Edit Application'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('apps_code');
		echo $this->Form->input('apps_name');
		echo $this->Form->input('active');
		echo $this->Form->input('developed_on');
		echo $this->Form->input('dependency');
		echo $this->Form->input('input');
		echo $this->Form->input('output');
		echo $this->Form->input('manager');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Application.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Application.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Feedbacks'), array('controller' => 'feedbacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback'), array('controller' => 'feedbacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
