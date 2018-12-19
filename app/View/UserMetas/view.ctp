<div class="userMetas view">
<h2><?php echo __('User Meta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userMeta['UserMeta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Key'); ?></dt>
		<dd>
			<?php echo h($userMeta['UserMeta']['meta_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Description'); ?></dt>
		<dd>
			<?php echo h($userMeta['UserMeta']['meta_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meta Created'); ?></dt>
		<dd>
			<?php echo h($userMeta['UserMeta']['meta_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($userMeta['UserMeta']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Meta'), array('action' => 'edit', $userMeta['UserMeta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Meta'), array('action' => 'delete', $userMeta['UserMeta']['id']), array(), __('Are you sure you want to delete # %s?', $userMeta['UserMeta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Metas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Meta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Informations'), array('controller' => 'users_informations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Information'), array('controller' => 'users_informations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users Informations'); ?></h3>
	<?php if (!empty($userMeta['UsersInformation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('User Meta Id'); ?></th>
		<th><?php echo __('Meta Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userMeta['UsersInformation'] as $usersInformation): ?>
		<tr>
			<td><?php echo $usersInformation['id']; ?></td>
			<td><?php echo $usersInformation['user_id']; ?></td>
			<td><?php echo $usersInformation['user_meta_id']; ?></td>
			<td><?php echo $usersInformation['meta_value']; ?></td>
			<td><?php echo $usersInformation['created']; ?></td>
			<td><?php echo $usersInformation['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users_informations', 'action' => 'view', $usersInformation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users_informations', 'action' => 'edit', $usersInformation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users_informations', 'action' => 'delete', $usersInformation['id']), array(), __('Are you sure you want to delete # %s?', $usersInformation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Users Information'), array('controller' => 'users_informations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
