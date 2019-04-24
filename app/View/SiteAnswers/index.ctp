<div class="siteAnswers index">
	<h2><?php echo __('Site Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('site_inspection_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_type'); ?></th>
			<th><?php echo $this->Paginator->sort('question_number'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('answer'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($siteAnswers as $siteAnswer): ?>
	<tr>
		<td><?php echo h($siteAnswer['SiteAnswer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($siteAnswer['SiteInspection']['id'], array('controller' => 'site_inspections', 'action' => 'view', $siteAnswer['SiteInspection']['id'])); ?>
		</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['question_type']); ?>&nbsp;</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['question_number']); ?>&nbsp;</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['question']); ?>&nbsp;</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['answer']); ?>&nbsp;</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['comment']); ?>&nbsp;</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['created']); ?>&nbsp;</td>
		<td><?php echo h($siteAnswer['SiteAnswer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $siteAnswer['SiteAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $siteAnswer['SiteAnswer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $siteAnswer['SiteAnswer']['id']), null, __('Are you sure you want to delete # %s?', $siteAnswer['SiteAnswer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Site Answer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Site Inspections'), array('controller' => 'site_inspections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Inspection'), array('controller' => 'site_inspections', 'action' => 'add')); ?> </li>
	</ul>
</div>
