<div class="reviewers index">
	<h2><?php echo __('Reviewers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($reviewers as $reviewer): ?>
	<tr>
		<td><?php echo h($reviewer['Reviewer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reviewer['User']['name'], array('controller' => 'users', 'action' => 'view', $reviewer['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($reviewer['Application']['id'], array('controller' => 'applications', 'action' => 'view', $reviewer['Application']['id'])); ?>
		</td>
		<td><?php echo h($reviewer['Reviewer']['description']); ?>&nbsp;</td>
		<td><?php echo h($reviewer['Reviewer']['created']); ?>&nbsp;</td>
		<td><?php echo h($reviewer['Reviewer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reviewer['Reviewer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reviewer['Reviewer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reviewer['Reviewer']['id']), null, __('Are you sure you want to delete # %s?', $reviewer['Reviewer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Reviewer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
