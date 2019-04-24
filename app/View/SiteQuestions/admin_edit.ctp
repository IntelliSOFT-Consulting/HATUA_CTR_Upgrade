<?php
	$this->assign('Content', 'active');
?>


<div class="row-fluid">
	<div class="span12">

	<div class="siteQuestions form">
	<?php 
	    echo $this->Form->create('SiteQuestion', array(
			'class' => 'form-horizontal',
			 'inputDefaults' => array(
				'div' => array('class' => 'control-group'),
				'label' => array('class' => 'control-label'),
				'between' => '<div class="controls">',
				'after' => '</div>',
				'class' => '',
				'format' => array('before', 'label', 'between', 'input', 'after','error'),
				'error' => array('attributes' => array('class' => 'controls help-block')),
			 ),
		));
	?>
		<fieldset>
			<legend><?php echo __('Edit Site Question'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('question_number',
					array('label' => array('class' => 'control-label required', 'text' => 'Question number'),));
			echo $this->Form->input('question',
					array('label' => array('class' => 'control-label required', 'text' => 'Question <span class="sterix">*</span>'),));
			echo $this->Form->input('question_type',
					array('type' => 'select', 
						  'options' =>  array('question' => 'question', 'section' => 'section', 'comment' => 'comment', 'finding' => 'finding'), 
						  'label' => array('class' => 'control-label required', 'text' => 'Question type <span class="sterix">*</span>'),));

		?>
		</fieldset>
	<?php 
		//echo $this->Form->end(__('Submit')); 

		echo $this->Form->end(array(
			'label' => 'Submit',
			'value' => 'Save',
			'class' => 'btn btn-primary',
			'div' => array(
				'class' => 'form-actions',
			)
		));
	?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>

			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SiteQuestion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SiteQuestion.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List Site Questions'), array('action' => 'index')); ?></li>
		</ul>
	</div>

	</div>
</div>
