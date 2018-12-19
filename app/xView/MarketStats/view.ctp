<div class="marketStats view">
<h2><?php echo __('Market Stat'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($marketStat['MarketStat']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market'); ?></dt>
		<dd>
			<?php echo $this->Html->link($marketStat['Market']['id'], array('controller' => 'markets', 'action' => 'view', $marketStat['Market']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Meta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($marketStat['MarketMeta']['meta_key'], array('controller' => 'market_metas', 'action' => 'view', $marketStat['MarketMeta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Value'); ?></dt>
		<dd>
			<?php echo h($marketStat['MarketStat']['meta_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Date'); ?></dt>
		<dd>
			<?php echo h($marketStat['MarketStat']['meta_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($marketStat['MarketStat']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($marketStat['MarketStat']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Market Stat'), array('action' => 'edit', $marketStat['MarketStat']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Market Stat'), array('action' => 'delete', $marketStat['MarketStat']['id']), array(), __('Are you sure you want to delete # %s?', $marketStat['MarketStat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Metas'), array('controller' => 'market_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Meta'), array('controller' => 'market_metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
