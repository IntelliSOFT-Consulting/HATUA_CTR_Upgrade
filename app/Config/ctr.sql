-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2012 at 11:41 AM
-- Server version: 5.0.45
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `registry`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `unique_identifier` varchar(50) default NULL,
  `abstract_of_study` text,
  `study_title` text,
  `protocol_no` varchar(255) default NULL,
  `version_no` varchar(255) default NULL,
  `date_of_protocol` date default NULL,
  `study_drug` varchar(255) default NULL,
  `ecct_ref_number` varchar(255) default NULL,
  `dates_ecct` date default NULL,
  `sponsor` varchar(255) default NULL,
  `contact_person` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `telephone_number` varchar(255) default NULL,
  `fax_number` varchar(255) default NULL,
  `cell_number` varchar(255) default NULL,
  `email_address` varchar(255) default NULL,
  `date_original` date default NULL,
  `meeting_date` date default NULL,
  `signature` tinyint(1) default NULL,
  `ppb_date` date default NULL,
  `ack_name` varchar(255) default NULL,
  `ack_fax_number` varchar(255) default NULL,
  `ack_receipt` date default NULL,
  `ack_signature` tinyint(1) default NULL,
  `ack_ppb_name` varchar(255) default NULL,
  `applicant_covering_letter` tinyint(1) default NULL,
  `applicant_fully_completed` tinyint(1) default NULL,
  `applicant_protocol` tinyint(1) default NULL,
  `applicant_patient_information` tinyint(1) default NULL,
  `applicant_investigators_brochure` tinyint(1) default NULL,
  `applicant_investigators_cv` tinyint(1) default NULL,
  `applicant_signed_declaration` tinyint(1) default NULL,
  `applicant_regional_monitors` tinyint(1) default NULL,
  `applicant_certificates` tinyint(1) default NULL,
  `applicant_insurance_certificates` tinyint(1) default NULL,
  `applicant_ethics_approval` tinyint(1) default NULL,
  `applicant_copy_applying_ethics` tinyint(1) default NULL,
  `applicant_recruitment_advertisments` tinyint(1) default NULL,
  `applicant_financial_declaration` tinyint(1) default NULL,
  `applicant_labeled_diskette` tinyint(1) default NULL,
  `PPB_covering_letter` tinyint(1) default NULL,
  `PPB_fully_completed` tinyint(1) default NULL,
  `PPB_protocol` tinyint(1) default NULL,
  `PPB_patient_information` tinyint(1) default NULL,
  `PPB_investigators_brochure` tinyint(1) default NULL,
  `PPB_investigators_cv` tinyint(1) default NULL,
  `PPB_signed_declaration` tinyint(1) default NULL,
  `PPB_regional_monitors` tinyint(1) default NULL,
  `PPB_certificates` tinyint(1) default NULL,
  `PPB_insurance_certificates` tinyint(1) default NULL,
  `PPB_ethics_approval` tinyint(1) default NULL,
  `PPB_copy_applying_ethics` tinyint(1) default NULL,
  `PPB_recruitment_advertisments` tinyint(1) default NULL,
  `PPB_financial_declaration` tinyint(1) default NULL,
  `PPB_labeled_diskette` tinyint(1) default NULL,
  `declaration_applicant` varchar(255) default NULL,
  `declaration_date1` date default NULL,
  `declaration_principal_investigator` varchar(255) default NULL,
  `declaration_date2` date default NULL,
  `biological_extractive` varchar(255) default NULL,
  `biological_recombinant` varchar(255) default NULL,
  `biological_vaccine` varchar(255) default NULL,
  `biological_gmo` varchar(255) default NULL,
  `biological_plasma` varchar(255) default NULL,
  `biological_others` varchar(255) default NULL,
  `biological_others_answer` text,
  `placebo_present` varchar(255) default NULL,
  `placebo_number` varchar(255) default NULL,
  `placebo_pharmaceutical_form` varchar(255) default NULL,
  `placebo_route_of_administration` varchar(255) default NULL,
  `placebo_IMP_number` varchar(255) default NULL,
  `placebo_composition` varchar(255) default NULL,
  `placebo_indentical` varchar(255) default NULL,
  `placebo_major_ingredients` text,
  `principal_inclusion_criteria` text,
  `principal_exclusion_criteria` text,
  `primary_end_points` text,
  `scope_diagnosis` tinyint(1) default NULL,
  `scope_prophylaxis` tinyint(1) default NULL,
  `scope_therapy` tinyint(1) default NULL,
  `scope_safety` tinyint(1) default NULL,
  `scope_efficacy` tinyint(1) default NULL,
  `scope_pharmacokinetic` tinyint(1) default NULL,
  `scope_pharmacodynamic` tinyint(1) default NULL,
  `scope_bioequivalence` tinyint(1) default NULL,
  `scope_dose_response` tinyint(1) default NULL,
  `scope_pharmacogenetic` tinyint(1) default NULL,
  `scope_pharmacogenomic` tinyint(1) default NULL,
  `scope_pharmacoecomomic` tinyint(1) default NULL,
  `scope_others` tinyint(1) default NULL,
  `scope_others_specify` text,
  `trial_human_pharmacology` tinyint(1) default NULL,
  `trial_administration_humans` tinyint(1) default NULL,
  `trial_bioequivalence_study` tinyint(1) default NULL,
  `trial_other` tinyint(1) default NULL,
  `trial_other_specify` text,
  `trial_therapeutic_exploratory` tinyint(1) default NULL,
  `trial_therapeutic_confirmatory` tinyint(1) default NULL,
  `trial_therapeutic_use` tinyint(1) default NULL,
  `design_controlled` varchar(255) default NULL,
  `design_controlled_randomised` varchar(255) default NULL,
  `design_controlled_open` varchar(255) default NULL,
  `design_controlled_single_blind` varchar(255) default NULL,
  `design_controlled_double_blind` varchar(255) default NULL,
  `design_controlled_parallel_group` varchar(255) default NULL,
  `design_controlled_cross_over` varchar(255) default NULL,
  `design_controlled_other` varchar(255) default NULL,
  `design_controlled_specify` varchar(255) default NULL,
  `design_controlled_comparator` varchar(255) default NULL,
  `design_controlled_other_medicinal` varchar(255) default NULL,
  `design_controlled_placebo` varchar(255) default NULL,
  `design_controlled_medicinal_other` varchar(255) default NULL,
  `design_controlled_medicinal_specify` varchar(255) default NULL,
  `single_site_member_state` varchar(255) default NULL,
  `location_of_area` varchar(255) default NULL,
  `multiple_sites_member_state` varchar(255) default NULL,
  `number_of_sites` varchar(255) default NULL,
  `multiple_member_states` varchar(255) default NULL,
  `data_monitoring_committee` varchar(255) default NULL,
  `definition_end_of_trial` text,
  `initial_estimate_duration` varchar(255) default NULL,
  `in_MS_concerned_years` varchar(255) default NULL,
  `in_MS_concerned_months` varchar(255) default NULL,
  `in_MS_concerned_days` varchar(255) default NULL,
  `in_all_countries_years` varchar(255) default NULL,
  `in_all_countries_months` varchar(255) default NULL,
  `in_all_countries_days` varchar(255) default NULL,
  `population_less_than_18_years` varchar(255) default NULL,
  `population_utero` varchar(255) default NULL,
  `population_preterm_newborn` varchar(255) default NULL,
  `population_newborn` varchar(255) default NULL,
  `population_infant_and_toddler` varchar(255) default NULL,
  `population_children` varchar(255) default NULL,
  `population_adolescent` varchar(255) default NULL,
  `population_adult` varchar(255) default NULL,
  `population_elderly` varchar(255) default NULL,
  `gender_female` tinyint(1) default NULL,
  `gender_male` tinyint(1) default NULL,
  `subjects_healthy` varchar(255) default NULL,
  `subjects_patients` varchar(255) default NULL,
  `subjects_vulnerable_populations` varchar(255) default NULL,
  `subjects_women_child_bearing` varchar(255) default NULL,
  `subjects_women_using_contraception` varchar(255) default NULL,
  `subjects_pregnant_women` varchar(255) default NULL,
  `subjects_nursing_women` varchar(255) default NULL,
  `subjects_emergency_situation` varchar(255) default NULL,
  `subjects_incapable_consent` varchar(255) default NULL,
  `subjects_specify` text,
  `subjects_others` varchar(255) default NULL,
  `subjects_others_specify` text,
  `plans_for_treatment` text,
  `investigator1_given_name` varchar(255) default NULL,
  `investigator1_middle_name` varchar(255) default NULL,
  `investigator1_family_name` varchar(255) default NULL,
  `investigator1_qualification` varchar(255) default NULL,
  `investigator1_professional_address` varchar(255) default NULL,
  `investigator2_given_name` varchar(255) default NULL,
  `investigator2_middle_name` varchar(255) default NULL,
  `investigator2_family_name` varchar(255) default NULL,
  `investigator2_qualification` varchar(255) default NULL,
  `investigator2_professional_address` varchar(255) default NULL,
  `central_technical` varchar(255) default NULL,
  `central_technical_facilities` text,
  `central_organisation` varchar(255) default NULL,
  `central_name_contact_person` varchar(255) default NULL,
  `central_address` varchar(255) default NULL,
  `central_telephone_number` varchar(255) default NULL,
  `central_duties_subcontracted` varchar(255) default NULL,
  `organisations_transferred_` varchar(255) default NULL,
  `organisations_transferred_duties` varchar(255) default NULL,
  `organisations_transferred_name` varchar(255) default NULL,
  `organisations_transferred_contact_person` varchar(255) default NULL,
  `organisations_transferred_address` varchar(255) default NULL,
  `organisations_transferred_telephone_number` varchar(255) default NULL,
  `organisations_transferred_all_tasks` varchar(255) default NULL,
  `organisations_transferred_monitoring` varchar(255) default NULL,
  `organisations_transferred_regulatory` varchar(255) default NULL,
  `organisations_transferred_investigator_recruitement` varchar(255) default NULL,
  `organisations_transferred_IVRS` varchar(255) default NULL,
  `organisations_transferred_data_management` varchar(255) default NULL,
  `organisations_transferred_edata_capture` varchar(255) default NULL,
  `organisations_transferred_SUSAR_reporting` varchar(255) default NULL,
  `organisations_transferred_quality_assurance_auditing` varchar(255) default NULL,
  `organisations_transferred_statistical_analysis` varchar(255) default NULL,
  `organisations_transferred_medical_writing` varchar(255) default NULL,
  `organisations_transferred_other_duties_subcontracted` varchar(255) default NULL,
  `organisations_transferred_specify` text,
  `delete_status` binary(1) default '0',
  `number_participants` text,
  `protocol_reviewers_names` text,
  `approval_date` date default NULL,
  `attachments` blob,
  `current_status_trial` varchar(255) default NULL,
  `ncst_number` varchar(255) default NULL,
  `Name_IRB` varchar(255) default NULL,
  `Approval_till_date` date default NULL,
  `application_file_path` varchar(100) default NULL,
  `application_fiile_name` varchar(100) default NULL,
  `application_file_size` varchar(100) default NULL,
  `application_content_type` varchar(100) default NULL,
  `modified` datetime default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `mobile_number` varchar(255) default NULL,
  `telephone_number` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `box_address` varchar(255) default NULL,
  `fax_number` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) default NULL,
  `central_organisation` varchar(255) default NULL,
  `central_name_contact_person` varchar(255) default NULL,
  `central_address` varchar(255) default NULL,
  `central_telephone_number` varchar(255) default NULL,
  `central_duties_subcontracted` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `information_placebos`
