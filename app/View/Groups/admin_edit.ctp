<div class="row-fluid">
	<?php
	$this->assign('Users', 'active');
?>
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Edit Role'); ?></legend>
	<?php
		echo $this->Form->input('id');
		// echo $this->Form->input('name');
		echo "<h4>".$this->Form->value('Group.name')."</h4>";
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo  $this->Form->end(array(
			'label' => 'Save',
			'value' => 'Save',
			'class' => 'btn btn-primary',
			'div' => array(
				'class' => 'form-actions',
			)
		));
		?>
</div>
