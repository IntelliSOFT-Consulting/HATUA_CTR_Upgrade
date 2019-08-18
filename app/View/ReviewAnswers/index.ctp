<div class="reviewAnswers index">
	<h2><?php echo __('Review Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('review_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_type'); ?></th>
			<th><?php echo $this->Paginator->sort('review_type'); ?></th>
			<th><?php echo $this->Paginator->sort('question_number'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('answer'); ?></th>
			<th><?php echo $this->Paginator->sort('workspace'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($reviewAnswers as $reviewAnswer): ?>
	<tr>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reviewAnswer['Review']['title'], array('controller' => 'reviews', 'action' => 'view', $reviewAnswer['Review']['id'])); ?>
		</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['question_type']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['review_type']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['question_number']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['question']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['answer']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['workspace']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['comment']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['created']); ?>&nbsp;</td>
		<td><?php echo h($reviewAnswer['ReviewAnswer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reviewAnswer['ReviewAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reviewAnswer['ReviewAnswer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reviewAnswer['ReviewAnswer']['id']), null, __('Are you sure you want to delete # %s?', $reviewAnswer['ReviewAnswer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Review Answer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('controller' => 'reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
	</ul>
</div>
