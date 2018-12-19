<div class="events view">
<h2><?php echo __('Event'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $event['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Title'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Date'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event'), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event'), array('action' => 'delete', $event['Event']['id']), array(), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Informations'), array('controller' => 'event_informations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Information'), array('controller' => 'event_informations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Event Informations'); ?></h3>
	<?php if (!empty($event['EventInformation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('Meta Id'); ?></th>
		<th><?php echo __('Meta Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($event['EventInformation'] as $eventInformation): ?>
		<tr>
			<td><?php echo $eventInformation['id']; ?></td>
			<td><?php echo $eventInformation['event_id']; ?></td>
			<td><?php echo $eventInformation['meta_id']; ?></td>
			<td><?php echo $eventInformation['meta_value']; ?></td>
			<td><?php echo $eventInformation['created']; ?></td>
			<td><?php echo $eventInformation['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'event_informations', 'action' => 'view', $eventInformation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'event_informations', 'action' => 'edit', $eventInformation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'event_informations', 'action' => 'delete', $eventInformation['id']), array(), __('Are you sure you want to delete # %s?', $eventInformation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event Information'), array('controller' => 'event_informations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
