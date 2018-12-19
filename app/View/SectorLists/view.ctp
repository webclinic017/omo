<div class="sectorLists view">
<h2><?php echo __('Sector List'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sectorList['SectorList']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sectorList['SectorList']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($sectorList['SectorList']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dse Sector Id'); ?></dt>
		<dd>
			<?php echo h($sectorList['SectorList']['dse_sector_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sectorList['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $sectorList['Exchange']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sector List'), array('action' => 'edit', $sectorList['SectorList']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sector List'), array('action' => 'delete', $sectorList['SectorList']['id']), array(), __('Are you sure you want to delete # %s?', $sectorList['SectorList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Lists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector List'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sector Intradays'), array('controller' => 'sector_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector Intraday'), array('controller' => 'sector_intradays', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Instruments'); ?></h3>
	<?php if (!empty($sectorList['Instrument'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Exchange Id'); ?></th>
		<th><?php echo __('Sector List Id'); ?></th>
		<th><?php echo __('Instrument Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sectorList['Instrument'] as $instrument): ?>
		<tr>
			<td><?php echo $instrument['id']; ?></td>
			<td><?php echo $instrument['exchange_id']; ?></td>
			<td><?php echo $instrument['sector_list_id']; ?></td>
			<td><?php echo $instrument['instrument_code']; ?></td>
			<td><?php echo $instrument['name']; ?></td>
			<td><?php echo $instrument['active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'instruments', 'action' => 'view', $instrument['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'instruments', 'action' => 'edit', $instrument['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'instruments', 'action' => 'delete', $instrument['id']), array(), __('Are you sure you want to delete # %s?', $instrument['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sector Intradays'); ?></h3>
	<?php if (!empty($sectorList['SectorIntraday'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Sector List Id'); ?></th>
		<th><?php echo __('Index Change'); ?></th>
		<th><?php echo __('Index Change Per'); ?></th>
		<th><?php echo __('Price Change'); ?></th>
		<th><?php echo __('Volume'); ?></th>
		<th><?php echo __('Contribution'); ?></th>
		<th><?php echo __('Index Date'); ?></th>
		<th><?php echo __('Index Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sectorList['SectorIntraday'] as $sectorIntraday): ?>
		<tr>
			<td><?php echo $sectorIntraday['id']; ?></td>
			<td><?php echo $sectorIntraday['market_id']; ?></td>
			<td><?php echo $sectorIntraday['sector_list_id']; ?></td>
			<td><?php echo $sectorIntraday['index_change']; ?></td>
			<td><?php echo $sectorIntraday['index_change_per']; ?></td>
			<td><?php echo $sectorIntraday['price_change']; ?></td>
			<td><?php echo $sectorIntraday['volume']; ?></td>
			<td><?php echo $sectorIntraday['contribution']; ?></td>
			<td><?php echo $sectorIntraday['index_date']; ?></td>
			<td><?php echo $sectorIntraday['index_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sector_intradays', 'action' => 'view', $sectorIntraday['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sector_intradays', 'action' => 'edit', $sectorIntraday['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sector_intradays', 'action' => 'delete', $sectorIntraday['id']), array(), __('Are you sure you want to delete # %s?', $sectorIntraday['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sector Intraday'), array('controller' => 'sector_intradays', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
