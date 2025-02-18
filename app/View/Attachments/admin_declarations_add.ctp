<div class="counties form">
	<fieldset>
		<legend><?php echo __('Add Declation(s)'); ?></legend>
		<?php
		echo $this->Form->create('Attachment', array(
			'type' => 'file',
			'class' => 'form-horizontal',
			'inputDefaults' => array(
				'div' => array('class' => 'control-group'),
				'label' => array('class' => 'control-label'),
				'between' => '<div class="controls">',
				'after' => '</div>',
				'class' => '',
				'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
				'error' => array('attributes' => array('class' => 'controls help-block')),
			),
		)); 
		echo $this->element('multi/declaration');
		 

		echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary'));
		echo $this->Form->end();
		?>
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Declarations'), array('action' => 'declarations')); ?></li>
	</ul>
</div>