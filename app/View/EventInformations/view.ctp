<div class="eventInformations view">
<h2><?php echo __('Event Information'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventInformation['EventInformation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventInformation['Event']['event_title'], array('controller' => 'events', 'action' => 'view', $eventInformation['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventInformation['Meta']['meta_key'], array('controller' => 'metas', 'action' => 'view', $eventInformation['Meta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Value'); ?></dt>
		<dd>
			<?php echo h($eventInformation['EventInformation']['meta_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($eventInformation['EventInformation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($eventInformation['EventInformation']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event Information'), array('action' => 'edit', $eventInformation['EventInformation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event Information'), array('action' => 'delete', $eventInformation['EventInformation']['id']), array(), __('Are you sure you want to delete # %s?', $eventInformation['EventInformation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Informations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Information'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
