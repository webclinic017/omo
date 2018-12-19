<div class="instruments index">
	<h2><?php echo __('Instruments'); ?> ADMIN</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('exchange_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sector_id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th><?php echo $this->Paginator->sort('outstanding_capital'); ?></th>
			<th><?php echo $this->Paginator->sort('face_value'); ?></th>
			<th><?php echo $this->Paginator->sort('market_lot'); ?></th>
			<th><?php echo $this->Paginator->sort('no_of_securities'); ?></th>
			<th><?php echo $this->Paginator->sort('dse_listing_year'); ?></th>
			<th><?php echo $this->Paginator->sort('cse_listing_year'); ?></th>
			<th><?php echo $this->Paginator->sort('electronic_share'); ?></th>
			<th><?php echo $this->Paginator->sort('share_percentage_director'); ?></th>
			<th><?php echo $this->Paginator->sort('share_percentage_govt'); ?></th>
			<th><?php echo $this->Paginator->sort('share_percentage_institute'); ?></th>
			<th><?php echo $this->Paginator->sort('share_percentage_foreign'); ?></th>
			<th><?php echo $this->Paginator->sort('share_percentage_public'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_info'); ?></th>
			<th><?php echo $this->Paginator->sort('email_webaddress'); ?></th>
			<th><?php echo $this->Paginator->sort('market_capital'); ?></th>
			<th><?php echo $this->Paginator->sort('last_agm_held'); ?></th>
			<th><?php echo $this->Paginator->sort('bonus_issue'); ?></th>
			<th><?php echo $this->Paginator->sort('right_issue'); ?></th>
			<th><?php echo $this->Paginator->sort('year_end'); ?></th>
			<th><?php echo $this->Paginator->sort('reserve_and_surplus'); ?></th>
			<th><?php echo $this->Paginator->sort('half_year_end'); ?></th>
			<th><?php echo $this->Paginator->sort('net_turn_over'); ?></th>
			<th><?php echo $this->Paginator->sort('net_profit_after_tax'); ?></th>
			<th><?php echo $this->Paginator->sort('eps_in_bd'); ?></th>
			<th><?php echo $this->Paginator->sort('finance_update_time'); ?></th>
			<th><?php echo $this->Paginator->sort('last_year_eps'); ?></th>
			<th><?php echo $this->Paginator->sort('q1'); ?></th>
			<th><?php echo $this->Paginator->sort('q2'); ?></th>
			<th><?php echo $this->Paginator->sort('q3'); ?></th>
			<th><?php echo $this->Paginator->sort('q4'); ?></th>
			<th><?php echo $this->Paginator->sort('otc_market'); ?></th>
			<th><?php echo $this->Paginator->sort('show_at_pe_lists'); ?></th>
			<th><?php echo $this->Paginator->sort('inactive'); ?></th>
			<th><?php echo $this->Paginator->sort('quarter_year_end'); ?></th>
			<th><?php echo $this->Paginator->sort('last_final_trade_price'); ?></th>
			<th><?php echo $this->Paginator->sort('last_update_date'); ?></th>
			<th><?php echo $this->Paginator->sort('latest_eps_dilution'); ?></th>
			<th><?php echo $this->Paginator->sort('previous_eps_dilution'); ?></th>
			<th><?php echo $this->Paginator->sort('corporate_declaration_restriction'); ?></th>
			<th><?php echo $this->Paginator->sort('sb71_index'); ?></th>
			<th><?php echo $this->Paginator->sort('is_ycp_updated'); ?></th>
			<th><?php echo $this->Paginator->sort('dse_code_bangla'); ?></th>
			<th><?php echo $this->Paginator->sort('name_bangla'); ?></th>
			<th><?php echo $this->Paginator->sort('category_bangla'); ?></th>
			<th><?php echo $this->Paginator->sort('business_segment_bangla'); ?></th>
			<th><?php echo $this->Paginator->sort('nature_of_business'); ?></th>
			<th><?php echo $this->Paginator->sort('eastablish_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q1_start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q1_end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q2_start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q2_end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q3_start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q3_end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q4_start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('q4_end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('dsex_index'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($instruments as $instrument): ?>
	<tr>
		<td><?php echo h($instrument['Instrument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($instrument['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $instrument['Exchange']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($instrument['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $instrument['Sector']['id'])); ?>
		</td>
		<td><?php echo h($instrument['Instrument']['code']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['name']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['category']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['outstanding_capital']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['face_value']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['market_lot']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['no_of_securities']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['dse_listing_year']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['cse_listing_year']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['electronic_share']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['share_percentage_director']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['share_percentage_govt']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['share_percentage_institute']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['share_percentage_foreign']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['share_percentage_public']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['remarks']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['address']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['contact_info']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['email_webaddress']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['market_capital']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['last_agm_held']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['bonus_issue']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['right_issue']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['year_end']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['reserve_and_surplus']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['half_year_end']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['net_turn_over']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['net_profit_after_tax']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['eps_in_bd']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['finance_update_time']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['last_year_eps']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q1']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q2']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q3']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q4']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['otc_market']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['show_at_pe_lists']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['inactive']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['quarter_year_end']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['last_final_trade_price']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['last_update_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['latest_eps_dilution']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['previous_eps_dilution']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['corporate_declaration_restriction']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['sb71_index']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['is_ycp_updated']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['dse_code_bangla']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['name_bangla']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['category_bangla']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['business_segment_bangla']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['nature_of_business']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['eastablish_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q1_start_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q1_end_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q2_start_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q2_end_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q3_start_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q3_end_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q4_start_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['q4_end_date']); ?>&nbsp;</td>
		<td><?php echo h($instrument['Instrument']['dsex_index']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $instrument['Instrument']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $instrument['Instrument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $instrument['Instrument']['id']), null, __('Are you sure you want to delete # %s?', $instrument['Instrument']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Instrument'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Intradays'), array('controller' => 'data_banks_intradays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Intraday'), array('controller' => 'data_banks_intradays', 'action' => 'add')); ?> </li>
	</ul>
</div>
