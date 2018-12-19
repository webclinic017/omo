<div class="news index">
	<h2><?php echo __('News'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('details'); ?></th>
			<th><?php echo $this->Paginator->sort('post_date'); ?></th>
			<th><?php echo $this->Paginator->sort('expire_date'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($news as $news): ?>
	<tr>
		<td><?php echo h($news['News']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($news['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $news['Instrument']['id'])); ?>
		</td>
		<td><?php echo h($news['News']['title']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['details']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['post_date']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['expire_date']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['is_active']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $news['News']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $news['News']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $news['News']['id']), array(), __('Are you sure you want to delete # %s?', $news['News']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
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
		<li><?php echo $this->Html->link(__('New News'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
