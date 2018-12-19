<div class="marketStats form">
<?php echo $this->Form->create('MarketStat'); ?>
	<fieldset>
		<legend><?php echo __('Add Market Stat'); ?></legend>
	<?php
		echo $this->Form->input('market_id');
		echo $this->Form->input('market_meta_id');
		echo $this->Form->input('meta_value');
		echo $this->Form->input('meta_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Market Stats'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Metas'), array('controller' => 'market_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Meta'), array('controller' => 'market_metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
