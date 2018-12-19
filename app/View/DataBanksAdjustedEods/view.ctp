<div class="dataBanksAdjustedEods view">
<h2><?php echo __('Data Banks Adjusted Eod'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataBanksAdjustedEod['Market']['id'], array('controller' => 'markets', 'action' => 'view', $dataBanksAdjustedEod['Market']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataBanksAdjustedEod['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $dataBanksAdjustedEod['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Open'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['open']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('High'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['high']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Low'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['low']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Close'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['close']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trade'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['trade']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tradevalues'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['tradevalues']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($dataBanksAdjustedEod['DataBanksAdjustedEod']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Data Banks Adjusted Eod'), array('action' => 'edit', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Data Banks Adjusted Eod'), array('action' => 'delete', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id']), array(), __('Are you sure you want to delete # %s?', $dataBanksAdjustedEod['DataBanksAdjustedEod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Adjusted Eods'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Adjusted Eod'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
