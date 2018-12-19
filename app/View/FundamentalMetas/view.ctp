<div class="fundamentalMetas view">
<h2><?php echo __('Fundamental Meta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fundamentalMeta['FundamentalMeta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fundamental Meta Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($fundamentalMeta['FundamentalMetaGroup']['group_key'], array('controller' => 'fundamental_meta_groups', 'action' => 'view', $fundamentalMeta['FundamentalMetaGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Key'); ?></dt>
		<dd>
			<?php echo h($fundamentalMeta['FundamentalMeta']['meta_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Description'); ?></dt>
		<dd>
			<?php echo h($fundamentalMeta['FundamentalMeta']['meta_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Created'); ?></dt>
		<dd>
			<?php echo h($fundamentalMeta['FundamentalMeta']['meta_created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fundamental Meta'), array('action' => 'edit', $fundamentalMeta['FundamentalMeta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fundamental Meta'), array('action' => 'delete', $fundamentalMeta['FundamentalMeta']['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMeta['FundamentalMeta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('controller' => 'fundamental_meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('controller' => 'fundamental_meta_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamentals'), array('controller' => 'fundamentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental'), array('controller' => 'fundamentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Fundamentals'); ?></h3>
	<?php if (!empty($fundamentalMeta['Fundamental'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Fundamental Meta Id'); ?></th>
		<th><?php echo __('Meta Value'); ?></th>
		<th><?php echo __('Meta Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fundamentalMeta['Fundamental'] as $fundamental): ?>
		<tr>
			<td><?php echo $fundamental['id']; ?></td>
			<td><?php echo $fundamental['instrument_id']; ?></td>
			<td><?php echo $fundamental['fundamental_meta_id']; ?></td>
			<td><?php echo $fundamental['meta_value']; ?></td>
			<td><?php echo $fundamental['meta_date']; ?></td>
			<td><?php echo $fundamental['created']; ?></td>
			<td><?php echo $fundamental['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'fundamentals', 'action' => 'view', $fundamental['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'fundamentals', 'action' => 'edit', $fundamental['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fundamentals', 'action' => 'delete', $fundamental['id']), array(), __('Are you sure you want to delete # %s?', $fundamental['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fundamental'), array('controller' => 'fundamentals', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
