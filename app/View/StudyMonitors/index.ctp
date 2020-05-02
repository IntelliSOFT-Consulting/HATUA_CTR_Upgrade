<div class="studyMonitors index">
	<h2><?php echo __('Study Monitors'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('amendment_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($studyMonitors as $studyMonitor): ?>
	<tr>
		<td><?php echo h($studyMonitor['StudyMonitor']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($studyMonitor['User']['name'], array('controller' => 'users', 'action' => 'view', $studyMonitor['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($studyMonitor['Application']['id'], array('controller' => 'applications', 'action' => 'view', $studyMonitor['Application']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($studyMonitor['Amendment']['id'], array('controller' => 'amendments', 'action' => 'view', $studyMonitor['Amendment']['id'])); ?>
		</td>
		<td><?php echo h($studyMonitor['StudyMonitor']['created']); ?>&nbsp;</td>
		<td><?php echo h($studyMonitor['StudyMonitor']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $studyMonitor['StudyMonitor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $studyMonitor['StudyMonitor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $studyMonitor['StudyMonitor']['id']), null, __('Are you sure you want to delete # %s?', $studyMonitor['StudyMonitor']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Study Monitor'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Amendments'), array('controller' => 'amendments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Amendment'), array('controller' => 'amendments', 'action' => 'add')); ?> </li>
	</ul>
</div>
