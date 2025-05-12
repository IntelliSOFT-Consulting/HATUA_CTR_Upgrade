<div class="participantFlows index">
	<h2><?php echo __('Participant Flows'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('original_subjects'); ?></th>
			<th><?php echo $this->Paginator->sort('consented'); ?></th>
			<th><?php echo $this->Paginator->sort('screened'); ?></th>
			<th><?php echo $this->Paginator->sort('enrolled'); ?></th>
			<th><?php echo $this->Paginator->sort('lost'); ?></th>
			<th><?php echo $this->Paginator->sort('lost_reason'); ?></th>
			<th><?php echo $this->Paginator->sort('withdrawn'); ?></th>
			<th><?php echo $this->Paginator->sort('withdrawal_reason'); ?></th>
			<th><?php echo $this->Paginator->sort('self_withdrawal'); ?></th>
			<th><?php echo $this->Paginator->sort('self_withdrawal_reasons'); ?></th>
			<th><?php echo $this->Paginator->sort('active_subjects'); ?></th>
			<th><?php echo $this->Paginator->sort('completed_number'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($participantFlows as $participantFlow): ?>
	<tr>
		<td><?php echo h($participantFlow['ParticipantFlow']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($participantFlow['Application']['id'], array('controller' => 'applications', 'action' => 'view', $participantFlow['Application']['id'])); ?>
		</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['year']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['original_subjects']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['consented']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['screened']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['enrolled']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['lost']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['lost_reason']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['withdrawn']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['withdrawal_reason']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['self_withdrawal']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['self_withdrawal_reasons']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['active_subjects']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['completed_number']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['created']); ?>&nbsp;</td>
		<td><?php echo h($participantFlow['ParticipantFlow']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $participantFlow['ParticipantFlow']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $participantFlow['ParticipantFlow']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $participantFlow['ParticipantFlow']['id']), null, __('Are you sure you want to delete # %s?', $participantFlow['ParticipantFlow']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Participant Flow'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
