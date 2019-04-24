<div class="amendments form">
<?php echo $this->Form->create('Amendment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Amendment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('trial_status_id');
		echo $this->Form->input('abstract_of_study');
		echo $this->Form->input('study_title');
		echo $this->Form->input('protocol_no');
		echo $this->Form->input('version_no');
		echo $this->Form->input('date_of_protocol');
		echo $this->Form->input('study_drug');
		echo $this->Form->input('disease_condition');
		echo $this->Form->input('product_type_biologicals');
		echo $this->Form->input('product_type_proteins');
		echo $this->Form->input('product_type_immunologicals');
		echo $this->Form->input('product_type_vaccines');
		echo $this->Form->input('product_type_hormones');
		echo $this->Form->input('product_type_toxoid');
		echo $this->Form->input('product_type_chemical');
		echo $this->Form->input('product_type_medical_device');
		echo $this->Form->input('product_type_chemical_name');
		echo $this->Form->input('product_type_medical_device_name');
		echo $this->Form->input('ecct_not_applicable');
		echo $this->Form->input('ecct_ref_number');
		echo $this->Form->input('email_address');
		echo $this->Form->input('applicant_covering_letter');
		echo $this->Form->input('applicant_protocol');
		echo $this->Form->input('applicant_patient_information');
		echo $this->Form->input('applicant_investigators_brochure');
		echo $this->Form->input('applicant_investigators_cv');
		echo $this->Form->input('applicant_signed_declaration');
		echo $this->Form->input('applicant_financial_declaration');
		echo $this->Form->input('applicant_gmp_certificate');
		echo $this->Form->input('applicant_indemnity_cover');
		echo $this->Form->input('applicant_opinion_letter');
		echo $this->Form->input('applicant_approval_letter');
		echo $this->Form->input('applicant_statement');
		echo $this->Form->input('applicant_participating_countries');
		echo $this->Form->input('applicant_addendum');
		echo $this->Form->input('applicant_fees');
		echo $this->Form->input('declaration_applicant');
		echo $this->Form->input('declaration_date1');
		echo $this->Form->input('declaration_principal_investigator');
		echo $this->Form->input('declaration_date2');
		echo $this->Form->input('placebo_present');
		echo $this->Form->input('principal_inclusion_criteria');
		echo $this->Form->input('principal_exclusion_criteria');
		echo $this->Form->input('primary_end_points');
		echo $this->Form->input('scope_diagnosis');
		echo $this->Form->input('scope_prophylaxis');
		echo $this->Form->input('scope_therapy');
		echo $this->Form->input('scope_safety');
		echo $this->Form->input('scope_efficacy');
		echo $this->Form->input('scope_pharmacokinetic');
		echo $this->Form->input('scope_pharmacodynamic');
		echo $this->Form->input('scope_bioequivalence');
		echo $this->Form->input('scope_dose_response');
		echo $this->Form->input('scope_pharmacogenetic');
		echo $this->Form->input('scope_pharmacogenomic');
		echo $this->Form->input('scope_pharmacoecomomic');
		echo $this->Form->input('scope_others');
		echo $this->Form->input('scope_others_specify');
		echo $this->Form->input('trial_human_pharmacology');
		echo $this->Form->input('trial_administration_humans');
		echo $this->Form->input('trial_bioequivalence_study');
		echo $this->Form->input('trial_other');
		echo $this->Form->input('trial_other_specify');
		echo $this->Form->input('trial_therapeutic_exploratory');
		echo $this->Form->input('trial_therapeutic_confirmatory');
		echo $this->Form->input('trial_therapeutic_use');
		echo $this->Form->input('design_controlled');
		echo $this->Form->input('site_capacity');
		echo $this->Form->input('staff_numbers');
		echo $this->Form->input('other_details_explanation');
		echo $this->Form->input('other_details_regulatory_notapproved');
		echo $this->Form->input('other_details_regulatory_approved');
		echo $this->Form->input('other_details_regulatory_rejected');
		echo $this->Form->input('other_details_regulatory_halted');
		echo $this->Form->input('estimated_duration');
		echo $this->Form->input('design_controlled_randomised');
		echo $this->Form->input('design_controlled_open');
		echo $this->Form->input('design_controlled_single_blind');
		echo $this->Form->input('design_controlled_double_blind');
		echo $this->Form->input('design_controlled_parallel_group');
		echo $this->Form->input('design_controlled_cross_over');
		echo $this->Form->input('design_controlled_other');
		echo $this->Form->input('design_controlled_specify');
		echo $this->Form->input('design_controlled_comparator');
		echo $this->Form->input('design_controlled_other_medicinal');
		echo $this->Form->input('design_controlled_placebo');
		echo $this->Form->input('design_controlled_medicinal_other');
		echo $this->Form->input('design_controlled_medicinal_specify');
		echo $this->Form->input('single_site_member_state');
		echo $this->Form->input('location_of_area');
		echo $this->Form->input('multiple_sites_member_state');
		echo $this->Form->input('multiple_countries');
		echo $this->Form->input('multiple_member_states');
		echo $this->Form->input('multi_country_list');
		echo $this->Form->input('data_monitoring_committee');
		echo $this->Form->input('total_enrolment_per_site');
		echo $this->Form->input('total_participants_worldwide');
		echo $this->Form->input('population_less_than_18_years');
		echo $this->Form->input('population_utero');
		echo $this->Form->input('population_preterm_newborn');
		echo $this->Form->input('population_newborn');
		echo $this->Form->input('population_infant_and_toddler');
		echo $this->Form->input('population_children');
		echo $this->Form->input('population_adolescent');
		echo $this->Form->input('population_above_18');
		echo $this->Form->input('population_adult');
		echo $this->Form->input('population_elderly');
		echo $this->Form->input('gender_female');
		echo $this->Form->input('gender_male');
		echo $this->Form->input('subjects_healthy');
		echo $this->Form->input('subjects_patients');
		echo $this->Form->input('subjects_vulnerable_populations');
		echo $this->Form->input('subjects_women_child_bearing');
		echo $this->Form->input('subjects_women_using_contraception');
		echo $this->Form->input('subjects_pregnant_women');
		echo $this->Form->input('subjects_nursing_women');
		echo $this->Form->input('subjects_emergency_situation');
		echo $this->Form->input('subjects_incapable_consent');
		echo $this->Form->input('subjects_specify');
		echo $this->Form->input('subjects_others');
		echo $this->Form->input('subjects_others_specify');
		echo $this->Form->input('investigator1_given_name');
		echo $this->Form->input('investigator1_middle_name');
		echo $this->Form->input('investigator1_family_name');
		echo $this->Form->input('investigator1_qualification');
		echo $this->Form->input('investigator1_professional_address');
		echo $this->Form->input('organisations_transferred_');
		echo $this->Form->input('number_participants');
		echo $this->Form->input('approval_date');
		echo $this->Form->input('submitted');
		echo $this->Form->input('date_submitted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Amendment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Amendment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Amendments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trial Statuses'), array('controller' => 'trial_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trial Status'), array('controller' => 'trial_statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
