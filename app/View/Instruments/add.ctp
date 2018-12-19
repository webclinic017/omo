<div class="instruments form">
<?php echo $this->Form->create('Instrument'); ?>
	<fieldset>
		<legend><?php echo __('Add Instrument'); ?></legend>
	<?php
		echo $this->Form->input('exchange_id');
		echo $this->Form->input('sector_id');
		echo $this->Form->input('instrument_code');
		echo $this->Form->input('name');
		echo $this->Form->input('category');
		echo $this->Form->input('outstanding_capital');
		echo $this->Form->input('face_value');
		echo $this->Form->input('market_lot');
		echo $this->Form->input('no_of_securities');
		echo $this->Form->input('dse_listing_year');
		echo $this->Form->input('cse_listing_year');
		echo $this->Form->input('electronic_share');
		echo $this->Form->input('share_percentage_director');
		echo $this->Form->input('share_percentage_govt');
		echo $this->Form->input('share_percentage_institute');
		echo $this->Form->input('share_percentage_foreign');
		echo $this->Form->input('share_percentage_public');
		echo $this->Form->input('remarks');
		echo $this->Form->input('address');
		echo $this->Form->input('contact_info');
		echo $this->Form->input('email_webaddress');
		echo $this->Form->input('market_capital');
		echo $this->Form->input('last_agm_held');
		echo $this->Form->input('bonus_issue');
		echo $this->Form->input('right_issue');
		echo $this->Form->input('year_end');
		echo $this->Form->input('reserve_and_surplus');
		echo $this->Form->input('half_year_end');
		echo $this->Form->input('net_turn_over');
		echo $this->Form->input('net_profit_after_tax');
		echo $this->Form->input('eps_in_bd');
		echo $this->Form->input('finance_update_time');
		echo $this->Form->input('last_year_eps');
		echo $this->Form->input('q1');
		echo $this->Form->input('q2');
		echo $this->Form->input('q3');
		echo $this->Form->input('q4');
		echo $this->Form->input('otc_market');
		echo $this->Form->input('show_at_pe_lists');
		echo $this->Form->input('inactive');
		echo $this->Form->input('quarter_year_end');
		echo $this->Form->input('last_final_trade_price');
		echo $this->Form->input('last_update_date');
		echo $this->Form->input('latest_eps_dilution');
		echo $this->Form->input('previous_eps_dilution');
		echo $this->Form->input('corporate_declaration_restriction');
		echo $this->Form->input('sb71_index');
		echo $this->Form->input('is_ycp_updated');
		echo $this->Form->input('dse_code_bangla');
		echo $this->Form->input('name_bangla');
		echo $this->Form->input('category_bangla');
		echo $this->Form->input('business_segment_bangla');
		echo $this->Form->input('nature_of_business');
		echo $this->Form->input('eastablish_date');
		echo $this->Form->input('q1_start_date');
		echo $this->Form->input('q1_end_date');
		echo $this->Form->input('q2_start_date');
		echo $this->Form->input('q2_end_date');
		echo $this->Form->input('q3_start_date');
		echo $this->Form->input('q3_end_date');
		echo $this->Form->input('q4_start_date');
		echo $this->Form->input('q4_end_date');
		echo $this->Form->input('dsex_index');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Instruments'), array('action' => 'index')); ?></li>
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
