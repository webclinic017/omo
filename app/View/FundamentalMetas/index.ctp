<div class="fundamentalMetas index">
	<h2><?php echo __('Fundamental Metas'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('fundamental_meta_group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_key'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_description'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fundamentalMetas as $fundamentalMeta): ?>
	<tr>
		<td><?php echo h($fundamentalMeta['FundamentalMeta']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fundamentalMeta['FundamentalMetaGroup']['group_key'], array('controller' => 'fundamental_meta_groups', 'action' => 'view', $fundamentalMeta['FundamentalMetaGroup']['id'])); ?>
		</td>
		<td><?php echo h($fundamentalMeta['FundamentalMeta']['meta_key']); ?>&nbsp;</td>
		<td><?php echo h($fundamentalMeta['FundamentalMeta']['meta_description']); ?>&nbsp;</td>
		<td><?php echo h($fundamentalMeta['FundamentalMeta']['meta_created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fundamentalMeta['FundamentalMeta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fundamentalMeta['FundamentalMeta']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fundamentalMeta['FundamentalMeta']['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMeta['FundamentalMeta']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('controller' => 'fundamental_meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('controller' => 'fundamental_meta_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamentals'), array('controller' => 'fundamentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental'), array('controller' => 'fundamentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
