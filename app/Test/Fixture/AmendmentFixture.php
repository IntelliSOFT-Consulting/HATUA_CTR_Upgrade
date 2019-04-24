<?php
/**
 * AmendmentFixture
 *
 */
class AmendmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'application_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'trial_status_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'abstract_of_study' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'study_title' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'protocol_no' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'version_no' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_of_protocol' => array('type' => 'date', 'null' => true, 'default' => null),
		'study_drug' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'disease_condition' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'product_type_biologicals' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_proteins' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_immunologicals' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_vaccines' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_hormones' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_toxoid' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_chemical' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_medical_device' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'product_type_chemical_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'product_type_medical_device_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ecct_not_applicable' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'ecct_ref_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email_address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'applicant_covering_letter' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_protocol' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_patient_information' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_investigators_brochure' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_investigators_cv' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_signed_declaration' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_financial_declaration' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_gmp_certificate' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_indemnity_cover' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_opinion_letter' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_approval_letter' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_statement' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_participating_countries' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_addendum' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'applicant_fees' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'declaration_applicant' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'declaration_date1' => array('type' => 'date', 'null' => true, 'default' => null),
		'declaration_principal_investigator' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'declaration_date2' => array('type' => 'date', 'null' => true, 'default' => null),
		'placebo_present' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'principal_inclusion_criteria' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'principal_exclusion_criteria' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'primary_end_points' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'scope_diagnosis' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_prophylaxis' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_therapy' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_safety' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_efficacy' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_pharmacokinetic' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_pharmacodynamic' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_bioequivalence' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_dose_response' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_pharmacogenetic' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_pharmacogenomic' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_pharmacoecomomic' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_others' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'scope_others_specify' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'trial_human_pharmacology' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'trial_administration_humans' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'trial_bioequivalence_study' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'trial_other' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'trial_other_specify' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'trial_therapeutic_exploratory' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'trial_therapeutic_confirmatory' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'trial_therapeutic_use' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'design_controlled' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'site_capacity' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'staff_numbers' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'other_details_explanation' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'other_details_regulatory_notapproved' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'other_details_regulatory_approved' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'other_details_regulatory_rejected' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'other_details_regulatory_halted' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'estimated_duration' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_randomised' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_open' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_single_blind' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_double_blind' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_parallel_group' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_cross_over' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_other' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_specify' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_comparator' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_other_medicinal' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_placebo' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_medicinal_other' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'design_controlled_medicinal_specify' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'single_site_member_state' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'location_of_area' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'multiple_sites_member_state' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'multiple_countries' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'multiple_member_states' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'multi_country_list' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'data_monitoring_committee' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'total_enrolment_per_site' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'total_participants_worldwide' => array('type' => 'string', 'null' => true, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_less_than_18_years' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_utero' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_preterm_newborn' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_newborn' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_infant_and_toddler' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_children' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_adolescent' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_above_18' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_adult' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'population_elderly' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'gender_female' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'gender_male' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'subjects_healthy' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_patients' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_vulnerable_populations' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_women_child_bearing' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_women_using_contraception' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_pregnant_women' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_nursing_women' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_emergency_situation' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_incapable_consent' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_specify' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_others' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subjects_others_specify' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'investigator1_given_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'investigator1_middle_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'investigator1_family_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'investigator1_qualification' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'investigator1_professional_address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'organisations_transferred_' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'number_participants' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'approval_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'submitted' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'date_submitted' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'application_id' => 1,
			'trial_status_id' => 1,
			'abstract_of_study' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'study_title' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'protocol_no' => 'Lorem ipsum dolor sit amet',
			'version_no' => 'Lorem ipsum dolor sit amet',
			'date_of_protocol' => '2012-11-16',
			'study_drug' => 'Lorem ipsum dolor sit amet',
			'disease_condition' => 'Lorem ipsum dolor sit amet',
			'product_type_biologicals' => 1,
			'product_type_proteins' => 1,
			'product_type_immunologicals' => 1,
			'product_type_vaccines' => 1,
			'product_type_hormones' => 1,
			'product_type_toxoid' => 1,
			'product_type_chemical' => 1,
			'product_type_medical_device' => 1,
			'product_type_chemical_name' => 'Lorem ipsum dolor sit amet',
			'product_type_medical_device_name' => 'Lorem ipsum dolor sit amet',
			'ecct_not_applicable' => 1,
			'ecct_ref_number' => 'Lorem ipsum dolor sit amet',
			'email_address' => 'Lorem ipsum dolor sit amet',
			'applicant_covering_letter' => 1,
			'applicant_protocol' => 1,
			'applicant_patient_information' => 1,
			'applicant_investigators_brochure' => 1,
			'applicant_investigators_cv' => 1,
			'applicant_signed_declaration' => 1,
			'applicant_financial_declaration' => 1,
			'applicant_gmp_certificate' => 1,
			'applicant_indemnity_cover' => 1,
			'applicant_opinion_letter' => 1,
			'applicant_approval_letter' => 1,
			'applicant_statement' => 1,
			'applicant_participating_countries' => 1,
			'applicant_addendum' => 1,
			'applicant_fees' => 1,
			'declaration_applicant' => 'Lorem ipsum dolor sit amet',
			'declaration_date1' => '2012-11-16',
			'declaration_principal_investigator' => 'Lorem ipsum dolor sit amet',
			'declaration_date2' => '2012-11-16',
			'placebo_present' => 'Lorem ipsum dolor sit amet',
			'principal_inclusion_criteria' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'principal_exclusion_criteria' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'primary_end_points' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'scope_diagnosis' => 1,
			'scope_prophylaxis' => 1,
			'scope_therapy' => 1,
			'scope_safety' => 1,
			'scope_efficacy' => 1,
			'scope_pharmacokinetic' => 1,
			'scope_pharmacodynamic' => 1,
			'scope_bioequivalence' => 1,
			'scope_dose_response' => 1,
			'scope_pharmacogenetic' => 1,
			'scope_pharmacogenomic' => 1,
			'scope_pharmacoecomomic' => 1,
			'scope_others' => 1,
			'scope_others_specify' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'trial_human_pharmacology' => 1,
			'trial_administration_humans' => 1,
			'trial_bioequivalence_study' => 1,
			'trial_other' => 1,
			'trial_other_specify' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'trial_therapeutic_exploratory' => 1,
			'trial_therapeutic_confirmatory' => 1,
			'trial_therapeutic_use' => 1,
			'design_controlled' => 'Lorem ipsum dolor sit amet',
			'site_capacity' => 'Lorem ipsum dolor sit amet',
			'staff_numbers' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'other_details_explanation' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'other_details_regulatory_notapproved' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'other_details_regulatory_approved' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'other_details_regulatory_rejected' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'other_details_regulatory_halted' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'estimated_duration' => 'Lorem ipsum dolor sit amet',
			'design_controlled_randomised' => 'Lorem ipsum dolor sit amet',
			'design_controlled_open' => 'Lorem ipsum dolor sit amet',
			'design_controlled_single_blind' => 'Lorem ipsum dolor sit amet',
			'design_controlled_double_blind' => 'Lorem ipsum dolor sit amet',
			'design_controlled_parallel_group' => 'Lorem ipsum dolor sit amet',
			'design_controlled_cross_over' => 'Lorem ipsum dolor sit amet',
			'design_controlled_other' => 'Lorem ipsum dolor sit amet',
			'design_controlled_specify' => 'Lorem ipsum dolor sit amet',
			'design_controlled_comparator' => 'Lorem ipsum dolor sit amet',
			'design_controlled_other_medicinal' => 'Lorem ipsum dolor sit amet',
			'design_controlled_placebo' => 'Lorem ipsum dolor sit amet',
			'design_controlled_medicinal_other' => 'Lorem ipsum dolor sit amet',
			'design_controlled_medicinal_specify' => 'Lorem ipsum dolor sit amet',
			'single_site_member_state' => 'Lorem ipsum dolor sit amet',
			'location_of_area' => 'Lorem ipsum dolor sit amet',
			'multiple_sites_member_state' => 'Lorem ipsum dolor sit amet',
			'multiple_countries' => 'Lorem ipsum dolor sit amet',
			'multiple_member_states' => 'Lorem ipsum dolor sit amet',
			'multi_country_list' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'data_monitoring_committee' => 'Lorem ipsum dolor sit amet',
			'total_enrolment_per_site' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'total_participants_worldwide' => 'Lorem ipsum dolor sit amet',
			'population_less_than_18_years' => 'Lorem ipsum dolor sit amet',
			'population_utero' => 'Lorem ipsum dolor sit amet',
			'population_preterm_newborn' => 'Lorem ipsum dolor sit amet',
			'population_newborn' => 'Lorem ipsum dolor sit amet',
			'population_infant_and_toddler' => 'Lorem ipsum dolor sit amet',
			'population_children' => 'Lorem ipsum dolor sit amet',
			'population_adolescent' => 'Lorem ipsum dolor sit amet',
			'population_above_18' => 'Lorem ipsum dolor sit amet',
			'population_adult' => 'Lorem ipsum dolor sit amet',
			'population_elderly' => 'Lorem ipsum dolor sit amet',
			'gender_female' => 1,
			'gender_male' => 1,
			'subjects_healthy' => 'Lorem ipsum dolor sit amet',
			'subjects_patients' => 'Lorem ipsum dolor sit amet',
			'subjects_vulnerable_populations' => 'Lorem ipsum dolor sit amet',
			'subjects_women_child_bearing' => 'Lorem ipsum dolor sit amet',
			'subjects_women_using_contraception' => 'Lorem ipsum dolor sit amet',
			'subjects_pregnant_women' => 'Lorem ipsum dolor sit amet',
			'subjects_nursing_women' => 'Lorem ipsum dolor sit amet',
			'subjects_emergency_situation' => 'Lorem ipsum dolor sit amet',
			'subjects_incapable_consent' => 'Lorem ipsum dolor sit amet',
			'subjects_specify' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'subjects_others' => 'Lorem ipsum dolor sit amet',
			'subjects_others_specify' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'investigator1_given_name' => 'Lorem ipsum dolor sit amet',
			'investigator1_middle_name' => 'Lorem ipsum dolor sit amet',
			'investigator1_family_name' => 'Lorem ipsum dolor sit amet',
			'investigator1_qualification' => 'Lorem ipsum dolor sit amet',
			'investigator1_professional_address' => 'Lorem ipsum dolor sit amet',
			'organisations_transferred_' => 'Lorem ipsum dolor sit amet',
			'number_participants' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'approval_date' => '2012-11-16',
			'submitted' => 1,
			'date_submitted' => '2012-11-16 17:16:35',
			'modified' => '2012-11-16 17:16:35',
			'created' => '2012-11-16 17:16:35'
		),
	);

}
