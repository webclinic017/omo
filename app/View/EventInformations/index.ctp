<div class="eventInformations index">
	<h2><?php echo __('Event Informations'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_value'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($eventInformations as $eventInformation): ?>
	<tr>
		<td><?php echo h($eventInformation['EventInformation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($eventInformation['Event']['event_title'], array('controller' => 'events', 'action' => 'view', $eventInformation['Event']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($eventInformation['Meta']['meta_key'], array('controller' => 'metas', 'action' => 'view', $eventInformation['Meta']['id'])); ?>
		</td>
		<td><?php echo h($eventInformation['EventInformation']['meta_value']); ?>&nbsp;</td>
		<td><?php echo h($eventInformation['EventInformation']['created']); ?>&nbsp;</td>
		<td><?php echo h($eventInformation['EventInformation']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $eventInformation['EventInformation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $eventInformation['EventInformation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $eventInformation['EventInformation']['id']), array(), __('Are you sure you want to delete # %s?', $eventInformation['EventInformation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Event Information'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
