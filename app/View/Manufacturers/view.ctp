<div class="manufacturers view">
<h2><?php  echo __('Manufacturer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($manufacturer['Manufacturer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($manufacturer['Application']['id'], array('controller' => 'applications', 'action' => 'view', $manufacturer['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manufacturer Name'); ?></dt>
		<dd>
			<?php echo h($manufacturer['Manufacturer']['manufacturer_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($manufacturer['Manufacturer']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manufacturer Country'); ?></dt>
		<dd>
			<?php echo h($manufacturer['Manufacturer']['manufacturer_country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($manufacturer['Manufacturer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($manufacturer['Manufacturer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Manufacturer'), array('action' => 'edit', $manufacturer['Manufacturer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Manufacturer'), array('action' => 'delete', $manufacturer['Manufacturer']['id']), null, __('Are you sure you want to delete # %s?', $manufacturer['Manufacturer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Manufacturers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manufacturer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
