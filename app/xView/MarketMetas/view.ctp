<div class="marketMetas view">
<h2><?php echo __('Market Meta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($marketMeta['MarketMeta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Key'); ?></dt>
		<dd>
			<?php echo h($marketMeta['MarketMeta']['meta_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Description'); ?></dt>
		<dd>
			<?php echo h($marketMeta['MarketMeta']['meta_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Created'); ?></dt>
		<dd>
			<?php echo h($marketMeta['MarketMeta']['meta_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($marketMeta['MarketMeta']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Market Meta'), array('action' => 'edit', $marketMeta['MarketMeta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Market Meta'), array('action' => 'delete', $marketMeta['MarketMeta']['id']), array(), __('Are you sure you want to delete # %s?', $marketMeta['MarketMeta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Metas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Meta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('controller' => 'market_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Market Stats'); ?></h3>
	<?php if (!empty($marketMeta['MarketStat'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Market Meta Id'); ?></th>
		<th><?php echo __('Meta Value'); ?></th>
		<th><?php echo __('Meta Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($marketMeta['MarketStat'] as $marketStat): ?>
		<tr>
			<td><?php echo $marketStat['id']; ?></td>
			<td><?php echo $marketStat['market_id']; ?></td>
			<td><?php echo $marketStat['market_meta_id']; ?></td>
			<td><?php echo $marketStat['meta_value']; ?></td>
			<td><?php echo $marketStat['meta_date']; ?></td>
			<td><?php echo $marketStat['created']; ?></td>
			<td><?php echo $marketStat['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'market_stats', 'action' => 'view', $marketStat['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'market_stats', 'action' => 'edit', $marketStat['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'market_stats', 'action' => 'delete', $marketStat['id']), array(), __('Are you sure you want to delete # %s?', $marketStat['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
