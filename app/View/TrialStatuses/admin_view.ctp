<div class="trialStatuses view">
<h2><?php  echo __('Trial Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($trialStatus['TrialStatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($trialStatus['TrialStatus']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($trialStatus['TrialStatus']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($trialStatus['TrialStatus']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($trialStatus['TrialStatus']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Trial Status'), array('action' => 'edit', $trialStatus['TrialStatus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Trial Status'), array('action' => 'delete', $trialStatus['TrialStatus']['id']), null, __('Are you sure you want to delete # %s?', $trialStatus['TrialStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trial Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trial Status'), array('action' => 'add')); ?> </li>
	</ul>
</div>
