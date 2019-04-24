<div class="siteDetails form">
<?php echo $this->Form->create('SiteDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Site Detail'); ?></legend>
	<?php
		echo $this->Form->input('application_id');
		echo $this->Form->input('site_name');
		echo $this->Form->input('physical_address');
		echo $this->Form->input('contact_details');
		echo $this->Form->input('contact_person');
		echo $this->Form->input('site_capacity');
		echo $this->Form->input('misc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Site Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
