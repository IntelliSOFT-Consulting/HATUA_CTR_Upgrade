<?php
	$this->assign('Content', 'active');
?>


<div class="row-fluid">
	<div class="span12">
		<div class="reviewQuestions form">
		<?php 
		    echo $this->Form->create('ReviewQuestion', array(
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
				<legend><?php echo __('Add Review Question'); ?></legend>
			<?php
			echo $this->Form->input('question_number',
					array('label' => array('class' => 'control-label required', 'text' => 'Question number'),));
			echo $this->Form->input('question',
					array('label' => array('class' => 'control-label required', 'text' => 'Question <span class="sterix">*</span>'),));
			echo $this->Form->input('question_type',
					array('type' => 'select', 
						  'options' =>  array('yesno' => 'yesno', 'text' => 'text', 'label' => 'label','workspace' => 'workspace', 'comment' => 'comment'), 
						  'label' => array('class' => 'control-label required', 'text' => 'Question type <span class="sterix">*</span>'),));
			echo $this->Form->input('review_type',
					array('type' => 'select', 
						  'options' =>  array('clinical' => 'clinical', 'non-clinical' => 'non-clinical', 'quality' => 'quality'), 
						  'label' => array('class' => 'control-label required', 'text' => 'Review type <span class="sterix">*</span>'),));
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

				<li><?php echo $this->Html->link(__('List Review Questions'), array('action' => 'index')); ?></li>
			</ul>
		</div>

	</div>
</div>

