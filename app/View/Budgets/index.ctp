<div class="budgets index">
	<h2><?php echo __('Budgets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('budget_period'); ?></th>
			<th><?php echo $this->Paginator->sort('personnel_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('personnel'); ?></th>
			<th><?php echo $this->Paginator->sort('transport_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('transport'); ?></th>
			<th><?php echo $this->Paginator->sort('field_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('field'); ?></th>
			<th><?php echo $this->Paginator->sort('supplies_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('supplies'); ?></th>
			<th><?php echo $this->Paginator->sort('pharmacy_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('pharmacy'); ?></th>
			<th><?php echo $this->Paginator->sort('travel_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('travel'); ?></th>
			<th><?php echo $this->Paginator->sort('regulatory_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('regulatory'); ?></th>
			<th><?php echo $this->Paginator->sort('it_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('it'); ?></th>
			<th><?php echo $this->Paginator->sort('lab_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('lab'); ?></th>
			<th><?php echo $this->Paginator->sort('hdss_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('hdss'); ?></th>
			<th><?php echo $this->Paginator->sort('kemri_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('kemri'); ?></th>
			<th><?php echo $this->Paginator->sort('wrair_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('wrair'); ?></th>
			<th><?php echo $this->Paginator->sort('subject_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('grand_currency'); ?></th>
			<th><?php echo $this->Paginator->sort('grand_total'); ?></th>
			<th><?php echo $this->Paginator->sort('study_information'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($budgets as $budget): ?>
	<tr>
		<td><?php echo h($budget['Budget']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($budget['Application']['id'], array('controller' => 'applications', 'action' => 'view', $budget['Application']['id'])); ?>
		</td>
		<td><?php echo h($budget['Budget']['year']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['budget_period']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['personnel_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['personnel']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['transport_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['transport']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['field_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['field']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['supplies_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['supplies']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['pharmacy_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['pharmacy']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['travel_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['travel']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['regulatory_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['regulatory']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['it_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['it']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['lab_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['lab']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['hdss_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['hdss']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['kemri_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['kemri']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['wrair_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['wrair']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['subject_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['subject']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['grand_currency']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['grand_total']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['study_information']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['created']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $budget['Budget']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $budget['Budget']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $budget['Budget']['id']), null, __('Are you sure you want to delete # %s?', $budget['Budget']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Budget'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
