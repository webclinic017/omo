<div class="metas form">
<?php echo $this->Form->create('Meta'); ?>
	<fieldset>
		<legend><?php echo __('Add Meta'); ?></legend>
	<?php
		echo $this->Form->input('meta_group_id');
		echo $this->Form->input('meta_key');
		echo $this->Form->input('meta_description');
		echo $this->Form->input('meta_created');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Metas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Meta Groups'), array('controller' => 'meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta Group'), array('controller' => 'meta_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Informations'), array('controller' => 'event_informations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Information'), array('controller' => 'event_informations', 'action' => 'add')); ?> </li>
	</ul>
</div>
