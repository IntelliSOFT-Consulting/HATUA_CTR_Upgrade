<?php
 	$this->Html->script('multi/placebos', array('inline' => false));
?>
<hr>
<h5>6.0 INFORMATION ON PLACEBO (<small>if relevant; repeat as necessary -
<button type="button" class="btn-mini" id="addPlacebo" title="add placebo">Add</button></small>) </h5>
<?php
	$placeboPresentError = $identicalIndpError = '';
	if($this->Form->isFieldError('placebo_present')) $placeboPresentError = 'error';
	if($this->Form->isFieldError('Placebo.0.identical_indp')) $identicalIndpError = 'error';
	echo $this->Form->input('placebo_present', array(
		'type' => 'radio',	'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
		'class' => 'placebo_present0',
		'before' => '<div class="control-group '.$placeboPresentError.'"> <label class="control-label required">Is there a placebo? <span class="sterix">*</span>
			</label> <div class="controls"> <input type="hidden" value="" id="ApplicationPlaceboPresent_" name="data[Application][placebo_present]">
			<label class="radio inline">',
		'after' => '</label>',
		'options' => array('Yes' => 'Yes'),
	));
	echo $this->Form->input('placebo_present', array(
		'type' => 'radio',	'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false,
		'class' => 'placebo_present0',
		'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
		'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
		'before' => '<label class="radio inline">',
		'after' => '</label>
			<span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
			onclick="$(\'.placebo_present0\').removeAttr(\'checked disabled\')">
			<em class="accordion-toggle">clear!</em></a> </span>
			</div> </div>',
		'options' => array('No' => 'No'),
	));
?>
<div class="ctr-groups">
	<div id="placebo_primary_contact">
	<?php
		echo $this->Form->input('Placebo.0.id');
		echo $this->Form->input('Placebo.0.pharmaceutical_form', array(
			'label' => array('class' => 'control-label required', 'text' => 'Pharmaceutical form'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
		));
		echo $this->Form->input('Placebo.0.route_of_administration', array(
			'label' => array('class' => 'control-label required', 'text' => 'Route of administration'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
		));
		echo $this->Form->input('Placebo.0.composition', array(
			'label' => array('class' => 'control-label required', 'text' => 'Composition, apart from active substance(s)'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
		));
		echo $this->Form->input('Placebo.0.identical_indp', array(
			'type' => 'radio',	'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
			'class' => 'identical_indp0 placebo_r',
			'before' => '<div class="control-group '.$identicalIndpError.'"> <label class="control-label required">Is it otherwise identical to the INDP?
				</label> <div class="controls"> <input type="hidden" value="" id="Placebo0IdenticalIndp_" name="data[Placebo][0][identical_indp]">
				<label class="radio inline">',
			'after' => '</label>',
			'options' => array('Yes' => 'Yes'),
		));
		echo $this->Form->input('Placebo.0.identical_indp', array(
			'type' => 'radio',	'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false,
			'class' => 'identical_indp0 placebo_r',
			'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
			'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
			'before' => '<label class="radio inline">',
			'after' => '</label>
						<span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
						onclick="$(\'.identical_indp0\').removeAttr(\'checked disabled\')">
						<em class="accordion-toggle">clear!</em></a> </span>
						</div> </div>',
			'options' => array('No' => 'No'),
		));
		echo $this->Form->input('Placebo.0.major_ingredients', array(
			'label' => array('class' => 'control-label required', 'text' => 'If not, specify major ingredients'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
		));
		echo $this->Html->tag('hr', '', array('id' => 'PlaceboHr0'));
	?>
	</div>
	<div id="placebo_infos">
	<?php
		if (!empty($this->request->data['Placebo'])) {
			for ($i = 1; $i <= count($this->request->data['Placebo']) - 1; $i++) {
			?>
			<div class="placebo-group">
			<?php
				echo $this->Form->input('Placebo.'.$i.'.id');
				$identicalIndpError = '';
				if($this->Form->isFieldError('Placebo.'.$i.'.identical_indp')) $identicalIndpError = 'error';
				echo '<p  class="topper" id="PlaceboLabel'.$i.'">'.$i.' additional placebo</p>';
				echo '<span class="badge badge-info">'.$i.'</span>';
				echo $this->Form->input('Placebo.'.$i.'.pharmaceutical_form', array(
					'label' => array('class' => 'control-label required', 'text' => 'Pharmaceutical form'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
				));
				echo $this->Form->input('Placebo.'.$i.'.route_of_administration', array(
					'label' => array('class' => 'control-label required', 'text' => 'Route of administration'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
				));
				echo $this->Form->input('Placebo.'.$i.'.composition', array(
					'label' => array('class' => 'control-label required', 'text' => 'Composition, apart from active substance(s)'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
				));
				echo $this->Form->input('Placebo.'.$i.'.identical_indp', array(
					'type' => 'radio',	'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
					'class' => 'identical_indp'.$i.' placebo_r',
					'before' => '<div class="control-group '.$identicalIndpError.'"> <label class="control-label required">Is it otherwise identical to the INDP?
						</label> <div class="controls"> <input type="hidden" value="" id="Placebo'.$i.'IdenticalIndp_" name="data[Placebo]['.$i.'][identical_indp]">
						<label class="radio inline">',
					'after' => '</label>',
					'options' => array('Yes' => 'Yes'),
				));
				echo $this->Form->input('Placebo.'.$i.'.identical_indp', array(
					'type' => 'radio',	'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false,
					'class' => 'identical_indp'.$i.' placebo_r',
					'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
					'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
					'before' => '<label class="radio inline">',
					'after' => '</label>
								<span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
								onclick="$(\'.identical_indp'.$i.'\').removeAttr(\'checked disabled\')">
								<em class="accordion-toggle">clear!</em></a> </span>
								</div> </div>',
					'options' => array('No' => 'No'),
				));
				echo $this->Form->input('Placebo.'.$i.'.major_ingredients', array(
					'label' => array('class' => 'control-label required', 'text' => 'If not, specify major ingredients'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge placebo_f'
				));
				echo $this->Html->tag('div', '<button id="PlaceboButton'.$i.'" class="btn btn-mini btn-danger removePlacebo" type="button">Remove Placebo</button>', array(
							'class' => 'controls', 'escape' => false));
				echo $this->Html->tag('hr', '', array('id' => 'PlaceboHr'.$i.''));
			?>
			</div>
			<?php
			}
		}
	?>
	</div>
</div>
