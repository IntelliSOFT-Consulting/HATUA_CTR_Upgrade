<div class="previousDates form">
<?php echo $this->Form->create('PreviousDate'); ?>
	<fieldset>
		<legend><?php echo __('Add Previous Date'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('date_of_previous_protocol');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Previous Dates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
