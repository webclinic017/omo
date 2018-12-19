<div class="metaGroups index">
	<h2><?php echo __('Meta Groups'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_key'); ?></th>
			<th><?php echo $this->Paginator->sort('group_description'); ?></th>
			<th><?php echo $this->Paginator->sort('group_created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($metaGroups as $metaGroup): ?>
	<tr>
		<td><?php echo h($metaGroup['MetaGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($metaGroup['MetaGroup']['group_key']); ?>&nbsp;</td>
		<td><?php echo h($metaGroup['MetaGroup']['group_description']); ?>&nbsp;</td>
		<td><?php echo h($metaGroup['MetaGroup']['group_created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $metaGroup['MetaGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $metaGroup['MetaGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $metaGroup['MetaGroup']['id']), array(), __('Are you sure you want to delete # %s?', $metaGroup['MetaGroup']['id'])); ?>
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
        echo $this->Paginator->prev('< ' . __('previous  '), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ' | '));
        echo $this->Paginator->next(__('  next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Meta Group'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
