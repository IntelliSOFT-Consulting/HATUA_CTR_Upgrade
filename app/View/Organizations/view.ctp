<div class="organizations view">
<h2><?php  echo __('Organization'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organization['Application']['id'], array('controller' => 'applications', 'action' => 'view', $organization['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['organization']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone Number'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['telephone_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('All Tasks'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['all_tasks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Monitoring'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['monitoring']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regulatory'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['regulatory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Investigator Recruitment'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['investigator_recruitment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ivrs Treatment Randomisation'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['ivrs_treatment_randomisation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Management'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['data_management']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('E Data Capture'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['e_data_capture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Susar Reporting'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['susar_reporting']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality Assurance Auditing'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['quality_assurance_auditing']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Statistical Analysis'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['statistical_analysis']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Medical Writing'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['medical_writing']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other Duties'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['other_duties']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other Duties Specify'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['other_duties_specify']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Misc'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['misc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organization'), array('action' => 'edit', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organization'), array('action' => 'delete', $organization['Organization']['id']), null, __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
