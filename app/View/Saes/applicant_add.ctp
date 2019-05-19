<div class="saes form">
<?php echo $this->Form->create('Sae'); ?>
	<fieldset>
		<legend><?php echo __('Add Sae'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('patient_initials');
		echo $this->Form->input('country');
		echo $this->Form->input('date_of_birth');
		echo $this->Form->input('age_years');
		echo $this->Form->input('reaction_onset');
		echo $this->Form->input('patient_died');
		echo $this->Form->input('prolonged_hospitalization');
		echo $this->Form->input('incapacity');
		echo $this->Form->input('life_threatening');
		echo $this->Form->input('reaction_description');
		echo $this->Form->input('relevant_history');
		echo $this->Form->input('manufacturer_name');
		echo $this->Form->input('mfr_no');
		echo $this->Form->input('manufacturer_date');
		echo $this->Form->input('source_study');
		echo $this->Form->input('source_literature');
		echo $this->Form->input('source_health_professional');
		echo $this->Form->input('report_date');
		echo $this->Form->input('report_type');
		echo $this->Form->input('approved');
		echo $this->Form->input('approved_by');
		echo $this->Form->input('deleted');
		echo $this->Form->input('deleted_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Saes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
