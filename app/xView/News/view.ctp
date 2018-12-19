<div class="news view">
<h2><?php echo __('News'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($news['News']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($news['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $news['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($news['News']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Details'); ?></dt>
		<dd>
			<?php echo h($news['News']['details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Date'); ?></dt>
		<dd>
			<?php echo h($news['News']['post_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expire Date'); ?></dt>
		<dd>
			<?php echo h($news['News']['expire_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($news['News']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($news['News']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit News'), array('action' => 'edit', $news['News']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete News'), array('action' => 'delete', $news['News']['id']), array(), __('Are you sure you want to delete # %s?', $news['News']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List News'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
