<div class="attachments view">
<h2><?php  echo __('Attachment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['file']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachment['Application']['id'], array('controller' => 'applications', 'action' => 'view', $attachment['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dirname'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['dirname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Basename'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['basename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Checksum'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['checksum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alternative'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['alternative']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attachment'), array('action' => 'edit', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attachment'), array('action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
