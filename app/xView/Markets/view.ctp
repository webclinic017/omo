<div class="markets view">
<h2><?php echo __('Market'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($market['Market']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trade Date'); ?></dt>
		<dd>
			<?php echo h($market['Market']['trade_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Trading Day'); ?></dt>
		<dd>
			<?php echo h($market['Market']['is_trading_day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Started'); ?></dt>
		<dd>
			<?php echo h($market['Market']['market_started']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Closed'); ?></dt>
		<dd>
			<?php echo h($market['Market']['market_closed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($market['Market']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $this->Html->link($market['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $market['Exchange']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Market'), array('action' => 'edit', $market['Market']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Market'), array('action' => 'delete', $market['Market']['id']), array(), __('Are you sure you want to delete # %s?', $market['Market']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Markets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Intradays'), array('controller' => 'data_banks_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Intraday'), array('controller' => 'data_banks_intradays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Index Values'), array('controller' => 'index_values', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Index Value'), array('controller' => 'index_values', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Market Stats'), array('controller' => 'market_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market Stat'), array('controller' => 'market_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Data Banks Intradays'); ?></h3>
	<?php if (!empty($market['DataBanksIntraday'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Quote Bases'); ?></th>
		<th><?php echo __('Open Price'); ?></th>
		<th><?php echo __('Pub Last Traded Price'); ?></th>
		<th><?php echo __('Spot Last Traded Price'); ?></th>
		<th><?php echo __('High Price'); ?></th>
		<th><?php echo __('Low Price'); ?></th>
		<th><?php echo __('Close Price'); ?></th>
		<th><?php echo __('Yday Close Price'); ?></th>
		<th><?php echo __('Total Trades'); ?></th>
		<th><?php echo __('Total Volume'); ?></th>
		<th><?php echo __('Total Value'); ?></th>
		<th><?php echo __('Public Total Trades'); ?></th>
		<th><?php echo __('Public Total Volume'); ?></th>
		<th><?php echo __('Public Total Value'); ?></th>
		<th><?php echo __('Spot Total Trades'); ?></th>
		<th><?php echo __('Spot Total Volume'); ?></th>
		<th><?php echo __('Spot Total Value'); ?></th>
		<th><?php echo __('Lm Date Time'); ?></th>
		<th><?php echo __('Trade Time'); ?></th>
		<th><?php echo __('Trade Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($market['DataBanksIntraday'] as $dataBanksIntraday): ?>
		<tr>
			<td><?php echo $dataBanksIntraday['id']; ?></td>
			<td><?php echo $dataBanksIntraday['market_id']; ?></td>
			<td><?php echo $dataBanksIntraday['instrument_id']; ?></td>
			<td><?php echo $dataBanksIntraday['quote_bases']; ?></td>
			<td><?php echo $dataBanksIntraday['open_price']; ?></td>
			<td><?php echo $dataBanksIntraday['pub_last_traded_price']; ?></td>
			<td><?php echo $dataBanksIntraday['spot_last_traded_price']; ?></td>
			<td><?php echo $dataBanksIntraday['high_price']; ?></td>
			<td><?php echo $dataBanksIntraday['low_price']; ?></td>
			<td><?php echo $dataBanksIntraday['close_price']; ?></td>
			<td><?php echo $dataBanksIntraday['yday_close_price']; ?></td>
			<td><?php echo $dataBanksIntraday['total_trades']; ?></td>
			<td><?php echo $dataBanksIntraday['total_volume']; ?></td>
			<td><?php echo $dataBanksIntraday['total_value']; ?></td>
			<td><?php echo $dataBanksIntraday['public_total_trades']; ?></td>
			<td><?php echo $dataBanksIntraday['public_total_volume']; ?></td>
			<td><?php echo $dataBanksIntraday['public_total_value']; ?></td>
			<td><?php echo $dataBanksIntraday['spot_total_trades']; ?></td>
			<td><?php echo $dataBanksIntraday['spot_total_volume']; ?></td>
			<td><?php echo $dataBanksIntraday['spot_total_value']; ?></td>
			<td><?php echo $dataBanksIntraday['lm_date_time']; ?></td>
			<td><?php echo $dataBanksIntraday['trade_time']; ?></td>
			<td><?php echo $dataBanksIntraday['trade_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'data_banks_intradays', 'action' => 'view', $dataBanksIntraday['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'data_banks_intradays', 'action' => 'edit', $dataBanksIntraday['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'data_banks_intradays', 'action' => 'delete', $dataBanksIntraday['id']), array(), __('Are you sure you want to delete # %s?', $dataBanksIntraday['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Data Banks Intraday'), array('controller' => 'data_banks_intradays', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Index Values'); ?></h3>
	<?php if (!empty($market['IndexValue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Capital Value'); ?></th>
		<th><?php echo __('Deviation'); ?></th>
		<th><?php echo __('Percentage Deviation'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th><?php echo __('Index Date'); ?></th>
		<th><?php echo __('Index Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($market['IndexValue'] as $indexValue): ?>
		<tr>
			<td><?php echo $indexValue['id']; ?></td>
			<td><?php echo $indexValue['market_id']; ?></td>
			<td><?php echo $indexValue['instrument_id']; ?></td>
			<td><?php echo $indexValue['capital_value']; ?></td>
			<td><?php echo $indexValue['deviation']; ?></td>
			<td><?php echo $indexValue['percentage_deviation']; ?></td>
			<td><?php echo $indexValue['date_time']; ?></td>
			<td><?php echo $indexValue['index_date']; ?></td>
			<td><?php echo $indexValue['index_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'index_values', 'action' => 'view', $indexValue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'index_values', 'action' => 'edit', $indexValue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'index_values', 'action' => 'delete', $indexValue['id']), array(), __('Are you sure you want to delete # %s?', $indexValue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Index Value'), array('controller' => 'index_values', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Market Stats'); ?></h3>
	<?php if (!empty($market['MarketStat'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Market Meta Id'); ?></th>
		<th><?php echo __('Meta Value'); ?></th>
		<th><?php echo __('Meta Date'); ?></th>
		<th><?php echo __('Meta Time'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($market['MarketStat'] as $marketStat): ?>
		<tr>
			<td><?php echo $marketStat['id']; ?></td>
			<td><?php echo $marketStat['market_id']; ?></td>
			<td><?php echo $marketStat['market_meta_id']; ?></td>
			<td><?php echo $marketStat['meta_value']; ?></td>
			<td><?php echo $marketStat['meta_date']; ?></td>
			<td><?php echo $marketStat['meta_time']; ?></td>
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
