<div class="orders view">
<h2><?php echo __('Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['User']['username'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Type'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $order['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No Of Shares'); ?></dt>
		<dd>
			<?php echo h($order['Order']['no_of_shares']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price Type'); ?></dt>
		<dd>
			<?php echo h($order['Order']['price_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Ref No'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_ref_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Final Price'); ?></dt>
		<dd>
			<?php echo h($order['Order']['final_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buy Start Range'); ?></dt>
		<dd>
			<?php echo h($order['Order']['buy_start_range']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buy End Range'); ?></dt>
		<dd>
			<?php echo h($order['Order']['buy_end_range']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Place Time'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_place_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Status'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Update'); ?></dt>
		<dd>
			<?php echo h($order['Order']['last_update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cancel Status'); ?></dt>
		<dd>
			<?php echo h($order['Order']['cancel_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Order Status'); ?></dt>
		<dd>
			<?php echo h($order['Order']['market_order_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Drip Quantity'); ?></dt>
		<dd>
			<?php echo h($order['Order']['drip_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terminal'); ?></dt>
		<dd>
			<?php echo h($order['Order']['terminal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TotalorderTerminal1'); ?></dt>
		<dd>
			<?php echo h($order['Order']['totalorderTerminal1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TotalorderTerminal2'); ?></dt>
		<dd>
			<?php echo h($order['Order']['totalorderTerminal2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order By Mobile'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_by_mobile']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), array(), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
