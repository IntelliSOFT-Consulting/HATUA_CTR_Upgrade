<div class="organizations form">
<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend><?php echo __('Add Organization'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('organization');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('address');
		echo $this->Form->input('telephone_number');
		echo $this->Form->input('all_tasks');
		echo $this->Form->input('monitoring');
		echo $this->Form->input('regulatory');
		echo $this->Form->input('investigator_recruitment');
		echo $this->Form->input('ivrs_treatment_randomisation');
		echo $this->Form->input('data_management');
		echo $this->Form->input('e_data_capture');
		echo $this->Form->input('susar_reporting');
		echo $this->Form->input('quality_assurance_auditing');
		echo $this->Form->input('statistical_analysis');
		echo $this->Form->input('medical_writing');
		echo $this->Form->input('other_duties');
		echo $this->Form->input('other_duties_specify');
		echo $this->Form->input('misc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
