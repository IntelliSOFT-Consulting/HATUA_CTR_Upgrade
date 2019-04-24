<div class="placebos form">
<?php echo $this->Form->create('Placebo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Placebo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('placebo_present');
		echo $this->Form->input('pharmaceutical_form');
		echo $this->Form->input('route_of_administration');
		echo $this->Form->input('composition');
		echo $this->Form->input('identical_indp');
		echo $this->Form->input('major_ingredients');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Placebo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Placebo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Placebos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
