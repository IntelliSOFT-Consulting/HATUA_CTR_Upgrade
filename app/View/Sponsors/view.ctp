<div class="sponsors view">
<h2><?php  echo __('Sponsor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sponsor['Application']['id'], array('controller' => 'applications', 'action' => 'view', $sponsor['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sponsor'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['sponsor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone Number'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['telephone_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax Number'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['fax_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Number'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['cell_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Address'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['email_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sponsor['Sponsor']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sponsor'), array('action' => 'edit', $sponsor['Sponsor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sponsor'), array('action' => 'delete', $sponsor['Sponsor']['id']), null, __('Are you sure you want to delete # %s?', $sponsor['Sponsor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
