<div class="counties view">
<h2><?php  echo __('County'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($county['County']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('County Name'); ?></dt>
		<dd>
			<?php echo h($county['County']['county_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($county['County']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($county['County']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit County'), array('action' => 'edit', $county['County']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete County'), array('action' => 'delete', $county['County']['id']), null, __('Are you sure you want to delete # %s?', $county['County']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Counties'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New County'), array('action' => 'add')); ?> </li>
	</ul>
</div>
