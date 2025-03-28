<div class="meetingDates index">
	<h2><?php echo __('Meeting Dates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('proposed_date1'); ?></th>
			<th><?php echo $this->Paginator->sort('proposed_date2'); ?></th>
			<th><?php echo $this->Paginator->sort('Address'); ?></th>
			<th><?php echo $this->Paginator->sort('disease_background'); ?></th>
			<th><?php echo $this->Paginator->sort('product_background'); ?></th>
			<th><?php echo $this->Paginator->sort('quality_development'); ?></th>
			<th><?php echo $this->Paginator->sort('non_clinical_development'); ?></th>
			<th><?php echo $this->Paginator->sort('clinical_development'); ?></th>
			<th><?php echo $this->Paginator->sort('regulatory_status'); ?></th>
			<th><?php echo $this->Paginator->sort('advice_rationale'); ?></th>
			<th><?php echo $this->Paginator->sort('proposed_questions'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($meetingDates as $meetingDate): ?>
	<tr>
		<td><?php echo h($meetingDate['MeetingDate']['id']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['email']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['proposed_date1']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['proposed_date2']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['Address']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['disease_background']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['product_background']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['quality_development']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['non_clinical_development']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['clinical_development']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['regulatory_status']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['advice_rationale']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['proposed_questions']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['deleted_date']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['created']); ?>&nbsp;</td>
		<td><?php echo h($meetingDate['MeetingDate']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $meetingDate['MeetingDate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $meetingDate['MeetingDate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $meetingDate['MeetingDate']['id']), null, __('Are you sure you want to delete # %s?', $meetingDate['MeetingDate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Meeting Date'), array('action' => 'add')); ?></li>
	</ul>
</div>
