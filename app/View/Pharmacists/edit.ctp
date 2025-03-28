<div class="pharmacists form">
<?php echo $this->Form->create('Pharmacist'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pharmacist'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('reg_no');
		echo $this->Form->input('given_name');
		echo $this->Form->input('premise_name');
		echo $this->Form->input('qualification');
		echo $this->Form->input('professional_address');
		echo $this->Form->input('valid_year');
		echo $this->Form->input('mobile');
		echo $this->Form->input('telephone');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pharmacist.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Pharmacist.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pharmacists'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
