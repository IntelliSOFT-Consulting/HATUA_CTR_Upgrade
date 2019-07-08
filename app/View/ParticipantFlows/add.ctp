<div class="participantFlows form">
<?php echo $this->Form->create('ParticipantFlow'); ?>
	<fieldset>
		<legend><?php echo __('Add Participant Flow'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('year');
		echo $this->Form->input('original_subjects');
		echo $this->Form->input('consented');
		echo $this->Form->input('screened');
		echo $this->Form->input('enrolled');
		echo $this->Form->input('lost');
		echo $this->Form->input('lost_reason');
		echo $this->Form->input('withdrawn');
		echo $this->Form->input('withdrawal_reason');
		echo $this->Form->input('self_withdrawal');
		echo $this->Form->input('self_withdrawal_reasons');
		echo $this->Form->input('active_subjects');
		echo $this->Form->input('completed_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Participant Flows'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
