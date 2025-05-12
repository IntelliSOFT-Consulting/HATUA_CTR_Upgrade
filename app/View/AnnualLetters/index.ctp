<div class="AnnualLetters index">
	<h2><?php echo __('Approval Letters'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('approval_no'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('approver'); ?></th>
			<th><?php echo $this->Paginator->sort('approval_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($AnnualLetters as $AnnualLetter): ?>
	<tr>
		<td><?php echo h($AnnualLetter['AnnualLetter']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($AnnualLetter['Application']['id'], array('controller' => 'applications', 'action' => 'view', $AnnualLetter['Application']['id'])); ?>
		</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['approval_no']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['content']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['approver']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['approval_date']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['status']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['deleted_date']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['created']); ?>&nbsp;</td>
		<td><?php echo h($AnnualLetter['AnnualLetter']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $AnnualLetter['AnnualLetter']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $AnnualLetter['AnnualLetter']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $AnnualLetter['AnnualLetter']['id']), null, __('Are you sure you want to delete # %s?', $AnnualLetter['AnnualLetter']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Approval Letter'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
