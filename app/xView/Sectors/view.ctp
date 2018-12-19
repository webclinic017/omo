<div class="sectors view">
<h2><?php echo __('Sector'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dse Sector Id'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['dse_sector_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sector['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $sector['Exchange']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sector'), array('action' => 'edit', $sector['Sector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sector'), array('action' => 'delete', $sector['Sector']['id']), array(), __('Are you sure you want to delete # %s?', $sector['Sector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('action' => 'add')); ?> </li>
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
	<?php if (!empty($sector['Instrument'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Exchange Id'); ?></th>
		<th><?php echo __('Sector Id'); ?></th>
		<th><?php echo __('Instrument Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sector['Instrument'] as $instrument): ?>
		<tr>
			<td><?php echo $instrument['id']; ?></td>
			<td><?php echo $instrument['exchange_id']; ?></td>
			<td><?php echo $instrument['sector_id']; ?></td>
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
	<?php if (!empty($sector['SectorIntraday'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sector Id'); ?></th>
		<th><?php echo __('Index Change'); ?></th>
		<th><?php echo __('Index Change Per'); ?></th>
		<th><?php echo __('Price Change'); ?></th>
		<th><?php echo __('Contribution'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th><?php echo __('Volume'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sector['SectorIntraday'] as $sectorIntraday): ?>
		<tr>
			<td><?php echo $sectorIntraday['id']; ?></td>
			<td><?php echo $sectorIntraday['sector_id']; ?></td>
			<td><?php echo $sectorIntraday['index_change']; ?></td>
			<td><?php echo $sectorIntraday['index_change_per']; ?></td>
			<td><?php echo $sectorIntraday['price_change']; ?></td>
			<td><?php echo $sectorIntraday['contribution']; ?></td>
			<td><?php echo $sectorIntraday['date_time']; ?></td>
			<td><?php echo $sectorIntraday['volume']; ?></td>
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
