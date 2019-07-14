<div class="budgets form">
<?php echo $this->Form->create('Budget'); ?>
	<fieldset>
		<legend><?php echo __('Add Budget'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('year');
		echo $this->Form->input('budget_period');
		echo $this->Form->input('personnel_currency');
		echo $this->Form->input('personnel');
		echo $this->Form->input('transport_currency');
		echo $this->Form->input('transport');
		echo $this->Form->input('field_currency');
		echo $this->Form->input('field');
		echo $this->Form->input('supplies_currency');
		echo $this->Form->input('supplies');
		echo $this->Form->input('pharmacy_currency');
		echo $this->Form->input('pharmacy');
		echo $this->Form->input('travel_currency');
		echo $this->Form->input('travel');
		echo $this->Form->input('regulatory_currency');
		echo $this->Form->input('regulatory');
		echo $this->Form->input('it_currency');
		echo $this->Form->input('it');
		echo $this->Form->input('lab_currency');
		echo $this->Form->input('lab');
		echo $this->Form->input('hdss_currency');
		echo $this->Form->input('hdss');
		echo $this->Form->input('kemri_currency');
		echo $this->Form->input('kemri');
		echo $this->Form->input('wrair_currency');
		echo $this->Form->input('wrair');
		echo $this->Form->input('subject_currency');
		echo $this->Form->input('subject');
		echo $this->Form->input('grand_currency');
		echo $this->Form->input('grand_total');
		echo $this->Form->input('study_information');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Budgets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
