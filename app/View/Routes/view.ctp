<div class="routes view">
<h2><?php  echo __('Route'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($route['Route']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($route['Route']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($route['Route']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icsr Code'); ?></dt>
		<dd>
			<?php echo h($route['Route']['icsr_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($route['Route']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($route['Route']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Route'), array('action' => 'edit', $route['Route']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Route'), array('action' => 'delete', $route['Route']['id']), null, __('Are you sure you want to delete # %s?', $route['Route']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Routes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Route'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Concomittant Drugs'), array('controller' => 'concomittant_drugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Concomittant Drug'), array('controller' => 'concomittant_drugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suspected Drugs'), array('controller' => 'suspected_drugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suspected Drug'), array('controller' => 'suspected_drugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Concomittant Drugs'); ?></h3>
	<?php if (!empty($route['ConcomittantDrug'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sae Id'); ?></th>
		<th><?php echo __('Generic Name'); ?></th>
		<th><?php echo __('Dose'); ?></th>
		<th><?php echo __('Route Id'); ?></th>
		<th><?php echo __('Indication'); ?></th>
		<th><?php echo __('Date From'); ?></th>
		<th><?php echo __('Date To'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Deleted Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($route['ConcomittantDrug'] as $concomittantDrug): ?>
		<tr>
			<td><?php echo $concomittantDrug['id']; ?></td>
			<td><?php echo $concomittantDrug['sae_id']; ?></td>
			<td><?php echo $concomittantDrug['generic_name']; ?></td>
			<td><?php echo $concomittantDrug['dose']; ?></td>
			<td><?php echo $concomittantDrug['route_id']; ?></td>
			<td><?php echo $concomittantDrug['indication']; ?></td>
			<td><?php echo $concomittantDrug['date_from']; ?></td>
			<td><?php echo $concomittantDrug['date_to']; ?></td>
			<td><?php echo $concomittantDrug['description']; ?></td>
			<td><?php echo $concomittantDrug['deleted']; ?></td>
			<td><?php echo $concomittantDrug['deleted_date']; ?></td>
			<td><?php echo $concomittantDrug['created']; ?></td>
			<td><?php echo $concomittantDrug['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'concomittant_drugs', 'action' => 'view', $concomittantDrug['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'concomittant_drugs', 'action' => 'edit', $concomittantDrug['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'concomittant_drugs', 'action' => 'delete', $concomittantDrug['id']), null, __('Are you sure you want to delete # %s?', $concomittantDrug['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Concomittant Drug'), array('controller' => 'concomittant_drugs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Suspected Drugs'); ?></h3>
	<?php if (!empty($route['SuspectedDrug'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sae Id'); ?></th>
		<th><?php echo __('Generic Name'); ?></th>
		<th><?php echo __('Dose'); ?></th>
		<th><?php echo __('Route Id'); ?></th>
		<th><?php echo __('Indication'); ?></th>
		<th><?php echo __('Date From'); ?></th>
		<th><?php echo __('Date To'); ?></th>
		<th><?php echo __('Therapy Duration'); ?></th>
		<th><?php echo __('Reaction Abate'); ?></th>
		<th><?php echo __('Reaction Reappear'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Deleted Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($route['SuspectedDrug'] as $suspectedDrug): ?>
		<tr>
			<td><?php echo $suspectedDrug['id']; ?></td>
			<td><?php echo $suspectedDrug['sae_id']; ?></td>
			<td><?php echo $suspectedDrug['generic_name']; ?></td>
			<td><?php echo $suspectedDrug['dose']; ?></td>
			<td><?php echo $suspectedDrug['route_id']; ?></td>
			<td><?php echo $suspectedDrug['indication']; ?></td>
			<td><?php echo $suspectedDrug['date_from']; ?></td>
			<td><?php echo $suspectedDrug['date_to']; ?></td>
			<td><?php echo $suspectedDrug['therapy_duration']; ?></td>
			<td><?php echo $suspectedDrug['reaction_abate']; ?></td>
			<td><?php echo $suspectedDrug['reaction_reappear']; ?></td>
			<td><?php echo $suspectedDrug['deleted']; ?></td>
			<td><?php echo $suspectedDrug['deleted_date']; ?></td>
			<td><?php echo $suspectedDrug['created']; ?></td>
			<td><?php echo $suspectedDrug['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'suspected_drugs', 'action' => 'view', $suspectedDrug['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'suspected_drugs', 'action' => 'edit', $suspectedDrug['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'suspected_drugs', 'action' => 'delete', $suspectedDrug['id']), null, __('Are you sure you want to delete # %s?', $suspectedDrug['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Suspected Drug'), array('controller' => 'suspected_drugs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
