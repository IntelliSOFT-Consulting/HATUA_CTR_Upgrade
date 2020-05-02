<div class="studyMonitors form">
<?php echo $this->Form->create('StudyMonitor'); ?>
	<fieldset>
		<legend><?php echo __('Edit Study Monitor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('amendment_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StudyMonitor.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('StudyMonitor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Study Monitors'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Amendments'), array('controller' => 'amendments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Amendment'), array('controller' => 'amendments', 'action' => 'add')); ?> </li>
	</ul>
</div>
