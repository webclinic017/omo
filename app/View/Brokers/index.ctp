<div class="brokers index">
	<h2><?php echo __('Brokers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('broker_name'); ?></th>
			<th><?php echo $this->Paginator->sort('member_id'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('mob'); ?></th>
			<th><?php echo $this->Paginator->sort('broker_user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('broker_password'); ?></th>
			<th><?php echo $this->Paginator->sort('registration_date'); ?></th>
			<th><?php echo $this->Paginator->sort('last_login_time'); ?></th>
			<th><?php echo $this->Paginator->sort('allow_IP'); ?></th>
			<th><?php echo $this->Paginator->sort('accept_order'); ?></th>
			<th><?php echo $this->Paginator->sort('message_for_user'); ?></th>
			<th><?php echo $this->Paginator->sort('show_user_msg'); ?></th>
			<th><?php echo $this->Paginator->sort('default_commision'); ?></th>
			<th><?php echo $this->Paginator->sort('is_ip_check'); ?></th>
			<th><?php echo $this->Paginator->sort('is_freeshare_check'); ?></th>
			<th><?php echo $this->Paginator->sort('terminal1'); ?></th>
			<th><?php echo $this->Paginator->sort('terminal2'); ?></th>
			<th><?php echo $this->Paginator->sort('totalorderTerminal1'); ?></th>
			<th><?php echo $this->Paginator->sort('totalorderTerminal2'); ?></th>
			<th><?php echo $this->Paginator->sort('allow_day_trading'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($brokers as $broker): ?>
	<tr>
		<td><?php echo h($broker['Broker']['id']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['broker_name']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['member_id']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['address']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['mob']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['broker_user_id']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['broker_password']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['registration_date']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['last_login_time']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['allow_IP']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['accept_order']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['message_for_user']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['show_user_msg']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['default_commision']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['is_ip_check']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['is_freeshare_check']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['terminal1']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['terminal2']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['totalorderTerminal1']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['totalorderTerminal2']); ?>&nbsp;</td>
		<td><?php echo h($broker['Broker']['allow_day_trading']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $broker['Broker']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $broker['Broker']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $broker['Broker']['id']), array(), __('Are you sure you want to delete # %s?', $broker['Broker']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Broker'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
