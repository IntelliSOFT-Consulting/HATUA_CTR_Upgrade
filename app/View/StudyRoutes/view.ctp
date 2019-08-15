<div class="studyRoutes view">
<h2><?php  echo __('Study Route'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($studyRoute['StudyRoute']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($studyRoute['Application']['id'], array('controller' => 'applications', 'action' => 'view', $studyRoute['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Of Previous Protocol'); ?></dt>
		<dd>
			<?php echo h($studyRoute['StudyRoute']['date_of_previous_protocol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($studyRoute['StudyRoute']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($studyRoute['StudyRoute']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Study Route'), array('action' => 'edit', $studyRoute['StudyRoute']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Study Route'), array('action' => 'delete', $studyRoute['StudyRoute']['id']), null, __('Are you sure you want to delete # %s?', $studyRoute['StudyRoute']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Study Routes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Study Route'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
