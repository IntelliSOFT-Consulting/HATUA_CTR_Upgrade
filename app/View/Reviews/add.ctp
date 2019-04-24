<div class="reviews form">
<?php echo $this->Form->create('Review'); ?>
	<fieldset>
		<legend><?php echo __('Add Review'); ?></legend>
	<?php
		echo $this->Form->input('reviewer_id');
		echo $this->Form->input('title');
		echo $this->Form->input('text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reviews'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Reviewers'), array('controller' => 'reviewers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reviewer'), array('controller' => 'reviewers', 'action' => 'add')); ?> </li>
	</ul>
</div>
