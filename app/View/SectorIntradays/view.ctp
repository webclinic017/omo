<div class="sectorIntradays view">
<h2><?php echo __('Sector Intraday'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sectorIntraday['Market']['id'], array('controller' => 'markets', 'action' => 'view', $sectorIntraday['Market']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sectorIntraday['SectorList']['name'], array('controller' => 'sector_lists', 'action' => 'view', $sectorIntraday['SectorList']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Index Change'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['index_change']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Index Change Per'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['index_change_per']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price Change'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['price_change']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contribution'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['contribution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Index Date'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['index_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Index Time'); ?></dt>
		<dd>
			<?php echo h($sectorIntraday['SectorIntraday']['index_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sector Intraday'), array('action' => 'edit', $sectorIntraday['SectorIntraday']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sector Intraday'), array('action' => 'delete', $sectorIntraday['SectorIntraday']['id']), array(), __('Are you sure you want to delete # %s?', $sectorIntraday['SectorIntraday']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Intradays'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector Intraday'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Lists'), array('controller' => 'sector_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector List'), array('controller' => 'sector_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
