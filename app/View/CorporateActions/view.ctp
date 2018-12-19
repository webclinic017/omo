<div class="corporateActions view">
<h2><?php echo __('Corporate Action'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($corporateAction['CorporateAction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($corporateAction['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $corporateAction['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo h($corporateAction['CorporateAction']['action']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($corporateAction['CorporateAction']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Premium'); ?></dt>
		<dd>
			<?php echo h($corporateAction['CorporateAction']['premium']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Record Date'); ?></dt>
		<dd>
			<?php echo h($corporateAction['CorporateAction']['record_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($corporateAction['CorporateAction']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Corporate Action'), array('action' => 'edit', $corporateAction['CorporateAction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Corporate Action'), array('action' => 'delete', $corporateAction['CorporateAction']['id']), array(), __('Are you sure you want to delete # %s?', $corporateAction['CorporateAction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Corporate Actions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Corporate Action'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
