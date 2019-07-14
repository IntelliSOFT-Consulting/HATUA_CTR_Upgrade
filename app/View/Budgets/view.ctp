<div class="budgets view">
<h2><?php  echo __('Budget'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($budget['Application']['id'], array('controller' => 'applications', 'action' => 'view', $budget['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Budget Period'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['budget_period']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Personnel Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['personnel_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Personnel'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['personnel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transport Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['transport_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transport'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['transport']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['field_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['field']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplies Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['supplies_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplies'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['supplies']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pharmacy Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['pharmacy_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pharmacy'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['pharmacy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Travel Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['travel_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Travel'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['travel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regulatory Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['regulatory_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regulatory'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['regulatory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('It Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['it_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('It'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['it']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lab Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['lab_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lab'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['lab']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hdss Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['hdss_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hdss'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['hdss']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kemri Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['kemri_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kemri'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['kemri']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wrair Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['wrair_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wrair'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['wrair']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['subject_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grand Currency'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['grand_currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grand Total'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['grand_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Study Information'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['study_information']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Budget'), array('action' => 'edit', $budget['Budget']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Budget'), array('action' => 'delete', $budget['Budget']['id']), null, __('Are you sure you want to delete # %s?', $budget['Budget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Budgets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Budget'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
