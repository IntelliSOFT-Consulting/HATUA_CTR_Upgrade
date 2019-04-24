<div class="counties form">
<?php echo $this->Form->create('County'); ?>
	<fieldset>
		<legend><?php echo __('Add County'); ?></legend>
	<?php
		echo $this->Form->input('county_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Counties'), array('action' => 'index')); ?></li>
	</ul>
</div>
