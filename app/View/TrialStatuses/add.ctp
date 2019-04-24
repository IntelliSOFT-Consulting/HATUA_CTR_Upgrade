<div class="trialStatuses form">
<?php echo $this->Form->create('TrialStatus'); ?>
	<fieldset>
		<legend><?php echo __('Add Trial Status'); ?></legend>
	<?php
		echo $this->Form->input('value');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Trial Statuses'), array('action' => 'index')); ?></li>
	</ul>
</div>
