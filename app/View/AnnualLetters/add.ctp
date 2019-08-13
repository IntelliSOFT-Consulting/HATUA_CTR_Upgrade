<div class="AnnualLetters form">
<?php echo $this->Form->create('AnnualLetter'); ?>
	<fieldset>
		<legend><?php echo __('Add Approval Letter'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('approval_no');
		echo $this->Form->input('content');
		echo $this->Form->input('approver');
		echo $this->Form->input('approval_date');
		echo $this->Form->input('status');
		echo $this->Form->input('deleted');
		echo $this->Form->input('deleted_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Approval Letters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
