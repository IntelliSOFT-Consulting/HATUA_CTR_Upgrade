<div class="attachments form">
<?php echo $this->Form->create('Attachment'); ?>
	<fieldset>
		<legend><?php echo __('Add Attachment'); ?></legend>
	<?php
		echo $this->Form->input('model');
		echo $this->Form->input('file');
		echo $this->Form->input('foreign_key');
		echo $this->Form->input('dirname');
		echo $this->Form->input('basename');
		echo $this->Form->input('checksum');
		echo $this->Form->input('alternative');
		echo $this->Form->input('group');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
