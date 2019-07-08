<div class="ethicalCommittees form">
<?php echo $this->Form->create('EthicalCommittee'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ethical Committee'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('ethical_committee');
		echo $this->Form->input('submission_date');
		echo $this->Form->input('erc_number');
		echo $this->Form->input('initial_approval');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EthicalCommittee.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EthicalCommittee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ethical Committees'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
