<div class="brokers view">
<h2><?php echo __('Broker'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Broker Name'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['broker_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Member Id'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['member_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mob'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['mob']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Broker User Id'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['broker_user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Broker Password'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['broker_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registration Date'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['registration_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login Time'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['last_login_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allow IP'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['allow_IP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accept Order'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['accept_order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message For User'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['message_for_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Show User Msg'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['show_user_msg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Default Commision'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['default_commision']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Ip Check'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['is_ip_check']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Freeshare Check'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['is_freeshare_check']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terminal1'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['terminal1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terminal2'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['terminal2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TotalorderTerminal1'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['totalorderTerminal1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TotalorderTerminal2'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['totalorderTerminal2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allow Day Trading'); ?></dt>
		<dd>
			<?php echo h($broker['Broker']['allow_day_trading']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Broker'), array('action' => 'edit', $broker['Broker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Broker'), array('action' => 'delete', $broker['Broker']['id']), array(), __('Are you sure you want to delete # %s?', $broker['Broker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Brokers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Broker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($broker['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Broker Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Middle Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Activation Code'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Password Reset'); ?></th>
		<th><?php echo __('Profile Pic'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Broker Name'); ?></th>
		<th><?php echo __('Contact No'); ?></th>
		<th><?php echo __('Last Visit Info'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Mobile No'); ?></th>
		<th><?php echo __('Facebook Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($broker['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td><?php echo $user['broker_id']; ?></td>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['middle_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['group_id']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['activation_code']; ?></td>
			<td><?php echo $user['active']; ?></td>
			<td><?php echo $user['password_reset']; ?></td>
			<td><?php echo $user['profile_pic']; ?></td>
			<td><?php echo $user['address']; ?></td>
			<td><?php echo $user['broker_name']; ?></td>
			<td><?php echo $user['contact_no']; ?></td>
			<td><?php echo $user['last_visit_info']; ?></td>
			<td><?php echo $user['city']; ?></td>
			<td><?php echo $user['mobile_no']; ?></td>
			<td><?php echo $user['facebook_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
