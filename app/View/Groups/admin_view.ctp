<div class="row-fluid">
	<?php
	$this->assign('Users', 'active');
?>
<h2><?php  echo __('Role'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($group['Group']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($group['Group']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($group['Group']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
	<div class="form-actions">
	  <?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $group['Group']['id'], 'admin' => true),
			array('class' => 'btn btn-success')); ?>
	 <?php echo $this->Html->link(__('List Groups'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary')); ?>
	</div>
</div>
