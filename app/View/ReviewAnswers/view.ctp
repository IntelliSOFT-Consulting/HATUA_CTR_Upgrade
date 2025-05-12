<div class="reviewAnswers view">
<h2><?php  echo __('Review Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Review'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reviewAnswer['Review']['title'], array('controller' => 'reviews', 'action' => 'view', $reviewAnswer['Review']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Type'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['question_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Review Type'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['review_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Number'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['question_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Workspace'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['workspace']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reviewAnswer['ReviewAnswer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Review Answer'), array('action' => 'edit', $reviewAnswer['ReviewAnswer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Review Answer'), array('action' => 'delete', $reviewAnswer['ReviewAnswer']['id']), null, __('Are you sure you want to delete # %s?', $reviewAnswer['ReviewAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Review Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('controller' => 'reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
	</ul>
</div>
