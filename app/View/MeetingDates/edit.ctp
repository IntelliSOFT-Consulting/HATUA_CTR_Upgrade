<div class="meetingDates form">
<?php echo $this->Form->create('MeetingDate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Meeting Date'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		echo $this->Form->input('proposed_date1');
		echo $this->Form->input('proposed_date2');
		echo $this->Form->input('Address');
		echo $this->Form->input('disease_background');
		echo $this->Form->input('product_background');
		echo $this->Form->input('quality_development');
		echo $this->Form->input('non_clinical_development');
		echo $this->Form->input('clinical_development');
		echo $this->Form->input('regulatory_status');
		echo $this->Form->input('advice_rationale');
		echo $this->Form->input('proposed_questions');
		echo $this->Form->input('deleted');
		echo $this->Form->input('deleted_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MeetingDate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MeetingDate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Meeting Dates'), array('action' => 'index')); ?></li>
	</ul>
</div>
