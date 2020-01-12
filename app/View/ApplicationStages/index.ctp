<div class="applicationStages index">
	<h2><?php echo __('Application Stages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('stage'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($applicationStages as $applicationStage): ?>
	<tr>
		<td><?php echo h($applicationStage['ApplicationStage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($applicationStage['Application']['id'], array('controller' => 'applications', 'action' => 'view', $applicationStage['Application']['id'])); ?>
		</td>
		<td><?php echo h($applicationStage['ApplicationStage']['stage']); ?>&nbsp;</td>
		<td><?php echo h($applicationStage['ApplicationStage']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($applicationStage['ApplicationStage']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($applicationStage['ApplicationStage']['created']); ?>&nbsp;</td>
		<td><?php echo h($applicationStage['ApplicationStage']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $applicationStage['ApplicationStage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $applicationStage['ApplicationStage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $applicationStage['ApplicationStage']['id']), null, __('Are you sure you want to delete # %s?', $applicationStage['ApplicationStage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Application Stage'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
