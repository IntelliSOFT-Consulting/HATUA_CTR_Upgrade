<div class="siteAnswers form">
<?php echo $this->Form->create('SiteAnswer'); ?>
	<fieldset>
		<legend><?php echo __('Add Site Answer'); ?></legend>
	<?php
		echo $this->Form->input('site_inspection_id');
		echo $this->Form->input('question_type');
		echo $this->Form->input('question_number');
		echo $this->Form->input('question');
		echo $this->Form->input('answer');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Site Answers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Site Inspections'), array('controller' => 'site_inspections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Inspection'), array('controller' => 'site_inspections', 'action' => 'add')); ?> </li>
	</ul>
</div>
