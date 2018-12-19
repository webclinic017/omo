<div class="applications index">
	<h2><?php echo __('Applications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('apps_code'); ?></th>
			<th><?php echo $this->Paginator->sort('apps_name'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('developed_on'); ?></th>
			<th><?php echo $this->Paginator->sort('dependency'); ?></th>
			<th><?php echo $this->Paginator->sort('input'); ?></th>
			<th><?php echo $this->Paginator->sort('output'); ?></th>
			<th><?php echo $this->Paginator->sort('manager'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($applications as $application): ?>
	<tr>
		<td><?php echo h($application['Application']['id']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['apps_code']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['apps_name']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['active']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['developed_on']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['dependency']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['input']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['output']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['manager']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $application['Application']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $application['Application']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $application['Application']['id']), null, __('Are you sure you want to delete # %s?', $application['Application']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Application'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Feedbacks'), array('controller' => 'feedbacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback'), array('controller' => 'feedbacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
