<div class="deviations form">
<?php echo $this->Form->create('Deviation'); ?>
	<fieldset>
		<legend><?php echo __('Add Deviation'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('study_title');
		echo $this->Form->input('pi_name');
		echo $this->Form->input('deviation_date');
		echo $this->Form->input('participant_number');
		echo $this->Form->input('treating_physician');
		echo $this->Form->input('deviation_description');
		echo $this->Form->input('deviation_explanation');
		echo $this->Form->input('deviation_measures');
		echo $this->Form->input('deviation_preclude');
		echo $this->Form->input('sponsor_notified');
		echo $this->Form->input('sponsor_explanation');
		echo $this->Form->input('study_impact');
		echo $this->Form->input('deleted');
		echo $this->Form->input('deleted_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Deviations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
