<div class="reassignments form">
<?php echo $this->Form->create('Reassignment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Reassignment'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Reassignment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Reassignment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reassignments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
