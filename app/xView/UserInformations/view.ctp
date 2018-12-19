<div class="userInformations view">
<h2><?php echo __('User Information'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userInformation['UserInformation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userInformation['User']['username'], array('controller' => 'users', 'action' => 'view', $userInformation['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userInformation['Meta']['meta_key'], array('controller' => 'metas', 'action' => 'view', $userInformation['Meta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Value'); ?></dt>
		<dd>
			<?php echo h($userInformation['UserInformation']['meta_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userInformation['UserInformation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($userInformation['UserInformation']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Information'), array('action' => 'edit', $userInformation['UserInformation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Information'), array('action' => 'delete', $userInformation['UserInformation']['id']), array(), __('Are you sure you want to delete # %s?', $userInformation['UserInformation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Informations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Information'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
