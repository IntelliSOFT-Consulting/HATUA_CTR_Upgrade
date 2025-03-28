<div class="reassignments form">
<?php echo $this->Form->create('Reassignment'); ?>
	<fieldset>
		<legend><?php echo __('Add Reassignment'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('orig_user');
		echo $this->Form->input('new_user');
		echo $this->Form->input('assigning_user');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reassignments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
