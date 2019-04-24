<div class="placebos index">
	<h2><?php echo __('Placebos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('application_id'); ?></th>
			<th><?php echo $this->Paginator->sort('placebo_present'); ?></th>
			<th><?php echo $this->Paginator->sort('pharmaceutical_form'); ?></th>
			<th><?php echo $this->Paginator->sort('route_of_administration'); ?></th>
			<th><?php echo $this->Paginator->sort('composition'); ?></th>
			<th><?php echo $this->Paginator->sort('identical_indp'); ?></th>
			<th><?php echo $this->Paginator->sort('major_ingredients'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($placebos as $placebo): ?>
	<tr>
		<td><?php echo h($placebo['Placebo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($placebo['Application']['id'], array('controller' => 'applications', 'action' => 'view', $placebo['Application']['id'])); ?>
		</td>
		<td><?php echo h($placebo['Placebo']['placebo_present']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['pharmaceutical_form']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['route_of_administration']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['composition']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['identical_indp']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['major_ingredients']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['created']); ?>&nbsp;</td>
		<td><?php echo h($placebo['Placebo']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $placebo['Placebo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $placebo['Placebo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $placebo['Placebo']['id']), null, __('Are you sure you want to delete # %s?', $placebo['Placebo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Placebo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
