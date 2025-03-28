<div class="routes form">
<?php echo $this->Form->create('Route'); ?>
	<fieldset>
		<legend><?php echo __('Add Route'); ?></legend>
	<?php
		echo $this->Form->input('value');
		echo $this->Form->input('name');
		echo $this->Form->input('icsr_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Routes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Concomittant Drugs'), array('controller' => 'concomittant_drugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concomittant Drug'), array('controller' => 'concomittant_drugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suspected Drugs'), array('controller' => 'suspected_drugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suspected Drug'), array('controller' => 'suspected_drugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
