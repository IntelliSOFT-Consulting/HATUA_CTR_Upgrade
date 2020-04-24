<?php
 	$this->Html->script('multi/investigators', array('inline' => false));
?>
<h5>2.1 PRINCIPAL INVESTIGATOR (<small>for multicentre trial; where necessary, Click button to add more -
<button type="button" class="btn-mini" id="addPIContact">Add Contact</button></small>) </h5>
<div class="ctr-groups">
	<div id="investigator_primary_contact">
	<?php
		echo $this->Form->input('InvestigatorContact.0.id');
		echo $this->Form->input('InvestigatorContact.0.given_name', array(
			'label' => array('class' => 'control-label required', 'text' => 'Given name <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('InvestigatorContact.0.middle_name', array(
			'label' => array('class' => 'control-label', 'text' => 'Middle name, if applicable'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('InvestigatorContact.0.family_name', array(
			'label' => array('class' => 'control-label required', 'text' => 'Family name <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('InvestigatorContact.0.qualification', array(
			'label' => array('class' => 'control-label required', 'text' => 'Qualification <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('InvestigatorContact.0.professional_address', array(
			'label' => array('class' => 'control-label required', 'text' => 'Professional address <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('InvestigatorContact.0.telephone', array(
			'label' => array('class' => 'control-label required', 'text' => 'Telephone number <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('InvestigatorContact.0.email', array(
			'type' => 'email', 'label' => array('class' => 'control-label required', 'text' => 'email address <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		// echo $this->Html->tag('div', '<button id="InvestigatorContactButton0" type="button">Add Contact</button>', array(
					// 'class' => 'controls', 'escape' => false));
		echo $this->Html->tag('hr', '', array('id' => 'InvestigatorContactHr0'));
	?>
	</div>
	<div id="investigator_contacts">
	<?php
		if (!empty($this->request->data['InvestigatorContact'])) {
			for ($i = 1; $i <= count($this->request->data['InvestigatorContact'])-1; $i++) {
			?>
			<div class="contact-group">
			<?php
				echo $this->Form->input('InvestigatorContact.'.$i.'.id');
				echo $this->Form->input('InvestigatorContact.'.$i.'.given_name', array(
					'label' => array('class' => 'control-label required', 'text' => 'Given name <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('InvestigatorContact.'.$i.'.middle_name', array(
					'label' => array('class' => 'control-label', 'text' => 'Middle name, if applicable'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('InvestigatorContact.'.$i.'.family_name', array(
					'label' => array('class' => 'control-label required', 'text' => 'Family name <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('InvestigatorContact.'.$i.'.qualification', array(
					'label' => array('class' => 'control-label required', 'text' => 'Qualification <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('InvestigatorContact.'.$i.'.professional_address', array(
					'label' => array('class' => 'control-label required', 'text' => 'Professional address <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('InvestigatorContact.'.$i.'.telephone', array(
					'label' => array('class' => 'control-label required', 'text' => 'Telephone number <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('InvestigatorContact.'.$i.'.email', array(
					'type' => 'email', 'label' => array('class' => 'control-label required', 'text' => 'email address <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Html->tag('div', '<button id="InvestigatorContactButton'.$i.'" class="btn btn-mini btn-danger removePIContact" type="button">Remove Contact</button>', array(
							'class' => 'controls', 'escape' => false));
				echo $this->Html->tag('hr', '', array('id' => 'InvestigatorContactHr'.$i));
			?>
			</div>
			<?php
			}
		}
	?>
	</div>
</div>
