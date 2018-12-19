<div class="instruments view">
<h2><?php echo __('Instrument'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $this->Html->link($instrument['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $instrument['Exchange']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($instrument['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $instrument['Sector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument Code'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['instrument_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Outstanding Capital'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['outstanding_capital']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Face Value'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['face_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Lot'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['market_lot']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No Of Securities'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['no_of_securities']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dse Listing Year'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['dse_listing_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cse Listing Year'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['cse_listing_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Electronic Share'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['electronic_share']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Share Percentage Director'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['share_percentage_director']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Share Percentage Govt'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['share_percentage_govt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Share Percentage Institute'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['share_percentage_institute']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Share Percentage Foreign'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['share_percentage_foreign']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Share Percentage Public'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['share_percentage_public']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Info'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['contact_info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Webaddress'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['email_webaddress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Capital'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['market_capital']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Agm Held'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['last_agm_held']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bonus Issue'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['bonus_issue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Right Issue'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['right_issue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year End'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['year_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reserve And Surplus'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['reserve_and_surplus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Half Year End'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['half_year_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Net Turn Over'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['net_turn_over']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Net Profit After Tax'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['net_profit_after_tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eps In Bd'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['eps_in_bd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finance Update Time'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['finance_update_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Year Eps'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['last_year_eps']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q1'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q2'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q3'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q4'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Otc Market'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['otc_market']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Show At Pe Lists'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['show_at_pe_lists']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inactive'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['inactive']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quarter Year End'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['quarter_year_end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Final Trade Price'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['last_final_trade_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Update Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['last_update_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latest Eps Dilution'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['latest_eps_dilution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Previous Eps Dilution'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['previous_eps_dilution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Corporate Declaration Restriction'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['corporate_declaration_restriction']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sb71 Index'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['sb71_index']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Ycp Updated'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['is_ycp_updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dse Code Bangla'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['dse_code_bangla']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Bangla'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['name_bangla']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Bangla'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['category_bangla']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business Segment Bangla'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['business_segment_bangla']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nature Of Business'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['nature_of_business']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eastablish Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['eastablish_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q1 Start Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q1_start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q1 End Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q1_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q2 Start Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q2_start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q2 End Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q2_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q3 Start Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q3_start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q3 End Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q3_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q4 Start Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q4_start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Q4 End Date'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['q4_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dsex Index'); ?></dt>
		<dd>
			<?php echo h($instrument['Instrument']['dsex_index']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Instrument'), array('action' => 'edit', $instrument['Instrument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Instrument'), array('action' => 'delete', $instrument['Instrument']['id']), array(), __('Are you sure you want to delete # %s?', $instrument['Instrument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Corporate Actions'), array('controller' => 'corporate_actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Corporate Action'), array('controller' => 'corporate_actions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Eods'), array('controller' => 'data_banks_eods', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Eod'), array('controller' => 'data_banks_eods', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Intradays'), array('controller' => 'data_banks_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Intraday'), array('controller' => 'data_banks_intradays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamentals'), array('controller' => 'fundamentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental'), array('controller' => 'fundamentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Corporate Actions'); ?></h3>
	<?php if (!empty($instrument['CorporateAction'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Symbol'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Action'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Premium'); ?></th>
		<th><?php echo __('Record Date'); ?></th>
		<th><?php echo __('Datestamp'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($instrument['CorporateAction'] as $corporateAction): ?>
		<tr>
			<td><?php echo $corporateAction['id']; ?></td>
			<td><?php echo $corporateAction['instrument_id']; ?></td>
			<td><?php echo $corporateAction['symbol']; ?></td>
			<td><?php echo $corporateAction['code']; ?></td>
			<td><?php echo $corporateAction['action']; ?></td>
			<td><?php echo $corporateAction['value']; ?></td>
			<td><?php echo $corporateAction['premium']; ?></td>
			<td><?php echo $corporateAction['record_date']; ?></td>
			<td><?php echo $corporateAction['datestamp']; ?></td>
			<td><?php echo $corporateAction['active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'corporate_actions', 'action' => 'view', $corporateAction['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'corporate_actions', 'action' => 'edit', $corporateAction['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'corporate_actions', 'action' => 'delete', $corporateAction['id']), array(), __('Are you sure you want to delete # %s?', $corporateAction['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Corporate Action'), array('controller' => 'corporate_actions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Data Banks Eods'); ?></h3>
	<?php if (!empty($instrument['DataBanksEod'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Open'); ?></th>
		<th><?php echo __('High'); ?></th>
		<th><?php echo __('Low'); ?></th>
		<th><?php echo __('Close'); ?></th>
		<th><?php echo __('Volume'); ?></th>
		<th><?php echo __('Trade'); ?></th>
		<th><?php echo __('Tradevalues'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Adjustment Factor'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($instrument['DataBanksEod'] as $dataBanksEod): ?>
		<tr>
			<td><?php echo $dataBanksEod['id']; ?></td>
			<td><?php echo $dataBanksEod['market_id']; ?></td>
			<td><?php echo $dataBanksEod['instrument_id']; ?></td>
			<td><?php echo $dataBanksEod['open']; ?></td>
			<td><?php echo $dataBanksEod['high']; ?></td>
			<td><?php echo $dataBanksEod['low']; ?></td>
			<td><?php echo $dataBanksEod['close']; ?></td>
			<td><?php echo $dataBanksEod['volume']; ?></td>
			<td><?php echo $dataBanksEod['trade']; ?></td>
			<td><?php echo $dataBanksEod['tradevalues']; ?></td>
			<td><?php echo $dataBanksEod['date']; ?></td>
			<td><?php echo $dataBanksEod['updated']; ?></td>
			<td><?php echo $dataBanksEod['adjustment_factor']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'data_banks_eods', 'action' => 'view', $dataBanksEod['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'data_banks_eods', 'action' => 'edit', $dataBanksEod['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'data_banks_eods', 'action' => 'delete', $dataBanksEod['id']), array(), __('Are you sure you want to delete # %s?', $dataBanksEod['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Data Banks Eod'), array('controller' => 'data_banks_eods', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Data Banks Intradays'); ?></h3>
	<?php if (!empty($instrument['DataBanksIntraday'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Instrument Id'); ?></th>
		<th><?php echo __('Instrument Code'); ?></th>
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
	<?php foreach ($instrument['DataBanksIntraday'] as $dataBanksIntraday): ?>
		<tr>
			<td><?php echo $dataBanksIntraday['id']; ?></td>
			<td><?php echo $dataBanksIntraday['market_id']; ?></td>
			<td><?php echo $dataBanksIntraday['instrument_id']; ?></td>
			<td><?php echo $dataBanksIntraday['instrument_code']; ?></td>
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
	<h3><?php echo __('Related Fundamentals'); ?></h3>
	<?php if (!empty($instrument['Fundamental'])): ?>
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
	<?php foreach ($instrument['Fundamental'] as $fundamental): ?>
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
