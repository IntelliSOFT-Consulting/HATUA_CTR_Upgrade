<div class="ercs form">
<?php echo $this->Form->create('Erc'); ?>
	<fieldset>
		<legend><?php echo __('Edit Erc'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('accrediation_date');
		echo $this->Form->input('chairperson');
		echo $this->Form->input('host_institution');
		echo $this->Form->input('physical_address');
		echo $this->Form->input('institution_email');
		echo $this->Form->input('area_accredited');
		echo $this->Form->input('email_contacts');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Erc.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Erc.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ercs'), array('action' => 'index')); ?></li>
	</ul>
</div>
