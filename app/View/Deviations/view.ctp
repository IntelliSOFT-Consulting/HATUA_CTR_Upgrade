<div class="deviations view">
<h2><?php  echo __('Deviation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deviation['Application']['id'], array('controller' => 'applications', 'action' => 'view', $deviation['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Study Title'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['study_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pi Name'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['pi_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deviation Date'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deviation_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Participant Number'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['participant_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Treating Physician'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['treating_physician']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deviation Description'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deviation_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deviation Explanation'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deviation_explanation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deviation Measures'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deviation_measures']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deviation Preclude'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deviation_preclude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sponsor Notified'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['sponsor_notified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sponsor Explanation'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['sponsor_explanation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Study Impact'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['study_impact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['deleted_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($deviation['Deviation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Deviation'), array('action' => 'edit', $deviation['Deviation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Deviation'), array('action' => 'delete', $deviation['Deviation']['id']), null, __('Are you sure you want to delete # %s?', $deviation['Deviation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Deviations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deviation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
