<div class="fundamentalMetasFundamentalMetaGroups index">
	<h2><?php echo __('Fundamental Metas Fundamental Meta Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('fundamental_meta_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fundamental_meta_group_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fundamentalMetasFundamentalMetaGroups as $fundamentalMetasFundamentalMetaGroup): ?>
	<tr>
		<td><?php echo h($fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fundamentalMetasFundamentalMetaGroup['FundamentalMeta']['meta_key'], array('controller' => 'fundamental_metas', 'action' => 'view', $fundamentalMetasFundamentalMetaGroup['FundamentalMeta']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fundamentalMetasFundamentalMetaGroup['FundamentalMetaGroup']['group_key'], array('controller' => 'fundamental_meta_groups', 'action' => 'view', $fundamentalMetasFundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fundamental Metas Fundamental Meta Group'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('controller' => 'fundamental_meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('controller' => 'fundamental_meta_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
