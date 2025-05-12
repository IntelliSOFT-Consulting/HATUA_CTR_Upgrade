<div class="deviations index">
	<h2><?php echo __('Deviations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('study_title'); ?></th>
			<th><?php echo $this->Paginator->sort('pi_name'); ?></th>
			<th><?php echo $this->Paginator->sort('deviation_date'); ?></th>
			<th><?php echo $this->Paginator->sort('participant_number'); ?></th>
			<th><?php echo $this->Paginator->sort('treating_physician'); ?></th>
			<th><?php echo $this->Paginator->sort('deviation_description'); ?></th>
			<th><?php echo $this->Paginator->sort('deviation_explanation'); ?></th>
			<th><?php echo $this->Paginator->sort('deviation_measures'); ?></th>
			<th><?php echo $this->Paginator->sort('deviation_preclude'); ?></th>
			<th><?php echo $this->Paginator->sort('sponsor_notified'); ?></th>
			<th><?php echo $this->Paginator->sort('sponsor_explanation'); ?></th>
			<th><?php echo $this->Paginator->sort('study_impact'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($deviations as $deviation): ?>
	<tr>
		<td><?php echo h($deviation['Deviation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deviation['Application']['id'], array('controller' => 'applications', 'action' => 'view', $deviation['Application']['id'])); ?>
		</td>
		<td><?php echo h($deviation['Deviation']['study_title']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['pi_name']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deviation_date']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['participant_number']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['treating_physician']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deviation_description']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deviation_explanation']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deviation_measures']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deviation_preclude']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['sponsor_notified']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['sponsor_explanation']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['study_impact']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['deleted_date']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['created']); ?>&nbsp;</td>
		<td><?php echo h($deviation['Deviation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $deviation['Deviation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $deviation['Deviation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $deviation['Deviation']['id']), null, __('Are you sure you want to delete # %s?', $deviation['Deviation']['id'])); ?>
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
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Deviation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
