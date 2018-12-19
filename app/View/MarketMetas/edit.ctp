<div class="marketMetas form">
<?php echo $this->Form->create('MarketMeta'); ?>
	<fieldset>
		<legend><?php echo __('Edit Market Meta'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MarketMeta.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('MarketMeta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Market Metas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('controller' => 'market_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
