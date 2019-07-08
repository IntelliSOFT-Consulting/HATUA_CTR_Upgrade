<div class="participantFlows view">
<h2><?php  echo __('Participant Flow'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($participantFlow['Application']['id'], array('controller' => 'applications', 'action' => 'view', $participantFlow['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Original Subjects'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['original_subjects']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Consented'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['consented']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Screened'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['screened']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enrolled'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['enrolled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lost'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['lost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lost Reason'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['lost_reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Withdrawn'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['withdrawn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Withdrawal Reason'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['withdrawal_reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Self Withdrawal'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['self_withdrawal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Self Withdrawal Reasons'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['self_withdrawal_reasons']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active Subjects'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['active_subjects']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed Number'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['completed_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($participantFlow['ParticipantFlow']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Participant Flow'), array('action' => 'edit', $participantFlow['ParticipantFlow']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Participant Flow'), array('action' => 'delete', $participantFlow['ParticipantFlow']['id']), null, __('Are you sure you want to delete # %s?', $participantFlow['ParticipantFlow']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Participant Flows'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant Flow'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
