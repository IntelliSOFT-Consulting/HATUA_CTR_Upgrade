<div class="organizations index">
	<h2><?php echo __('Organizations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_person'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('telephone_number'); ?></th>
			<th><?php echo $this->Paginator->sort('all_tasks'); ?></th>
			<th><?php echo $this->Paginator->sort('monitoring'); ?></th>
			<th><?php echo $this->Paginator->sort('regulatory'); ?></th>
			<th><?php echo $this->Paginator->sort('investigator_recruitment'); ?></th>
			<th><?php echo $this->Paginator->sort('ivrs_treatment_randomisation'); ?></th>
			<th><?php echo $this->Paginator->sort('data_management'); ?></th>
			<th><?php echo $this->Paginator->sort('e_data_capture'); ?></th>
			<th><?php echo $this->Paginator->sort('susar_reporting'); ?></th>
			<th><?php echo $this->Paginator->sort('quality_assurance_auditing'); ?></th>
			<th><?php echo $this->Paginator->sort('statistical_analysis'); ?></th>
			<th><?php echo $this->Paginator->sort('medical_writing'); ?></th>
			<th><?php echo $this->Paginator->sort('other_duties'); ?></th>
			<th><?php echo $this->Paginator->sort('other_duties_specify'); ?></th>
			<th><?php echo $this->Paginator->sort('misc'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($organizations as $organization): ?>
	<tr>
		<td><?php echo h($organization['Organization']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organization['Application']['id'], array('controller' => 'applications', 'action' => 'view', $organization['Application']['id'])); ?>
		</td>
		<td><?php echo h($organization['Organization']['organization']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['contact_person']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['address']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['telephone_number']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['all_tasks']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['monitoring']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['regulatory']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['investigator_recruitment']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['ivrs_treatment_randomisation']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['data_management']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['e_data_capture']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['susar_reporting']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['quality_assurance_auditing']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['statistical_analysis']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['medical_writing']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['other_duties']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['other_duties_specify']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['misc']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['created']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organization['Organization']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organization['Organization']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organization['Organization']['id']), null, __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Organization'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
