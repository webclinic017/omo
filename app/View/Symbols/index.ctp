<div class="symbols index">
	<h2><?php echo __('Symbols'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('dse_code'); ?></th>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th><?php echo $this->Paginator->sort('cse_code'); ?></th>
			<th><?php echo $this->Paginator->sort('update_time'); ?></th>
			<th><?php echo $this->Paginator->sort('lasttradeprice'); ?></th>
			<th><?php echo $this->Paginator->sort('yclose'); ?></th>
			<th><?php echo $this->Paginator->sort('outstanding_capital'); ?></th>
			<th><?php echo $this->Paginator->sort('face_value'); ?></th>
			<th><?php echo $this->Paginator->sort('market_lot'); ?></th>
			<th><?php echo $this->Paginator->sort('no_of_securities'); ?></th>
			<th><?php echo $this->Paginator->sort('business_segment'); ?></th>
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
			<th><?php echo $this->Paginator->sort('sector_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($symbols as $symbol): ?>
	<tr>
		<td><?php echo h($symbol['Symbol']['dse_code']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['id']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['name']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['category']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['cse_code']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['update_time']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['lasttradeprice']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['yclose']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['outstanding_capital']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['face_value']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['market_lot']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['no_of_securities']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['business_segment']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['dse_listing_year']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['cse_listing_year']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['electronic_share']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['share_percentage_director']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['share_percentage_govt']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['share_percentage_institute']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['share_percentage_foreign']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['share_percentage_public']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['remarks']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['address']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['contact_info']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['email_webaddress']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['market_capital']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['last_agm_held']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['bonus_issue']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['right_issue']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['year_end']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['reserve_and_surplus']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['half_year_end']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['net_turn_over']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['net_profit_after_tax']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['eps_in_bd']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['finance_update_time']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['last_year_eps']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q1']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q2']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q3']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q4']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['otc_market']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['show_at_pe_lists']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['inactive']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['quarter_year_end']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['last_final_trade_price']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['last_update_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['latest_eps_dilution']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['previous_eps_dilution']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['corporate_declaration_restriction']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['sb71_index']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['is_ycp_updated']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['dse_code_bangla']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['name_bangla']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['category_bangla']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['business_segment_bangla']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['nature_of_business']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['eastablish_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q1_start_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q1_end_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q2_start_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q2_end_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q3_start_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q3_end_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q4_start_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['q4_end_date']); ?>&nbsp;</td>
		<td><?php echo h($symbol['Symbol']['dsex_index']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($symbol['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $symbol['Sector']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $symbol['Symbol']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $symbol['Symbol']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $symbol['Symbol']['id']), null, __('Are you sure you want to delete # %s?', $symbol['Symbol']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Symbol'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
