<div class="pharmacists view">
<h2><?php  echo __('Pharmacist'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pharmacist['Application']['id'], array('controller' => 'applications', 'action' => 'view', $pharmacist['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reg No'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['reg_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Given Name'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['given_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Premise Name'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['premise_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qualification'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['qualification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Professional Address'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['professional_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid Year'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['valid_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['telephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($pharmacist['Pharmacist']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pharmacist'), array('action' => 'edit', $pharmacist['Pharmacist']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Pharmacist'), array('action' => 'delete', $pharmacist['Pharmacist']['id']), null, __('Are you sure you want to delete # %s?', $pharmacist['Pharmacist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pharmacists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pharmacist'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
