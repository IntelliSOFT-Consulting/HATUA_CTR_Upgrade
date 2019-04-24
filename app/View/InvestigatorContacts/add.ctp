<div class="investigatorContacts form">
<?php echo $this->Form->create('InvestigatorContact'); ?>
	<fieldset>
		<legend><?php echo __('Add Investigator Contact'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('given_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('family_name');
		echo $this->Form->input('qualification');
		echo $this->Form->input('professional_address');
		echo $this->Form->input('telephone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Investigator Contacts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
