<div class="pharmacists index">
	<h2><?php echo __('Pharmacists'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('reg_no'); ?></th>
			<th><?php echo $this->Paginator->sort('given_name'); ?></th>
			<th><?php echo $this->Paginator->sort('premise_name'); ?></th>
			<th><?php echo $this->Paginator->sort('qualification'); ?></th>
			<th><?php echo $this->Paginator->sort('professional_address'); ?></th>
			<th><?php echo $this->Paginator->sort('valid_year'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile'); ?></th>
			<th><?php echo $this->Paginator->sort('telephone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($pharmacists as $pharmacist): ?>
	<tr>
		<td><?php echo h($pharmacist['Pharmacist']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pharmacist['Application']['id'], array('controller' => 'applications', 'action' => 'view', $pharmacist['Application']['id'])); ?>
		</td>
		<td><?php echo h($pharmacist['Pharmacist']['reg_no']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['given_name']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['premise_name']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['qualification']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['professional_address']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['valid_year']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['mobile']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['telephone']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['email']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['created']); ?>&nbsp;</td>
		<td><?php echo h($pharmacist['Pharmacist']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pharmacist['Pharmacist']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pharmacist['Pharmacist']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pharmacist['Pharmacist']['id']), null, __('Are you sure you want to delete # %s?', $pharmacist['Pharmacist']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Pharmacist'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
