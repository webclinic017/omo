<div class="newsMetas form">
<?php echo $this->Form->create('NewsMeta'); ?>
	<fieldset>
		<legend><?php echo __('Edit News Meta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('news_id');
		echo $this->Form->input('meta_key');
		echo $this->Form->input('meta_value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('NewsMeta.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('NewsMeta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List News Metas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List News'), array('controller' => 'news', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('controller' => 'news', 'action' => 'add')); ?> </li>
	</ul>
</div>
