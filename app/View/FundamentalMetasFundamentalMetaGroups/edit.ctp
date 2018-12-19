<div class="fundamentalMetasFundamentalMetaGroups form">
<?php echo $this->Form->create('FundamentalMetasFundamentalMetaGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Fundamental Metas Fundamental Meta Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fundamental_meta_id');
		echo $this->Form->input('fundamental_meta_group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FundamentalMetasFundamentalMetaGroup.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('FundamentalMetasFundamentalMetaGroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas Fundamental Meta Groups'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('controller' => 'fundamental_meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('controller' => 'fundamental_meta_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
