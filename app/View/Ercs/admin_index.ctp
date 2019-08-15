<div class="ercs index">
	<h2><?php echo __('Ercs'); ?></h2>
	<table class="table  table-bordered table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('accrediation_date'); ?></th>
			<th><?php echo $this->Paginator->sort('chairperson'); ?></th>
			<th><?php echo $this->Paginator->sort('host_institution'); ?></th>
			<th><?php echo $this->Paginator->sort('physical_address'); ?></th>
			<th><?php echo $this->Paginator->sort('institution_email'); ?></th>
			<th><?php echo $this->Paginator->sort('area_accredited'); ?></th>
			<th><?php echo $this->Paginator->sort('email_contacts'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($ercs as $erc): ?>
	<tr>
		<td><?php echo h($erc['Erc']['id']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['name']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['accrediation_date']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['chairperson']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['host_institution']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['physical_address']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['institution_email']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['area_accredited']); ?>&nbsp;</td>
		<td><?php echo h($erc['Erc']['email_contacts']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $erc['Erc']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $erc['Erc']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $erc['Erc']['id']), null, __('Are you sure you want to delete # %s?', $erc['Erc']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Erc'), array('action' => 'add')); ?></li>
	</ul>
</div>
