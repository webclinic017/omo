<div class="metas index">
	<h2><?php echo __('Metas'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_key'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_description'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($metas as $meta): ?>
	<tr>
		<td><?php echo h($meta['Meta']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($meta['MetaGroup']['group_key'], array('controller' => 'meta_groups', 'action' => 'view', $meta['MetaGroup']['id'])); ?>
		</td>
		<td><?php echo h($meta['Meta']['meta_key']); ?>&nbsp;</td>
		<td><?php echo h($meta['Meta']['meta_description']); ?>&nbsp;</td>
		<td><?php echo h($meta['Meta']['meta_created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $meta['Meta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $meta['Meta']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $meta['Meta']['id']), array(), __('Are you sure you want to delete # %s?', $meta['Meta']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Meta'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Meta Groups'), array('controller' => 'meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta Group'), array('controller' => 'meta_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Informations'), array('controller' => 'event_informations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Information'), array('controller' => 'event_informations', 'action' => 'add')); ?> </li>
	</ul>
</div>
