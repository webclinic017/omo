<div class="rawTradins view">
<h2><?php echo __('Raw Tradin'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dealer Id'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['dealer_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Id'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['client_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument Code'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['instrument_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['board']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Execute Time'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['execute_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Execute Qty'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['execute_qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Oredr Id'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['oredr_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Execution Id'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['execution_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($rawTradin['RawTradin']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Raw Tradin'), array('action' => 'edit', $rawTradin['RawTradin']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Raw Tradin'), array('action' => 'delete', $rawTradin['RawTradin']['id']), array(), __('Are you sure you want to delete # %s?', $rawTradin['RawTradin']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Raw Tradins'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Raw Tradin'), array('action' => 'add')); ?> </li>
	</ul>
</div>
