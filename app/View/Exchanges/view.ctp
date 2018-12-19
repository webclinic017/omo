<div class="exchanges view">
<h2><?php echo __('Exchange'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($exchange['Exchange']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($exchange['Exchange']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($exchange['Exchange']['full_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Exchange'), array('action' => 'edit', $exchange['Exchange']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Exchange'), array('action' => 'delete', $exchange['Exchange']['id']), array(), __('Are you sure you want to delete # %s?', $exchange['Exchange']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Instruments'); ?></h3>
	<?php if (!empty($exchange['Instrument'])): ?>
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
	<?php foreach ($exchange['Instrument'] as $instrument): ?>
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
	<h3><?php echo __('Related Markets'); ?></h3>
	<?php if (!empty($exchange['Market'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Trade Date'); ?></th>
		<th><?php echo __('Is Trading Day'); ?></th>
		<th><?php echo __('Market Started'); ?></th>
		<th><?php echo __('Market Closed'); ?></th>
		<th><?php echo __('Comments'); ?></th>
		<th><?php echo __('Exchange Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($exchange['Market'] as $market): ?>
		<tr>
			<td><?php echo $market['id']; ?></td>
			<td><?php echo $market['trade_date']; ?></td>
			<td><?php echo $market['is_trading_day']; ?></td>
			<td><?php echo $market['market_started']; ?></td>
			<td><?php echo $market['market_closed']; ?></td>
			<td><?php echo $market['comments']; ?></td>
			<td><?php echo $market['exchange_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'markets', 'action' => 'view', $market['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'markets', 'action' => 'edit', $market['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'markets', 'action' => 'delete', $market['id']), array(), __('Are you sure you want to delete # %s?', $market['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sectors'); ?></h3>
	<?php if (!empty($exchange['Sector'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Full Name'); ?></th>
		<th><?php echo __('Dse Sector Id'); ?></th>
		<th><?php echo __('Exchange Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($exchange['Sector'] as $sector): ?>
		<tr>
			<td><?php echo $sector['id']; ?></td>
			<td><?php echo $sector['name']; ?></td>
			<td><?php echo $sector['full_name']; ?></td>
			<td><?php echo $sector['dse_sector_id']; ?></td>
			<td><?php echo $sector['exchange_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sectors', 'action' => 'view', $sector['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sectors', 'action' => 'edit', $sector['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sectors', 'action' => 'delete', $sector['id']), array(), __('Are you sure you want to delete # %s?', $sector['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
