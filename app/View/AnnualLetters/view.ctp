<div class="AnnualLetters view">
<h2><?php  echo __('Approval Letter'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($AnnualLetter['Application']['id'], array('controller' => 'applications', 'action' => 'view', $AnnualLetter['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approval No'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['approval_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approver'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['approver']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approval Date'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['approval_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['deleted_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($AnnualLetter['AnnualLetter']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Approval Letter'), array('action' => 'edit', $AnnualLetter['AnnualLetter']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Approval Letter'), array('action' => 'delete', $AnnualLetter['AnnualLetter']['id']), null, __('Are you sure you want to delete # %s?', $AnnualLetter['AnnualLetter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Approval Letters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Approval Letter'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
