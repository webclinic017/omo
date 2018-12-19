<div class="userMetas form">
<?php echo $this->Form->create('UserMeta'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Meta'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserMeta.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('UserMeta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Metas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users Informations'), array('controller' => 'users_informations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Information'), array('controller' => 'users_informations', 'action' => 'add')); ?> </li>
	</ul>
</div>
