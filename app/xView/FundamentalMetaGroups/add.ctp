<div class="fundamentalMetaGroups form">
<?php echo $this->Form->create('FundamentalMetaGroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Fundamental Meta Group'); ?></legend>
	<?php
		echo $this->Form->input('group_key');
		echo $this->Form->input('group_description');
		echo $this->Form->input('group_created');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
