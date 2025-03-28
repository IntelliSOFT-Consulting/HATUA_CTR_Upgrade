<div class="reviewAnswers form">
<?php echo $this->Form->create('ReviewAnswer'); ?>
	<fieldset>
		<legend><?php echo __('Add Review Answer'); ?></legend>
	<?php
		echo $this->Form->input('review_id');
		echo $this->Form->input('question_type');
		echo $this->Form->input('review_type');
		echo $this->Form->input('question_number');
		echo $this->Form->input('question');
		echo $this->Form->input('answer');
		echo $this->Form->input('workspace');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Review Answers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('controller' => 'reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
	</ul>
</div>
