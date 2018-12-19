<div class="marketMetas index">
	<h2><?php echo __('Market Metas'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_key'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_description'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($marketMetas as $marketMeta): ?>
	<tr>
		<td><?php echo h($marketMeta['MarketMeta']['id']); ?>&nbsp;</td>
		<td><?php echo h($marketMeta['MarketMeta']['meta_key']); ?>&nbsp;</td>
		<td><?php echo h($marketMeta['MarketMeta']['meta_description']); ?>&nbsp;</td>
		<td><?php echo h($marketMeta['MarketMeta']['meta_created']); ?>&nbsp;</td>
		<td><?php echo h($marketMeta['MarketMeta']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $marketMeta['MarketMeta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $marketMeta['MarketMeta']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $marketMeta['MarketMeta']['id']), array(), __('Are you sure you want to delete # %s?', $marketMeta['MarketMeta']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Market Meta'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('controller' => 'market_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
