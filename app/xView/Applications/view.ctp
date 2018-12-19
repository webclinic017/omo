<div class="applications view">
<h2><?php echo __('Application'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($application['Application']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apps Code'); ?></dt>
		<dd>
			<?php echo h($application['Application']['apps_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apps Name'); ?></dt>
		<dd>
			<?php echo h($application['Application']['apps_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($application['Application']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Developed On'); ?></dt>
		<dd>
			<?php echo h($application['Application']['developed_on']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dependency'); ?></dt>
		<dd>
			<?php echo h($application['Application']['dependency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input'); ?></dt>
		<dd>
			<?php echo h($application['Application']['input']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Output'); ?></dt>
		<dd>
			<?php echo h($application['Application']['output']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manager'); ?></dt>
		<dd>
			<?php echo h($application['Application']['manager']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Application'), array('action' => 'edit', $application['Application']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Application'), array('action' => 'delete', $application['Application']['id']), null, __('Are you sure you want to delete # %s?', $application['Application']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feedbacks'), array('controller' => 'feedbacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feedback'), array('controller' => 'feedbacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Feedbacks'); ?></h3>
	<?php if (!empty($application['Feedback'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Feedback User Name'); ?></th>
		<th><?php echo __('Feedback User Email'); ?></th>
		<th><?php echo __('Feeback User Contact'); ?></th>
		<th><?php echo __('Feedback'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Submitted At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($application['Feedback'] as $feedback): ?>
		<tr>
			<td><?php echo $feedback['id']; ?></td>
			<td><?php echo $feedback['application_id']; ?></td>
			<td><?php echo $feedback['user_id']; ?></td>
			<td><?php echo $feedback['feedback_user_name']; ?></td>
			<td><?php echo $feedback['feedback_user_email']; ?></td>
			<td><?php echo $feedback['feeback_user_contact']; ?></td>
			<td><?php echo $feedback['feedback']; ?></td>
			<td><?php echo $feedback['status']; ?></td>
			<td><?php echo $feedback['submitted_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'feedbacks', 'action' => 'view', $feedback['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'feedbacks', 'action' => 'edit', $feedback['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'feedbacks', 'action' => 'delete', $feedback['id']), null, __('Are you sure you want to delete # %s?', $feedback['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Feedback'), array('controller' => 'feedbacks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
