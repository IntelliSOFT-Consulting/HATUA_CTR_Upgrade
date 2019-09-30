<?php
 	$this->Html->script('multi/sponsors', array('inline' => false));
?>
<h5>3.0 SPONSOR DETAILS (<small>where necessary, Click button to add more -
<button type="button" class="btn-mini" id="addSponsorDetail" title="add detail">Add Detail</button></small>) </h5>
<div class="ctr-groups">
	<div id="sponsor_primary_contact">
	<?php
		echo $this->Form->input('Sponsor.0.id');
		echo $this->Form->input('Sponsor.0.sponsor', array(
			'label' => array('class' => 'control-label required', 'text' => 'Sponsor <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('Sponsor.0.sponsor_type', array(
			'type' => 'select', 'options' => array('Industry' => 'Industry', 'Research Institution' => 'Research Institution', 'Local Kenyan Investigator' => 'Local Kenyan Investigator', 'Others' => 'Others'), 
			'empty' => true,
			'label' => array('class' => 'control-label required', 'text' => 'Type <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xlarge'
		));
		echo $this->Form->input('Sponsor.0.contact_person', array(
			'label' => array('class' => 'control-label', 'text' => 'Contact Person'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('Sponsor.0.address', array(
			'label' => array('class' => 'control-label required', 'text' => 'Address <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('Sponsor.0.telephone_number', array(
			'label' => array('class' => 'control-label required', 'text' => 'Telephone Number <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('Sponsor.0.fax_number', array(
			'label' => array('class' => 'control-label', 'text' => 'Fax Number'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('Sponsor.0.cell_number', array(
			'label' => array('class' => 'control-label required', 'text' => 'Mobile phone number <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Form->input('Sponsor.0.email_address', array(
			'type' => 'email',
			'label' => array('class' => 'control-label required', 'text' => 'Email Address <span class="sterix">*</span>'),
			'placeholder' => ' ' , 'class' => 'input-xxlarge'
		));
		echo $this->Html->tag('hr', '', array('id' => 'SponsorHr0'));
	?>
	</div>
	<div id="sponsor_details">
	<?php
		if (!empty($this->request->data['Sponsor'])) {
			for ($i = 1; $i <= count($this->request->data['Sponsor'])-1; $i++) {
			?>
			<div class="sponsor-group">
			<?php
				echo $this->Form->input('Sponsor.'.$i.'.id');
				echo '<p  class="topper" id="SponsorDetailLabel'.$i.'">'.$i.' additional sponsors</p>';
				echo '<span class="badge badge-info">'.$i.'</span>';
				echo $this->Form->input('Sponsor.'.$i.'.sponsor', array(
					'label' => array('class' => 'control-label required', 'text' => 'Sponsor <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.sponsor_type', array(
					'type' => 'select', 'options' => array('Industry' => 'Industry', 'Research Institution' => 'Research Institution', 'Local Kenyan Investigator' => 'Local Kenyan Investigator', 'Others' => 'Others'), 
					'empty' => true,
					'label' => array('class' => 'control-label required', 'text' => 'Type <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.contact_person', array(
					'label' => array('class' => 'control-label', 'text' => 'Contact Person'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.address', array(
					'label' => array('class' => 'control-label required', 'text' => 'Address <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.telephone_number', array(
					'label' => array('class' => 'control-label required', 'text' => 'Telephone Number <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.fax_number', array(
					'label' => array('class' => 'control-label', 'text' => 'Fax Number'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.cell_number', array(
					'label' => array('class' => 'control-label required', 'text' => 'Mobile phone number <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Form->input('Sponsor.'.$i.'.email_address', array(
					'type' => 'email',
					'label' => array('class' => 'control-label required', 'text' => 'Email Address <span class="sterix">*</span>'),
					'placeholder' => ' ' , 'class' => 'input-xxlarge'
				));
				echo $this->Html->tag('div', '<button id="SponsorDetail'.$i.'" class="btn btn-mini btn-danger removeSponsorDetail" type="button">Remove Detail</button>', array(
							'class' => 'controls', 'escape' => false));
				echo $this->Html->tag('hr', '', array('id' => 'SponsorHr'.$i));
			?>
			</div>
			<?php
			}
		}
	?>
	</div>
</div>
	<?php
		// echo $this->Form->input('sponsor', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Sponsor <span class="sterix">*</span>'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
		// echo $this->Form->input('contact_person', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Contact Person <span class="sterix">*</span>'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
		// echo $this->Form->input('address', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Address <span class="sterix">*</span>'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
		// echo $this->Form->input('telephone_number', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Telephone Number'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
		// echo $this->Form->input('fax_number', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Fax Number'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
		// echo $this->Form->input('cell_number', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Cell Number <span class="sterix">*</span>'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
		// echo $this->Form->input('email_address', array(
			// 'label' => array('class' => 'control-label required', 'text' => 'Email Address <span class="sterix">*</span>'),
			// 'placeholder' => ' ' , 'class' => 'input-xxlarge',
		// ));
	?>
