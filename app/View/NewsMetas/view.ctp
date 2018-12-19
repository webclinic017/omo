<div class="newsMetas view">
<h2><?php echo __('News Meta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($newsMeta['NewsMeta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('News'); ?></dt>
		<dd>
			<?php echo $this->Html->link($newsMeta['News']['title'], array('controller' => 'news', 'action' => 'view', $newsMeta['News']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Key'); ?></dt>
		<dd>
			<?php echo h($newsMeta['NewsMeta']['meta_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Value'); ?></dt>
		<dd>
			<?php echo h($newsMeta['NewsMeta']['meta_value']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit News Meta'), array('action' => 'edit', $newsMeta['NewsMeta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete News Meta'), array('action' => 'delete', $newsMeta['NewsMeta']['id']), array(), __('Are you sure you want to delete # %s?', $newsMeta['NewsMeta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List News Metas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News Meta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List News'), array('controller' => 'news', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('controller' => 'news', 'action' => 'add')); ?> </li>
	</ul>
</div>
