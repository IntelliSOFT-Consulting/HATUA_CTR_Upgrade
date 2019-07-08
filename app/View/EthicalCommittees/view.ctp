<div class="ethicalCommittees view">
<h2><?php  echo __('Ethical Committee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ethicalCommittee['Application']['id'], array('controller' => 'applications', 'action' => 'view', $ethicalCommittee['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ethical Committee'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['ethical_committee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Submission Date'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['submission_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Erc Number'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['erc_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Initial Approval'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['initial_approval']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($ethicalCommittee['EthicalCommittee']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ethical Committee'), array('action' => 'edit', $ethicalCommittee['EthicalCommittee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ethical Committee'), array('action' => 'delete', $ethicalCommittee['EthicalCommittee']['id']), null, __('Are you sure you want to delete # %s?', $ethicalCommittee['EthicalCommittee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ethical Committees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ethical Committee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
