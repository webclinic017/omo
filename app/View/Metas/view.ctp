<div class="metas view">
<h2><?php echo __('Meta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($meta['Meta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($meta['MetaGroup']['group_key'], array('controller' => 'meta_groups', 'action' => 'view', $meta['MetaGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Key'); ?></dt>
		<dd>
			<?php echo h($meta['Meta']['meta_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Description'); ?></dt>
		<dd>
			<?php echo h($meta['Meta']['meta_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Created'); ?></dt>
		<dd>
			<?php echo h($meta['Meta']['meta_created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Meta'), array('action' => 'edit', $meta['Meta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Meta'), array('action' => 'delete', $meta['Meta']['id']), array(), __('Are you sure you want to delete # %s?', $meta['Meta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Meta Groups'), array('controller' => 'meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta Group'), array('controller' => 'meta_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Informations'), array('controller' => 'event_informations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Information'), array('controller' => 'event_informations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Event Informations'); ?></h3>
	<?php if (!empty($meta['EventInformation'])): ?>
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
	<?php foreach ($meta['EventInformation'] as $eventInformation): ?>
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
