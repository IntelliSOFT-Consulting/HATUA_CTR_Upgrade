<div class="reviewQuestions view">
<h2><?php  echo __('Review Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Number'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['question_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Type'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['question_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Review Type'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['review_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reviewQuestion['ReviewQuestion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Review Question'), array('action' => 'edit', $reviewQuestion['ReviewQuestion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Review Question'), array('action' => 'delete', $reviewQuestion['ReviewQuestion']['id']), null, __('Are you sure you want to delete # %s?', $reviewQuestion['ReviewQuestion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Review Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review Question'), array('action' => 'add')); ?> </li>
	</ul>
</div>
