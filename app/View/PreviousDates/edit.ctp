<div class="previousDates form">
<?php echo $this->Form->create('PreviousDate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Previous Date'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('date_of_previous_protocol');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PreviousDate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PreviousDate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Previous Dates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
