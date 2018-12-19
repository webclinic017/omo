<div class="dataBanksEods view">
<h2><?php echo __('Data Banks Eod'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataBanksEod['Market']['id'], array('controller' => 'markets', 'action' => 'view', $dataBanksEod['Market']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataBanksEod['Instrument']['name'], array('controller' => 'instruments', 'action' => 'view', $dataBanksEod['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Open'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['open']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('High'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['high']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Low'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['low']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Close'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['close']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adj Close'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['adj_close']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trade'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['trade']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tradevalues'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['tradevalues']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($dataBanksEod['DataBanksEod']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Data Banks Eod'), array('action' => 'edit', $dataBanksEod['DataBanksEod']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Data Banks Eod'), array('action' => 'delete', $dataBanksEod['DataBanksEod']['id']), null, __('Are you sure you want to delete # %s?', $dataBanksEod['DataBanksEod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Banks Eods'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Banks Eod'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Markets'), array('controller' => 'markets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Market'), array('controller' => 'markets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
