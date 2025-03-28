<div class="reassignments index">
	<h2><?php echo __('Reassignments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('orig_user'); ?></th>
			<th><?php echo $this->Paginator->sort('new_user'); ?></th>
			<th><?php echo $this->Paginator->sort('assigning_user'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($reassignments as $reassignment): ?>
	<tr>
		<td><?php echo h($reassignment['Reassignment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reassignment['Application']['id'], array('controller' => 'applications', 'action' => 'view', $reassignment['Application']['id'])); ?>
		</td>
		<td><?php echo h($reassignment['Reassignment']['orig_user']); ?>&nbsp;</td>
		<td><?php echo h($reassignment['Reassignment']['new_user']); ?>&nbsp;</td>
		<td><?php echo h($reassignment['Reassignment']['assigning_user']); ?>&nbsp;</td>
		<td><?php echo h($reassignment['Reassignment']['created']); ?>&nbsp;</td>
		<td><?php echo h($reassignment['Reassignment']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reassignment['Reassignment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reassignment['Reassignment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reassignment['Reassignment']['id']), null, __('Are you sure you want to delete # %s?', $reassignment['Reassignment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Reassignment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
