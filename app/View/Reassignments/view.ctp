<div class="reassignments view">
<h2><?php  echo __('Reassignment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reassignment['Reassignment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reassignment['Application']['id'], array('controller' => 'applications', 'action' => 'view', $reassignment['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orig User'); ?></dt>
		<dd>
			<?php echo h($reassignment['Reassignment']['orig_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('New User'); ?></dt>
		<dd>
			<?php echo h($reassignment['Reassignment']['new_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assigning User'); ?></dt>
		<dd>
			<?php echo h($reassignment['Reassignment']['assigning_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reassignment['Reassignment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reassignment['Reassignment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reassignment'), array('action' => 'edit', $reassignment['Reassignment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reassignment'), array('action' => 'delete', $reassignment['Reassignment']['id']), null, __('Are you sure you want to delete # %s?', $reassignment['Reassignment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reassignments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reassignment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
