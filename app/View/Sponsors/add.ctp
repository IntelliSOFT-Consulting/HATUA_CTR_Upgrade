<div class="sponsors form">
<?php echo $this->Form->create('Sponsor'); ?>
	<fieldset>
		<legend><?php echo __('Add Sponsor'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('sponsor');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('address');
		echo $this->Form->input('telephone_number');
		echo $this->Form->input('fax_number');
		echo $this->Form->input('cell_number');
		echo $this->Form->input('email_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
