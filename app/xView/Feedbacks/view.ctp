<div class="feedbacks view">
<h2><?php echo __('Feedback'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($feedback['Application']['id'], array('controller' => 'applications', 'action' => 'view', $feedback['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($feedback['User']['username'], array('controller' => 'users', 'action' => 'view', $feedback['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feedback User Name'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['feedback_user_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feedback User Email'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['feedback_user_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feeback User Contact'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['feeback_user_contact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feedback'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['feedback']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Submitted At'); ?></dt>
		<dd>
			<?php echo h($feedback['Feedback']['submitted_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Feedback'), array('action' => 'edit', $feedback['Feedback']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Feedback'), array('action' => 'delete', $feedback['Feedback']['id']), null, __('Are you sure you want to delete # %s?', $feedback['Feedback']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedbacks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
