<div class="sectorIntradays form">
<?php echo $this->Form->create('SectorIntraday'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sector Intraday'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('market_id');
		echo $this->Form->input('sector_list_id');
		echo $this->Form->input('index_change');
		echo $this->Form->input('index_change_per');
		echo $this->Form->input('price_change');
		echo $this->Form->input('volume');
		echo $this->Form->input('contribution');
		echo $this->Form->input('index_date');
		echo $this->Form->input('index_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SectorIntraday.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SectorIntraday.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sector Intradays'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Lists'), array('controller' => 'sector_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector List'), array('controller' => 'sector_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
