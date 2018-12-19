<div class="userInformations index">
	<h2><?php echo __('User Informations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_value'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($userInformations as $userInformation): ?>
	<tr>
		<td><?php echo h($userInformation['UserInformation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userInformation['User']['username'], array('controller' => 'users', 'action' => 'view', $userInformation['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userInformation['Meta']['meta_key'], array('controller' => 'metas', 'action' => 'view', $userInformation['Meta']['id'])); ?>
		</td>
		<td><?php echo h($userInformation['UserInformation']['meta_value']); ?>&nbsp;</td>
		<td><?php echo h($userInformation['UserInformation']['created']); ?>&nbsp;</td>
		<td><?php echo h($userInformation['UserInformation']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userInformation['UserInformation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userInformation['UserInformation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userInformation['UserInformation']['id']), array(), __('Are you sure you want to delete # %s?', $userInformation['UserInformation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User Information'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
