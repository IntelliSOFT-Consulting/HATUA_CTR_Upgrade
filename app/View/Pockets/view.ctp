<div class="pockets view">
<h2><?php  echo __('Pocket'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pocket['Pocket']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($pocket['Pocket']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($pocket['Pocket']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pocket['Pocket']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($pocket['Pocket']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pocket'), array('action' => 'edit', $pocket['Pocket']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Pocket'), array('action' => 'delete', $pocket['Pocket']['id']), null, __('Are you sure you want to delete # %s?', $pocket['Pocket']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pockets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pocket'), array('action' => 'add')); ?> </li>
	</ul>
</div>
