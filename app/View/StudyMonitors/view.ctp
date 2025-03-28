<div class="studyMonitors view">
<h2><?php  echo __('Study Monitor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($studyMonitor['StudyMonitor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($studyMonitor['User']['name'], array('controller' => 'users', 'action' => 'view', $studyMonitor['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($studyMonitor['Application']['id'], array('controller' => 'applications', 'action' => 'view', $studyMonitor['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amendment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($studyMonitor['Amendment']['id'], array('controller' => 'amendments', 'action' => 'view', $studyMonitor['Amendment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($studyMonitor['StudyMonitor']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($studyMonitor['StudyMonitor']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Study Monitor'), array('action' => 'edit', $studyMonitor['StudyMonitor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Study Monitor'), array('action' => 'delete', $studyMonitor['StudyMonitor']['id']), null, __('Are you sure you want to delete # %s?', $studyMonitor['StudyMonitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Study Monitors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Study Monitor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Amendments'), array('controller' => 'amendments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Amendment'), array('controller' => 'amendments', 'action' => 'add')); ?> </li>
	</ul>
</div>
