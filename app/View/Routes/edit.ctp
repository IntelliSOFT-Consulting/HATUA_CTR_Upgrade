<div class="routes form">
<?php echo $this->Form->create('Route'); ?>
	<fieldset>
		<legend><?php echo __('Edit Route'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Route.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Route.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Routes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Concomittant Drugs'), array('controller' => 'concomittant_drugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concomittant Drug'), array('controller' => 'concomittant_drugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suspected Drugs'), array('controller' => 'suspected_drugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suspected Drug'), array('controller' => 'suspected_drugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
