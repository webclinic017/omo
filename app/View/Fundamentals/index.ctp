<div class="fundamentals search form">
    <?php echo $this->Form->create('Fundamental'); ?>
    <fieldset>
        <legend><?php echo __('Edit Fundamental'); ?></legend>
        <?php
		echo $this->Form->input('id');
        echo $this->Form->input('instrument_id', array('empty' => array(0 => '')));
        echo $this->Form->input('meta_id', array('empty' => array(0 => '')));
        echo $this->Form->input('meta_value');

        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Search')); ?>
</div>

<div class="fundamentals index">
	<h2><?php echo __('Fundamentals'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_value'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fundamentals as $fundamental): ?>
	<tr>
		<td><?php echo h($fundamental['Fundamental']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fundamental['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $fundamental['Instrument']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fundamental['Meta']['meta_key'], array('controller' => 'metas', 'action' => 'view', $fundamental['Meta']['id'])); ?>
		</td>
		<td><?php echo h($fundamental['Fundamental']['meta_value']); ?>&nbsp;</td>
		<td><?php echo h($fundamental['Fundamental']['meta_date']); ?>&nbsp;</td>
		<td><?php echo h($fundamental['Fundamental']['created']); ?>&nbsp;</td>
		<td><?php echo h($fundamental['Fundamental']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fundamental['Fundamental']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fundamental['Fundamental']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fundamental['Fundamental']['id']), array(), __('Are you sure you want to delete # %s?', $fundamental['Fundamental']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous  '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' | '));
		echo $this->Paginator->next(__('  next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Fundamental'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Metas'), array('controller' => 'metas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meta'), array('controller' => 'metas', 'action' => 'add')); ?> </li>
	</ul>
</div>
