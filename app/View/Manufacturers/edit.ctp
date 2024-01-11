<div class="manufacturers form">
<?php echo $this->Form->create('Manufacturer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Manufacturer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('manufacturer_name');
		echo $this->Form->input('address');
		echo $this->Form->input('manufacturer_country');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Manufacturer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Manufacturer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Manufacturers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
