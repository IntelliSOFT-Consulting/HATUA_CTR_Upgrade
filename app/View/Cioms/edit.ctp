<div class="cioms form">
<?php echo $this->Form->create('Ciom'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ciom'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('reference_no');
		echo $this->Form->input('user_id');
		echo $this->Form->input('reporter_email');
		echo $this->Form->input('e2b_content');
		echo $this->Form->input('e2b_file');
		echo $this->Form->input('file');
		echo $this->Form->input('dirname');
		echo $this->Form->input('basename');
		echo $this->Form->input('checksum');
		echo $this->Form->input('alternative');
		echo $this->Form->input('group');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ciom.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Ciom.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cioms'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
