<div class="applicationStages view">
<h2><?php  echo __('Application Stage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($applicationStage['ApplicationStage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicationStage['Application']['id'], array('controller' => 'applications', 'action' => 'view', $applicationStage['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stage'); ?></dt>
		<dd>
			<?php echo h($applicationStage['ApplicationStage']['stage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($applicationStage['ApplicationStage']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($applicationStage['ApplicationStage']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($applicationStage['ApplicationStage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($applicationStage['ApplicationStage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Application Stage'), array('action' => 'edit', $applicationStage['ApplicationStage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Application Stage'), array('action' => 'delete', $applicationStage['ApplicationStage']['id']), null, __('Are you sure you want to delete # %s?', $applicationStage['ApplicationStage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Application Stages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application Stage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
