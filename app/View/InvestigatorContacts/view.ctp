<div class="investigatorContacts view">
<h2><?php  echo __('Investigator Contact'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($investigatorContact['Application']['id'], array('controller' => 'applications', 'action' => 'view', $investigatorContact['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Given Name'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['given_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['middle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Family Name'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['family_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qualification'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['qualification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Professional Address'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['professional_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['telephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($investigatorContact['InvestigatorContact']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Investigator Contact'), array('action' => 'edit', $investigatorContact['InvestigatorContact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Investigator Contact'), array('action' => 'delete', $investigatorContact['InvestigatorContact']['id']), null, __('Are you sure you want to delete # %s?', $investigatorContact['InvestigatorContact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Investigator Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Investigator Contact'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
