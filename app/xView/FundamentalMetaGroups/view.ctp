<div class="fundamentalMetaGroups view">
<h2><?php echo __('Fundamental Meta Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Key'); ?></dt>
		<dd>
			<?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['group_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Description'); ?></dt>
		<dd>
			<?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['group_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Created'); ?></dt>
		<dd>
			<?php echo h($fundamentalMetaGroup['FundamentalMetaGroup']['group_created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fundamental Meta Group'), array('action' => 'edit', $fundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fundamental Meta Group'), array('action' => 'delete', $fundamentalMetaGroup['FundamentalMetaGroup']['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Fundamental Metas'); ?></h3>
	<?php if (!empty($fundamentalMetaGroup['FundamentalMeta'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Fundamental Meta Group Id'); ?></th>
		<th><?php echo __('Meta Key'); ?></th>
		<th><?php echo __('Meta Description'); ?></th>
		<th><?php echo __('Meta Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fundamentalMetaGroup['FundamentalMeta'] as $fundamentalMeta): ?>
		<tr>
			<td><?php echo $fundamentalMeta['id']; ?></td>
			<td><?php echo $fundamentalMeta['fundamental_meta_group_id']; ?></td>
			<td><?php echo $fundamentalMeta['meta_key']; ?></td>
			<td><?php echo $fundamentalMeta['meta_description']; ?></td>
			<td><?php echo $fundamentalMeta['meta_created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'fundamental_metas', 'action' => 'view', $fundamentalMeta['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'fundamental_metas', 'action' => 'edit', $fundamentalMeta['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fundamental_metas', 'action' => 'delete', $fundamentalMeta['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMeta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
