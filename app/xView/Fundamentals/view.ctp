<div class="fundamentals view">
<h2><?php echo __('Fundamental'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fundamental['Fundamental']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($fundamental['Instrument']['name'], array('controller' => 'instruments', 'action' => 'view', $fundamental['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fundamental Meta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($fundamental['FundamentalMeta']['meta_key'], array('controller' => 'fundamental_metas', 'action' => 'view', $fundamental['FundamentalMeta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Value'); ?></dt>
		<dd>
			<?php echo h($fundamental['Fundamental']['meta_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Date'); ?></dt>
		<dd>
			<?php echo h($fundamental['Fundamental']['meta_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($fundamental['Fundamental']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($fundamental['Fundamental']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fundamental'), array('action' => 'edit', $fundamental['Fundamental']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fundamental'), array('action' => 'delete', $fundamental['Fundamental']['id']), array(), __('Are you sure you want to delete # %s?', $fundamental['Fundamental']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamentals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
