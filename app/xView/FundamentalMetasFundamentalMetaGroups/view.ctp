<div class="fundamentalMetasFundamentalMetaGroups view">
<h2><?php echo __('Fundamental Metas Fundamental Meta Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fundamental Meta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($fundamentalMetasFundamentalMetaGroup['FundamentalMeta']['meta_key'], array('controller' => 'fundamental_metas', 'action' => 'view', $fundamentalMetasFundamentalMetaGroup['FundamentalMeta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fundamental Meta Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($fundamentalMetasFundamentalMetaGroup['FundamentalMetaGroup']['group_key'], array('controller' => 'fundamental_meta_groups', 'action' => 'view', $fundamentalMetasFundamentalMetaGroup['FundamentalMetaGroup']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fundamental Metas Fundamental Meta Group'), array('action' => 'edit', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fundamental Metas Fundamental Meta Group'), array('action' => 'delete', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id']), array(), __('Are you sure you want to delete # %s?', $fundamentalMetasFundamentalMetaGroup['FundamentalMetasFundamentalMetaGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas Fundamental Meta Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Metas Fundamental Meta Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Metas'), array('controller' => 'fundamental_metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta'), array('controller' => 'fundamental_metas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fundamental Meta Groups'), array('controller' => 'fundamental_meta_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fundamental Meta Group'), array('controller' => 'fundamental_meta_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