--

CREATE TABLE IF NOT EXISTS `information_placebos` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) default NULL,
  `placebo_number` varchar(255) default NULL,
  `placebo_pharmaceutical_form` varchar(255) default NULL,
  `placebo_route_of_administration` varchar(255) default NULL,
  `placebo_IMP_number` varchar(255) default NULL,
  `placebo_composition` varchar(255) default NULL,
  `placebo_indentical` varchar(255) default NULL,
  `placebo_major_ingredients` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `investigators`
--

CREATE TABLE IF NOT EXISTS `investigators` (
  `id` int(10) NOT NULL auto_increment,
  `application_id` int(10) default NULL,
  `given_name` varchar(255) default NULL,
  `middle_name` varchar(255) default NULL,
  `family_name` varchar(255) default NULL,
  `qualification` varchar(255) default NULL,
  `professional_address` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `from` int(11) default NULL,
  `subject` varchar(255) default NULL,
  `body` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `previous_dates`
--

CREATE TABLE IF NOT EXISTS `previous_dates` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `details` varchar(250) default NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `principal_investigators`
--

CREATE TABLE IF NOT EXISTS `principal_investigators` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) default NULL,
  `investigator_given_name` varchar(255) default NULL,
  `investigator_middle_name` varchar(255) default NULL,
  `investigator_family_name` varchar(255) default NULL,
  `investigator_qualification` varchar(255) default NULL,
  `investigator_professional_address` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE IF NOT EXISTS `queries` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) default NULL,
  `subject` varchar(255) default NULL,
  `body` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_organizations`
--

CREATE TABLE IF NOT EXISTS `sponsor_organizations` (
  `id` int(11) NOT NULL auto_increment,
  `application_id` int(11) default NULL,
  `organisations_transferred_name` varchar(255) default NULL,
  `organisations_transferred_contact_person` varchar(255) default NULL,
  `organisations_transferred_address` varchar(255) default NULL,
  `organisations_transferred_telephone_number` varchar(255) default NULL,
  `organisations_transferred_all_tasks` varchar(255) default NULL,
  `organisations_transferred_monitoring` varchar(255) default NULL,
  `organisations_transferred_regulatory` varchar(255) default NULL,
  `organisations_transferred_investigator_recruitement` varchar(255) default NULL,
  `organisations_transferred_IVRS` varchar(255) default NULL,
  `organisations_transferred_data_management` varchar(255) default NULL,
  `organisations_transferred_edata_capture` varchar(255) default NULL,
  `organisations_transferred_SUSAR_reporting` varchar(255) default NULL,
  `organisations_transferred_quality_assurance_auditing` varchar(255) default NULL,
  `organisations_transferred_statistical_analysis` varchar(255) default NULL,
  `organisations_transferred_medical_writing` varchar(255) default NULL,
  `organisations_transferred_other_duties_subcontracted` varchar(255) default NULL,
  `organisations_transferred_specify` tinytext,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
