<div class="metaGroups view">
<h2><?php echo __('Meta Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($metaGroup['MetaGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Key'); ?></dt>
		<dd>
			<?php echo h($metaGroup['MetaGroup']['group_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Description'); ?></dt>
		<dd>
			<?php echo h($metaGroup['MetaGroup']['group_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Created'); ?></dt>
		<dd>
			<?php echo h($metaGroup['MetaGroup']['group_created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Meta Group'), array('action' => 'edit', $metaGroup['MetaGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Meta Group'), array('action' => 'delete', $metaGroup['MetaGroup']['id']), array(), __('Are you sure you want to delete # %s?', $metaGroup['MetaGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Meta Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Metas'); ?></h3>
	<?php if (!empty($metaGroup['Meta'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Meta Group Id'); ?></th>
		<th><?php echo __('Meta Key'); ?></th>
		<th><?php echo __('Meta Description'); ?></th>
		<th><?php echo __('Meta Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($metaGroup['Meta'] as $meta): ?>
		<tr>
			<td><?php echo $meta['id']; ?></td>
			<td><?php echo $meta['meta_group_id']; ?></td>
			<td><?php echo $meta['meta_key']; ?></td>
			<td><?php echo $meta['meta_description']; ?></td>
			<td><?php echo $meta['meta_created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'metas', 'action' => 'view', $meta['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'metas', 'action' => 'edit', $meta['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'metas', 'action' => 'delete', $meta['id']), array(), __('Are you sure you want to delete # %s?', $meta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
