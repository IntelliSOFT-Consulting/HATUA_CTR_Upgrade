<div class="meetingDates view">
<h2><?php  echo __('Meeting Date'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proposed Date1'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['proposed_date1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proposed Date2'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['proposed_date2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['Address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disease Background'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['disease_background']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Background'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['product_background']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality Development'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['quality_development']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Non Clinical Development'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['non_clinical_development']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Clinical Development'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['clinical_development']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regulatory Status'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['regulatory_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Advice Rationale'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['advice_rationale']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Proposed Questions'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['proposed_questions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['deleted_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($meetingDate['MeetingDate']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Meeting Date'), array('action' => 'edit', $meetingDate['MeetingDate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Meeting Date'), array('action' => 'delete', $meetingDate['MeetingDate']['id']), null, __('Are you sure you want to delete # %s?', $meetingDate['MeetingDate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Meeting Dates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meeting Date'), array('action' => 'add')); ?> </li>
	</ul>
</div>
