<div class="fundamentalMetas form">
<?php echo $this->Form->create('FundamentalMeta'); ?>
	<fieldset>
		<legend><?php echo __('Add Fundamental Meta'); ?></legend>
	<?php
		echo $this->Form->input('fundamental_meta_group_id');
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

		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('controller' => 'fundamental_meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('controller' => 'fundamental_meta_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamentals'), array('controller' => 'fundamentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental'), array('controller' => 'fundamentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
