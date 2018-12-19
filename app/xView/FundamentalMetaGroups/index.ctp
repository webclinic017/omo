<div class="fundamentalMetaGroups index">
	<h2><?php echo __('Fundamental Meta Groups'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_key'); ?></th>
			<th><?php echo $this->Paginator->sort('group_description'); ?></th>
			<th><?php echo $this->Paginator->sort('group_created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fundamentalMetaGroups as $fundamentalMetaGroup): ?>
	<tr>
		<td><?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['group_key']); ?>&nbsp;</td>
		<td><?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['group_description']); ?>&nbsp;</td>
		<td><?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['group_created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fundamentalMetaGroup['FundamentalMetaGroup']['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
