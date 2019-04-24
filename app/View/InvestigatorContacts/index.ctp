<div class="investigatorContacts index">
	<h2><?php echo __('Investigator Contacts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('given_name'); ?></th>
			<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
			<th><?php echo $this->Paginator->sort('family_name'); ?></th>
			<th><?php echo $this->Paginator->sort('qualification'); ?></th>
			<th><?php echo $this->Paginator->sort('professional_address'); ?></th>
			<th><?php echo $this->Paginator->sort('telephone'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($investigatorContacts as $investigatorContact): ?>
	<tr>
		<td><?php echo h($investigatorContact['InvestigatorContact']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($investigatorContact['Application']['id'], array('controller' => 'applications', 'action' => 'view', $investigatorContact['Application']['id'])); ?>
		</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['given_name']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['middle_name']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['family_name']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['qualification']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['professional_address']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['telephone']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['created']); ?>&nbsp;</td>
		<td><?php echo h($investigatorContact['InvestigatorContact']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $investigatorContact['InvestigatorContact']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $investigatorContact['InvestigatorContact']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $investigatorContact['InvestigatorContact']['id']), null, __('Are you sure you want to delete # %s?', $investigatorContact['InvestigatorContact']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Investigator Contact'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
