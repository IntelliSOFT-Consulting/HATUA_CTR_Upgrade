<div class="reviewers view">
<h2><?php  echo __('Reviewer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reviewer['Reviewer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reviewer['User']['name'], array('controller' => 'users', 'action' => 'view', $reviewer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reviewer['Application']['id'], array('controller' => 'applications', 'action' => 'view', $reviewer['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($reviewer['Reviewer']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reviewer['Reviewer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reviewer['Reviewer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reviewer'), array('action' => 'edit', $reviewer['Reviewer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reviewer'), array('action' => 'delete', $reviewer['Reviewer']['id']), null, __('Are you sure you want to delete # %s?', $reviewer['Reviewer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviewers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reviewer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
