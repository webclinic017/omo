<div class="corporateActions index">
	<h2><?php echo __('Corporate Actions'); ?></h2>
    <table class="table table-striped table-hover table-bordered" id="users-table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('instrument_id'); ?></th>
			<th><?php echo $this->Paginator->sort('action'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('premium'); ?></th>
			<th><?php echo $this->Paginator->sort('record_date'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($corporateActions as $corporateAction): ?>
	<tr>
		<td><?php echo h($corporateAction['CorporateAction']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($corporateAction['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $corporateAction['Instrument']['id'])); ?>
		</td>
		<td><?php echo h($corporateAction['CorporateAction']['action']); ?>&nbsp;</td>
		<td><?php echo h($corporateAction['CorporateAction']['value']); ?>&nbsp;</td>
		<td><?php echo h($corporateAction['CorporateAction']['premium']); ?>&nbsp;</td>
		<td><?php echo h($corporateAction['CorporateAction']['record_date']); ?>&nbsp;</td>
		<td><?php echo h($corporateAction['CorporateAction']['active']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $corporateAction['CorporateAction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $corporateAction['CorporateAction']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $corporateAction['CorporateAction']['id']), array(), __('Are you sure you want to delete # %s?', $corporateAction['CorporateAction']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
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
		<li><?php echo $this->Html->link(__('New Corporate Action'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
	</ul>
</div>
