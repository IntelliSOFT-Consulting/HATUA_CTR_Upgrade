<div class="previousDates view">
<h2><?php  echo __('Previous Date'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($previousDate['PreviousDate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($previousDate['Application']['id'], array('controller' => 'applications', 'action' => 'view', $previousDate['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Of Previous Protocol'); ?></dt>
		<dd>
			<?php echo h($previousDate['PreviousDate']['date_of_previous_protocol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($previousDate['PreviousDate']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($previousDate['PreviousDate']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Previous Date'), array('action' => 'edit', $previousDate['PreviousDate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Previous Date'), array('action' => 'delete', $previousDate['PreviousDate']['id']), null, __('Are you sure you want to delete # %s?', $previousDate['PreviousDate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Previous Dates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Previous Date'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
