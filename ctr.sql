-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2012 at 04:59 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ctr`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 250),
(2, 1, NULL, NULL, 'Groups', 2, 13),
(3, 2, NULL, NULL, 'index', 3, 4),
(4, 2, NULL, NULL, 'view', 5, 6),
(5, 2, NULL, NULL, 'add', 7, 8),
(6, 2, NULL, NULL, 'edit', 9, 10),
(7, 2, NULL, NULL, 'delete', 11, 12),
(8, 1, NULL, NULL, 'Pages', 14, 17),
(9, 8, NULL, NULL, 'display', 15, 16),
(10, 1, NULL, NULL, 'Users', 18, 43),
(11, 10, NULL, NULL, 'login', 19, 20),
(12, 10, NULL, NULL, 'logout', 21, 22),
(13, 10, NULL, NULL, 'index', 23, 24),
(14, 10, NULL, NULL, 'view', 25, 26),
(15, 10, NULL, NULL, 'add', 27, 28),
(16, 10, NULL, NULL, 'edit', 29, 30),
(17, 10, NULL, NULL, 'delete', 31, 32),
(18, 1, NULL, NULL, 'AclExtras', 44, 45),
(19, 1, NULL, NULL, 'Applications', 46, 73),
(21, 19, NULL, NULL, 'index', 47, 48),
(22, 19, NULL, NULL, 'view', 49, 50),
(25, 19, NULL, NULL, 'delete', 51, 52),
(26, 1, NULL, NULL, 'Counties', 74, 85),
(27, 26, NULL, NULL, 'index', 75, 76),
(28, 26, NULL, NULL, 'view', 77, 78),
(29, 26, NULL, NULL, 'add', 79, 80),
(30, 26, NULL, NULL, 'edit', 81, 82),
(31, 26, NULL, NULL, 'delete', 83, 84),
(32, 1, NULL, NULL, 'InvestigatorContacts', 86, 97),
(33, 32, NULL, NULL, 'index', 87, 88),
(34, 32, NULL, NULL, 'view', 89, 90),
(35, 32, NULL, NULL, 'add', 91, 92),
(36, 32, NULL, NULL, 'edit', 93, 94),
(37, 32, NULL, NULL, 'delete', 95, 96),
(38, 1, NULL, NULL, 'PreviousDates', 98, 109),
(39, 38, NULL, NULL, 'index', 99, 100),
(40, 38, NULL, NULL, 'view', 101, 102),
(41, 38, NULL, NULL, 'add', 103, 104),
(42, 38, NULL, NULL, 'edit', 105, 106),
(43, 38, NULL, NULL, 'delete', 107, 108),
(44, 1, NULL, NULL, 'SiteDetails', 110, 121),
(45, 44, NULL, NULL, 'index', 111, 112),
(46, 44, NULL, NULL, 'view', 113, 114),
(47, 44, NULL, NULL, 'add', 115, 116),
(48, 44, NULL, NULL, 'edit', 117, 118),
(49, 44, NULL, NULL, 'delete', 119, 120),
(50, 10, NULL, NULL, 'register', 33, 34),
(51, 10, NULL, NULL, 'initDB', 35, 36),
(52, 1, NULL, NULL, 'Media', 122, 123),
(54, 19, NULL, NULL, 'myindex', 53, 54),
(55, 19, NULL, NULL, 'applicant_add', 55, 56),
(56, 19, NULL, NULL, 'applicant_edit', 57, 58),
(57, 1, NULL, NULL, 'Attachments', 124, 133),
(58, 57, NULL, NULL, 'view', 125, 126),
(59, 57, NULL, NULL, 'download', 127, 128),
(60, 57, NULL, NULL, 'admin_download', 129, 130),
(65, 1, NULL, NULL, 'Organizations', 134, 145),
(66, 65, NULL, NULL, 'index', 135, 136),
(67, 65, NULL, NULL, 'view', 137, 138),
(68, 65, NULL, NULL, 'add', 139, 140),
(69, 65, NULL, NULL, 'edit', 141, 142),
(70, 65, NULL, NULL, 'delete', 143, 144),
(73, 1, NULL, NULL, 'Placebos', 146, 157),
(74, 73, NULL, NULL, 'index', 147, 148),
(75, 73, NULL, NULL, 'view', 149, 150),
(76, 73, NULL, NULL, 'add', 151, 152),
(77, 73, NULL, NULL, 'edit', 153, 154),
(78, 73, NULL, NULL, 'delete', 155, 156),
(82, 1, NULL, NULL, 'Sponsors', 158, 169),
(83, 82, NULL, NULL, 'index', 159, 160),
(84, 82, NULL, NULL, 'view', 161, 162),
(85, 82, NULL, NULL, 'add', 163, 164),
(86, 82, NULL, NULL, 'edit', 165, 166),
(87, 82, NULL, NULL, 'delete', 167, 168),
(89, 1, NULL, NULL, 'TrialStatuses', 170, 181),
(90, 89, NULL, NULL, 'index', 171, 172),
(91, 89, NULL, NULL, 'view', 173, 174),
(92, 89, NULL, NULL, 'add', 175, 176),
(93, 89, NULL, NULL, 'edit', 177, 178),
(94, 89, NULL, NULL, 'delete', 179, 180),
(96, 10, NULL, NULL, 'applicant_dashboard', 37, 38),
(98, 1, NULL, NULL, 'Countries', 182, 193),
(99, 98, NULL, NULL, 'index', 183, 184),
(100, 98, NULL, NULL, 'view', 185, 186),
(101, 98, NULL, NULL, 'add', 187, 188),
(102, 98, NULL, NULL, 'edit', 189, 190),
(103, 98, NULL, NULL, 'delete', 191, 192),
(104, 57, NULL, NULL, 'delete', 131, 132),
(105, 19, NULL, NULL, 'applicant_view', 59, 60),
(106, 19, NULL, NULL, 'applicant_index', 61, 62),
(107, 19, NULL, NULL, 'applicant_delete', 63, 64),
(108, 1, NULL, NULL, 'Amendments', 194, 205),
(110, 108, NULL, NULL, 'view', 195, 196),
(111, 108, NULL, NULL, 'applicant_add', 197, 198),
(114, 1, NULL, NULL, 'Search', 206, 207),
(115, 108, NULL, NULL, 'applicant_index', 199, 200),
(116, 108, NULL, NULL, 'applicant_edit', 201, 202),
(117, 108, NULL, NULL, 'applicant_delete', 203, 204),
(118, 10, NULL, NULL, 'manager_dashboard', 39, 40),
(119, 19, NULL, NULL, 'manager_index', 65, 66),
(120, 19, NULL, NULL, 'manager_view', 67, 68),
(121, 1, NULL, NULL, 'Reviewers', 208, 221),
(122, 121, NULL, NULL, 'index', 209, 210),
(123, 121, NULL, NULL, 'view', 211, 212),
(124, 121, NULL, NULL, 'manager_add', 213, 214),
(125, 121, NULL, NULL, 'edit', 215, 216),
(126, 121, NULL, NULL, 'delete', 217, 218),
(127, 1, NULL, NULL, 'Reviews', 222, 237),
(128, 127, NULL, NULL, 'index', 223, 224),
(129, 127, NULL, NULL, 'view', 225, 226),
(131, 127, NULL, NULL, 'edit', 227, 228),
(132, 127, NULL, NULL, 'delete', 229, 230),
(133, 10, NULL, NULL, 'reviewer_dashboard', 41, 42),
(134, 19, NULL, NULL, 'reviewer_index', 69, 70),
(135, 19, NULL, NULL, 'reviewer_view', 71, 72),
(136, 1, NULL, NULL, 'Notifications', 238, 249),
(137, 136, NULL, NULL, 'index', 239, 240),
(138, 136, NULL, NULL, 'view', 241, 242),
(139, 136, NULL, NULL, 'add', 243, 244),
(140, 136, NULL, NULL, 'edit', 245, 246),
(141, 136, NULL, NULL, 'delete', 247, 248),
(142, 121, NULL, NULL, 'reviewer_confirm', 219, 220),
(143, 127, NULL, NULL, 'manager_add', 231, 232),
(144, 127, NULL, NULL, 'reviewer_respond', 233, 234),
(145, 127, NULL, NULL, 'reviewer_add', 235, 236);

-- --------------------------------------------------------

--
-- Table structure for table `amendments`
--

CREATE TABLE IF NOT EXISTS `amendments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `trial_status_id` int(11) DEFAULT NULL,
  `abstract_of_study` text,
  `study_title` text,
  `protocol_no` varchar(255) DEFAULT NULL,
  `version_no` varchar(255) DEFAULT NULL,
  `date_of_protocol` date DEFAULT NULL,
  `study_drug` varchar(255) DEFAULT NULL,
  `disease_condition` varchar(255) DEFAULT NULL,
  `product_type` text,
  `product_type_biologicals` tinyint(1) DEFAULT NULL,
  `product_type_proteins` tinyint(1) DEFAULT NULL,
  `product_type_immunologicals` tinyint(1) DEFAULT NULL,
  `product_type_vaccines` tinyint(1) DEFAULT NULL,
  `product_type_hormones` tinyint(1) DEFAULT NULL,
  `product_type_toxoid` tinyint(1) DEFAULT NULL,
  `product_type_chemical` tinyint(1) DEFAULT NULL,
  `product_type_medical_device` tinyint(1) DEFAULT NULL,
  `product_type_chemical_name` varchar(255) DEFAULT NULL,
  `product_type_medical_device_name` varchar(255) DEFAULT NULL,
  `ecct_not_applicable` tinyint(1) DEFAULT '0',
  `ecct_ref_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `applicant_covering_letter` tinyint(1) DEFAULT NULL,
  `applicant_protocol` tinyint(1) DEFAULT NULL,
  `applicant_patient_information` tinyint(1) DEFAULT NULL,
  `applicant_investigators_brochure` tinyint(1) DEFAULT NULL,
  `applicant_investigators_cv` tinyint(1) DEFAULT NULL,
  `applicant_signed_declaration` tinyint(1) DEFAULT NULL,
  `applicant_financial_declaration` tinyint(1) DEFAULT NULL,
  `applicant_gmp_certificate` tinyint(1) DEFAULT NULL,
  `applicant_indemnity_cover` tinyint(1) DEFAULT NULL,
  `applicant_opinion_letter` tinyint(1) DEFAULT NULL,
  `applicant_approval_letter` tinyint(1) DEFAULT NULL,
  `applicant_statement` tinyint(1) DEFAULT NULL,
  `applicant_participating_countries` tinyint(1) DEFAULT NULL,
  `applicant_addendum` tinyint(1) DEFAULT NULL,
  `applicant_fees` tinyint(1) DEFAULT NULL,
  `declaration_applicant` varchar(255) DEFAULT NULL,
  `declaration_date1` date DEFAULT NULL,
  `declaration_principal_investigator` varchar(255) DEFAULT NULL,
  `declaration_date2` date DEFAULT NULL,
  `placebo_present` varchar(255) DEFAULT NULL,
  `principal_inclusion_criteria` text,
  `principal_exclusion_criteria` text,
  `primary_end_points` text,
  `scope_diagnosis` tinyint(1) DEFAULT NULL,
  `scope_prophylaxis` tinyint(1) DEFAULT NULL,
  `scope_therapy` tinyint(1) DEFAULT NULL,
  `scope_safety` tinyint(1) DEFAULT NULL,
  `scope_efficacy` tinyint(1) DEFAULT NULL,
  `scope_pharmacokinetic` tinyint(1) DEFAULT NULL,
  `scope_pharmacodynamic` tinyint(1) DEFAULT NULL,
  `scope_bioequivalence` tinyint(1) DEFAULT NULL,
  `scope_dose_response` tinyint(1) DEFAULT NULL,
  `scope_pharmacogenetic` tinyint(1) DEFAULT NULL,
  `scope_pharmacogenomic` tinyint(1) DEFAULT NULL,
  `scope_pharmacoecomomic` tinyint(1) DEFAULT NULL,
  `scope_others` tinyint(1) DEFAULT NULL,
  `scope_others_specify` text,
  `trial_human_pharmacology` tinyint(1) DEFAULT NULL,
  `trial_administration_humans` tinyint(1) DEFAULT NULL,
  `trial_bioequivalence_study` tinyint(1) DEFAULT NULL,
  `trial_other` tinyint(1) DEFAULT NULL,
  `trial_other_specify` text,
  `trial_therapeutic_exploratory` tinyint(1) DEFAULT NULL,
  `trial_therapeutic_confirmatory` tinyint(1) DEFAULT NULL,
  `trial_therapeutic_use` tinyint(1) DEFAULT NULL,
  `design_controlled` varchar(255) DEFAULT NULL,
  `site_capacity` varchar(100) DEFAULT NULL,
  `staff_numbers` text,
  `other_details_explanation` text,
  `other_details_regulatory_notapproved` text,
  `other_details_regulatory_approved` text,
  `other_details_regulatory_rejected` text,
  `other_details_regulatory_halted` text,
  `estimated_duration` varchar(255) DEFAULT NULL,
  `design_controlled_randomised` varchar(255) DEFAULT NULL,
  `design_controlled_open` varchar(255) DEFAULT NULL,
  `design_controlled_single_blind` varchar(255) DEFAULT NULL,
  `design_controlled_double_blind` varchar(255) DEFAULT NULL,
  `design_controlled_parallel_group` varchar(255) DEFAULT NULL,
  `design_controlled_cross_over` varchar(255) DEFAULT NULL,
  `design_controlled_other` varchar(255) DEFAULT NULL,
  `design_controlled_specify` varchar(255) DEFAULT NULL,
  `design_controlled_comparator` varchar(255) DEFAULT NULL,
  `design_controlled_other_medicinal` varchar(255) DEFAULT NULL,
  `design_controlled_placebo` varchar(255) DEFAULT NULL,
  `design_controlled_medicinal_other` varchar(255) DEFAULT NULL,
  `design_controlled_medicinal_specify` varchar(255) DEFAULT NULL,
  `single_site_member_state` varchar(255) DEFAULT NULL,
  `location_of_area` varchar(255) DEFAULT NULL,
  `multiple_sites_member_state` varchar(255) DEFAULT NULL,
  `multiple_countries` char(30) DEFAULT NULL,
  `multiple_member_states` varchar(255) DEFAULT NULL,
  `number_of_sites` varchar(255) DEFAULT NULL,
  `multi_country_list` text,
  `data_monitoring_committee` varchar(255) DEFAULT NULL,
  `total_enrolment_per_site` text,
  `total_participants_worldwide` varchar(255) DEFAULT '',
  `population_less_than_18_years` varchar(255) DEFAULT NULL,
  `population_utero` varchar(255) DEFAULT NULL,
  `population_preterm_newborn` varchar(255) DEFAULT NULL,
  `population_newborn` varchar(255) DEFAULT NULL,
  `population_infant_and_toddler` varchar(255) DEFAULT NULL,
  `population_children` varchar(255) DEFAULT NULL,
  `population_adolescent` varchar(255) DEFAULT NULL,
  `population_above_18` char(30) DEFAULT NULL,
  `population_adult` varchar(255) DEFAULT NULL,
  `population_elderly` varchar(255) DEFAULT NULL,
  `gender_female` tinyint(1) DEFAULT NULL,
  `gender_male` tinyint(1) DEFAULT NULL,
  `subjects_healthy` varchar(255) DEFAULT NULL,
  `subjects_patients` varchar(255) DEFAULT NULL,
  `subjects_vulnerable_populations` varchar(255) DEFAULT NULL,
  `subjects_women_child_bearing` varchar(255) DEFAULT NULL,
  `subjects_women_using_contraception` varchar(255) DEFAULT NULL,
  `subjects_pregnant_women` varchar(255) DEFAULT NULL,
  `subjects_nursing_women` varchar(255) DEFAULT NULL,
  `subjects_emergency_situation` varchar(255) DEFAULT NULL,
  `subjects_incapable_consent` varchar(255) DEFAULT NULL,
  `subjects_specify` text,
  `subjects_others` varchar(255) DEFAULT NULL,
  `subjects_others_specify` text,
  `investigator1_given_name` varchar(255) DEFAULT NULL,
  `investigator1_middle_name` varchar(255) DEFAULT NULL,
  `investigator1_family_name` varchar(255) DEFAULT NULL,
  `investigator1_qualification` varchar(255) DEFAULT NULL,
  `investigator1_professional_address` varchar(255) DEFAULT NULL,
  `organisations_transferred_` varchar(255) DEFAULT NULL,
  `number_participants` text,
  `approval_date` date DEFAULT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT '0',
  `date_submitted` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `amendments`
--

INSERT INTO `amendments` (`id`, `application_id`, `trial_status_id`, `abstract_of_study`, `study_title`, `protocol_no`, `version_no`, `date_of_protocol`, `study_drug`, `disease_condition`, `product_type`, `product_type_biologicals`, `product_type_proteins`, `product_type_immunologicals`, `product_type_vaccines`, `product_type_hormones`, `product_type_toxoid`, `product_type_chemical`, `product_type_medical_device`, `product_type_chemical_name`, `product_type_medical_device_name`, `ecct_not_applicable`, `ecct_ref_number`, `email_address`, `applicant_covering_letter`, `applicant_protocol`, `applicant_patient_information`, `applicant_investigators_brochure`, `applicant_investigators_cv`, `applicant_signed_declaration`, `applicant_financial_declaration`, `applicant_gmp_certificate`, `applicant_indemnity_cover`, `applicant_opinion_letter`, `applicant_approval_letter`, `applicant_statement`, `applicant_participating_countries`, `applicant_addendum`, `applicant_fees`, `declaration_applicant`, `declaration_date1`, `declaration_principal_investigator`, `declaration_date2`, `placebo_present`, `principal_inclusion_criteria`, `principal_exclusion_criteria`, `primary_end_points`, `scope_diagnosis`, `scope_prophylaxis`, `scope_therapy`, `scope_safety`, `scope_efficacy`, `scope_pharmacokinetic`, `scope_pharmacodynamic`, `scope_bioequivalence`, `scope_dose_response`, `scope_pharmacogenetic`, `scope_pharmacogenomic`, `scope_pharmacoecomomic`, `scope_others`, `scope_others_specify`, `trial_human_pharmacology`, `trial_administration_humans`, `trial_bioequivalence_study`, `trial_other`, `trial_other_specify`, `trial_therapeutic_exploratory`, `trial_therapeutic_confirmatory`, `trial_therapeutic_use`, `design_controlled`, `site_capacity`, `staff_numbers`, `other_details_explanation`, `other_details_regulatory_notapproved`, `other_details_regulatory_approved`, `other_details_regulatory_rejected`, `other_details_regulatory_halted`, `estimated_duration`, `design_controlled_randomised`, `design_controlled_open`, `design_controlled_single_blind`, `design_controlled_double_blind`, `design_controlled_parallel_group`, `design_controlled_cross_over`, `design_controlled_other`, `design_controlled_specify`, `design_controlled_comparator`, `design_controlled_other_medicinal`, `design_controlled_placebo`, `design_controlled_medicinal_other`, `design_controlled_medicinal_specify`, `single_site_member_state`, `location_of_area`, `multiple_sites_member_state`, `multiple_countries`, `multiple_member_states`, `number_of_sites`, `multi_country_list`, `data_monitoring_committee`, `total_enrolment_per_site`, `total_participants_worldwide`, `population_less_than_18_years`, `population_utero`, `population_preterm_newborn`, `population_newborn`, `population_infant_and_toddler`, `population_children`, `population_adolescent`, `population_above_18`, `population_adult`, `population_elderly`, `gender_female`, `gender_male`, `subjects_healthy`, `subjects_patients`, `subjects_vulnerable_populations`, `subjects_women_child_bearing`, `subjects_women_using_contraception`, `subjects_pregnant_women`, `subjects_nursing_women`, `subjects_emergency_situation`, `subjects_incapable_consent`, `subjects_specify`, `subjects_others`, `subjects_others_specify`, `investigator1_given_name`, `investigator1_middle_name`, `investigator1_family_name`, `investigator1_qualification`, `investigator1_professional_address`, `organisations_transferred_`, `number_participants`, `approval_date`, `submitted`, `date_submitted`, `modified`, `created`) VALUES
(1, 1, NULL, '<p>\r\n	happens</p>\r\n<p>\r\n	when</p>\r\n', '<p>\r\n	this</p>\r\n<p>\r\n	is</p>\r\n<p>\r\n	what</p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, '1254', '2012-11-30', 'amoxlyl', 'siphilis', '234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-23', 1, '2012-11-30 10:48:47', '2012-11-30 10:48:47', '2012-11-30 10:44:05'),
(3, 1, NULL, '<p>\r\n	sadf</p>\r\n', '<p>\r\n	sdf</p>\r\n', NULL, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2012-11-30 10:52:54', '2012-11-30 10:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trial_status_id` int(11) DEFAULT NULL,
  `abstract_of_study` text,
  `study_title` text,
  `protocol_no` varchar(255) DEFAULT NULL,
  `version_no` varchar(255) DEFAULT NULL,
  `date_of_protocol` date DEFAULT NULL,
  `study_drug` varchar(255) DEFAULT NULL,
  `disease_condition` varchar(255) DEFAULT NULL,
  `product_type_biologicals` tinyint(1) DEFAULT NULL,
  `product_type_proteins` tinyint(1) DEFAULT NULL,
  `product_type_immunologicals` tinyint(1) DEFAULT NULL,
  `product_type_vaccines` tinyint(1) DEFAULT NULL,
  `product_type_hormones` tinyint(1) DEFAULT NULL,
  `product_type_toxoid` tinyint(1) DEFAULT NULL,
  `product_type_chemical` tinyint(1) DEFAULT NULL,
  `product_type_medical_device` tinyint(1) DEFAULT NULL,
  `product_type_chemical_name` varchar(255) DEFAULT NULL,
  `product_type_medical_device_name` varchar(255) DEFAULT NULL,
  `ecct_not_applicable` tinyint(1) DEFAULT '0',
  `ecct_ref_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `applicant_covering_letter` tinyint(1) DEFAULT NULL,
  `applicant_protocol` tinyint(1) DEFAULT NULL,
  `applicant_patient_information` tinyint(1) DEFAULT NULL,
  `applicant_investigators_brochure` tinyint(1) DEFAULT NULL,
  `applicant_investigators_cv` tinyint(1) DEFAULT NULL,
  `applicant_signed_declaration` tinyint(1) DEFAULT NULL,
  `applicant_financial_declaration` tinyint(1) DEFAULT NULL,
  `applicant_gmp_certificate` tinyint(1) DEFAULT NULL,
  `applicant_indemnity_cover` tinyint(1) DEFAULT NULL,
  `applicant_opinion_letter` tinyint(1) DEFAULT NULL,
  `applicant_approval_letter` tinyint(1) DEFAULT NULL,
  `applicant_statement` tinyint(1) DEFAULT NULL,
  `applicant_participating_countries` tinyint(1) DEFAULT NULL,
  `applicant_addendum` tinyint(1) DEFAULT NULL,
  `applicant_fees` tinyint(1) DEFAULT NULL,
  `declaration_applicant` varchar(255) DEFAULT NULL,
  `declaration_date1` date DEFAULT NULL,
  `declaration_principal_investigator` varchar(255) DEFAULT NULL,
  `declaration_date2` date DEFAULT NULL,
  `placebo_present` varchar(255) DEFAULT NULL,
  `principal_inclusion_criteria` text,
  `principal_exclusion_criteria` text,
  `primary_end_points` text,
  `scope_diagnosis` tinyint(1) DEFAULT NULL,
  `scope_prophylaxis` tinyint(1) DEFAULT NULL,
  `scope_therapy` tinyint(1) DEFAULT NULL,
  `scope_safety` tinyint(1) DEFAULT NULL,
  `scope_efficacy` tinyint(1) DEFAULT NULL,
  `scope_pharmacokinetic` tinyint(1) DEFAULT NULL,
  `scope_pharmacodynamic` tinyint(1) DEFAULT NULL,
  `scope_bioequivalence` tinyint(1) DEFAULT NULL,
  `scope_dose_response` tinyint(1) DEFAULT NULL,
  `scope_pharmacogenetic` tinyint(1) DEFAULT NULL,
  `scope_pharmacogenomic` tinyint(1) DEFAULT NULL,
  `scope_pharmacoecomomic` tinyint(1) DEFAULT NULL,
  `scope_others` tinyint(1) DEFAULT NULL,
  `scope_others_specify` text,
  `trial_human_pharmacology` tinyint(1) DEFAULT NULL,
  `trial_administration_humans` tinyint(1) DEFAULT NULL,
  `trial_bioequivalence_study` tinyint(1) DEFAULT NULL,
  `trial_other` tinyint(1) DEFAULT NULL,
  `trial_other_specify` text,
  `trial_therapeutic_exploratory` tinyint(1) DEFAULT NULL,
  `trial_therapeutic_confirmatory` tinyint(1) DEFAULT NULL,
  `trial_therapeutic_use` tinyint(1) DEFAULT NULL,
  `design_controlled` varchar(255) DEFAULT NULL,
  `site_capacity` varchar(100) DEFAULT NULL,
  `staff_numbers` text,
  `other_details_explanation` text,
  `other_details_regulatory_notapproved` text,
  `other_details_regulatory_approved` text,
  `other_details_regulatory_rejected` text,
  `other_details_regulatory_halted` text,
  `estimated_duration` varchar(255) DEFAULT NULL,
  `design_controlled_randomised` varchar(255) DEFAULT NULL,
  `design_controlled_open` varchar(255) DEFAULT NULL,
  `design_controlled_single_blind` varchar(255) DEFAULT NULL,
  `design_controlled_double_blind` varchar(255) DEFAULT NULL,
  `design_controlled_parallel_group` varchar(255) DEFAULT NULL,
  `design_controlled_cross_over` varchar(255) DEFAULT NULL,
  `design_controlled_other` varchar(255) DEFAULT NULL,
  `design_controlled_specify` varchar(255) DEFAULT NULL,
  `design_controlled_comparator` varchar(255) DEFAULT NULL,
  `design_controlled_other_medicinal` varchar(255) DEFAULT NULL,
  `design_controlled_placebo` varchar(255) DEFAULT NULL,
  `design_controlled_medicinal_other` varchar(255) DEFAULT NULL,
  `design_controlled_medicinal_specify` varchar(255) DEFAULT NULL,
  `single_site_member_state` varchar(255) DEFAULT NULL,
  `location_of_area` varchar(255) DEFAULT NULL,
  `multiple_sites_member_state` varchar(255) DEFAULT NULL,
  `multiple_countries` char(30) DEFAULT NULL,
  `multiple_member_states` varchar(255) DEFAULT NULL,
  `number_of_sites` varchar(255) DEFAULT NULL,
  `multi_country_list` text,
  `data_monitoring_committee` varchar(255) DEFAULT NULL,
  `total_enrolment_per_site` text,
  `total_participants_worldwide` varchar(255) DEFAULT '',
  `population_less_than_18_years` varchar(255) DEFAULT NULL,
  `population_utero` varchar(255) DEFAULT NULL,
  `population_preterm_newborn` varchar(255) DEFAULT NULL,
  `population_newborn` varchar(255) DEFAULT NULL,
  `population_infant_and_toddler` varchar(255) DEFAULT NULL,
  `population_children` varchar(255) DEFAULT NULL,
  `population_adolescent` varchar(255) DEFAULT NULL,
  `population_above_18` char(30) DEFAULT NULL,
  `population_adult` varchar(255) DEFAULT NULL,
  `population_elderly` varchar(255) DEFAULT NULL,
  `gender_female` tinyint(1) DEFAULT NULL,
  `gender_male` tinyint(1) DEFAULT NULL,
  `subjects_healthy` varchar(255) DEFAULT NULL,
  `subjects_patients` varchar(255) DEFAULT NULL,
  `subjects_vulnerable_populations` varchar(255) DEFAULT NULL,
  `subjects_women_child_bearing` varchar(255) DEFAULT NULL,
  `subjects_women_using_contraception` varchar(255) DEFAULT NULL,
  `subjects_pregnant_women` varchar(255) DEFAULT NULL,
  `subjects_nursing_women` varchar(255) DEFAULT NULL,
  `subjects_emergency_situation` varchar(255) DEFAULT NULL,
  `subjects_incapable_consent` varchar(255) DEFAULT NULL,
  `subjects_specify` text,
  `subjects_others` varchar(255) DEFAULT NULL,
  `subjects_others_specify` text,
  `investigator1_given_name` varchar(255) DEFAULT NULL,
  `investigator1_middle_name` varchar(255) DEFAULT NULL,
  `investigator1_family_name` varchar(255) DEFAULT NULL,
  `investigator1_qualification` varchar(255) DEFAULT NULL,
  `investigator1_professional_address` varchar(255) DEFAULT NULL,
  `organisations_transferred_` varchar(255) DEFAULT NULL,
  `number_participants` text,
  `approval_date` date DEFAULT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT '0',
  `date_submitted` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=18 ;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `trial_status_id`, `abstract_of_study`, `study_title`, `protocol_no`, `version_no`, `date_of_protocol`, `study_drug`, `disease_condition`, `product_type_biologicals`, `product_type_proteins`, `product_type_immunologicals`, `product_type_vaccines`, `product_type_hormones`, `product_type_toxoid`, `product_type_chemical`, `product_type_medical_device`, `product_type_chemical_name`, `product_type_medical_device_name`, `ecct_not_applicable`, `ecct_ref_number`, `email_address`, `applicant_covering_letter`, `applicant_protocol`, `applicant_patient_information`, `applicant_investigators_brochure`, `applicant_investigators_cv`, `applicant_signed_declaration`, `applicant_financial_declaration`, `applicant_gmp_certificate`, `applicant_indemnity_cover`, `applicant_opinion_letter`, `applicant_approval_letter`, `applicant_statement`, `applicant_participating_countries`, `applicant_addendum`, `applicant_fees`, `declaration_applicant`, `declaration_date1`, `declaration_principal_investigator`, `declaration_date2`, `placebo_present`, `principal_inclusion_criteria`, `principal_exclusion_criteria`, `primary_end_points`, `scope_diagnosis`, `scope_prophylaxis`, `scope_therapy`, `scope_safety`, `scope_efficacy`, `scope_pharmacokinetic`, `scope_pharmacodynamic`, `scope_bioequivalence`, `scope_dose_response`, `scope_pharmacogenetic`, `scope_pharmacogenomic`, `scope_pharmacoecomomic`, `scope_others`, `scope_others_specify`, `trial_human_pharmacology`, `trial_administration_humans`, `trial_bioequivalence_study`, `trial_other`, `trial_other_specify`, `trial_therapeutic_exploratory`, `trial_therapeutic_confirmatory`, `trial_therapeutic_use`, `design_controlled`, `site_capacity`, `staff_numbers`, `other_details_explanation`, `other_details_regulatory_notapproved`, `other_details_regulatory_approved`, `other_details_regulatory_rejected`, `other_details_regulatory_halted`, `estimated_duration`, `design_controlled_randomised`, `design_controlled_open`, `design_controlled_single_blind`, `design_controlled_double_blind`, `design_controlled_parallel_group`, `design_controlled_cross_over`, `design_controlled_other`, `design_controlled_specify`, `design_controlled_comparator`, `design_controlled_other_medicinal`, `design_controlled_placebo`, `design_controlled_medicinal_other`, `design_controlled_medicinal_specify`, `single_site_member_state`, `location_of_area`, `multiple_sites_member_state`, `multiple_countries`, `multiple_member_states`, `number_of_sites`, `multi_country_list`, `data_monitoring_committee`, `total_enrolment_per_site`, `total_participants_worldwide`, `population_less_than_18_years`, `population_utero`, `population_preterm_newborn`, `population_newborn`, `population_infant_and_toddler`, `population_children`, `population_adolescent`, `population_above_18`, `population_adult`, `population_elderly`, `gender_female`, `gender_male`, `subjects_healthy`, `subjects_patients`, `subjects_vulnerable_populations`, `subjects_women_child_bearing`, `subjects_women_using_contraception`, `subjects_pregnant_women`, `subjects_nursing_women`, `subjects_emergency_situation`, `subjects_incapable_consent`, `subjects_specify`, `subjects_others`, `subjects_others_specify`, `investigator1_given_name`, `investigator1_middle_name`, `investigator1_family_name`, `investigator1_qualification`, `investigator1_professional_address`, `organisations_transferred_`, `number_participants`, `approval_date`, `submitted`, `date_submitted`, `modified`, `created`) VALUES
(1, 6, NULL, '<h1>\r\n	Lorem ipsum dolor sit amet</h1>\r\n<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec at odio vitae libero tempus convallis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum purus mauris, dapibus eu, sagittis quis, sagittis quis, mi. Morbi fringilla massa quis velit. Curabitur metus massa, semper mollis, molestie vel, adipiscing nec, massa. Phasellus vitae felis sed lectus dapibus facilisis. In ultrices sagittis ipsum. In at est. Integer iaculis turpis vel magna. Cras eu est. Integer porttitor ligula a tellus. Curabitur accumsan ipsum a velit. Sed laoreet lectus quis leo. Nulla pellentesque molestie ante. Quisque vestibulum est id justo. Ut pellentesque ante in neque.</p>\r\n<p>Just noted </p>\r\n<p>Something </p>\r\n<p>very odd </p>', '<div class="bs-docs-example">\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</div>\r\n\r\n', 'ECCT/12/11/01', '001', '2012-11-01', 'Stavudine', 'HIV', 1, 0, 1, 0, 0, 1, 1, 1, 'sulphur', 'listener', 0, '', 'eddieokemwa@gmail.com', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 'mayakos', '2012-11-08', 'wasdf', '2012-11-07', 'Yes', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'If others please specify', 1, 1, 0, 1, 'If other, please specify', 1, 0, 1, 'Yes', NULL, '<p>\r\n	ten men</p>\r\n<p>\r\n	twendy women</p>\r\n<p>\r\n	thirty broods</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '<p>\r\n	<i>&quot;As soon as we started programming, we found to our surprise that it wasn&#39;t as easy to get programs right as we had thought.&nbsp;&nbsp;Debugging had to be discovered.&nbsp;&nbsp;I can remember the exact instant when I realized that a large part of my life from then on was going to be spent in finding mistakes in my own programs.&quot;</i><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--Maur</p>\r\n', '10 weeks', 'Yes', 'No', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'kama?', 'whicha', 'Yes', 'Yes', 'Yes', 'kam watta?', 'No', '', 'No', 'Yes', '2', '', 'Kenya \r\nTz', 'Yes', '1203\r\n10 in Migori\r\n5 in Machakos ', '2000', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'No', 1, 1, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Properly attired', 'Yes', 'Watta gwan', 'Joash Ambani', 'Aka', 'Mugabe', 'Celtic', 'Stockholm', 'Yes', 'Like 34 but I am not sure', '2012-11-06', 1, '2012-11-19 16:04:17', '2012-11-19 16:04:17', '2012-10-27 12:08:55'),
(3, 6, NULL, '', '', NULL, '', NULL, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 'eddieokemwa@gmail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL, '2012-11-14 17:07:25', '2012-11-14 12:29:27'),
(4, 6, NULL, '<p>\r\n	echo $this-&gt;Paginator-&gt;counter(array( &#39;format&#39; =&gt; __(&#39;Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>, showing <span class="badge">{:current}</span> Applications out of <span class="badge badge-inverse">{:count}</span> total, starting on record <span class="badge">{:start}</span>, ending on <span class="badge">{:end}</span>&#39;)</p>\r\n', '<h2>\r\n	By nerds, for nerds.</h2>\r\n<p>\r\n	Built at Twitter by <a href="http://twitter.com/mdo">@mdo</a> and <a href="http://twitter.com/fat">@fat</a>, Bootstrap utilizes <a href="http://lesscss.org">LESS CSS</a>, is compiled via <a href="http://nodejs.org">Node</a>, and is managed through <a href="http://github.com">GitHub</a> to help nerds do awesome stuff on the web.</p>\r\n', NULL, '', NULL, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 'eddieokemwa@gmail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'No', '', 'Yes', 'No', '', '24', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL, '2012-11-16 19:39:34', '2012-11-14 18:55:01'),
(15, 6, NULL, '<p>\r\n	pwana</p>\r\n', '<p>\r\n	toa yeye</p>\r\n', NULL, '92834', '2012-11-22', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 'eddieokemwa@gmail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL, '2012-11-29 18:13:03', '2012-11-28 12:05:30'),
(16, 6, NULL, '', '<p>\r\n	New app. Expected corresponding reviewer recorty.</p>\r\n', NULL, '', NULL, 'cofta', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 'eddieokemwa@gmail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL, '2012-11-29 19:05:59', '2012-11-29 18:45:03'),
(17, 6, NULL, '<p>\r\n	asdfsf</p>\r\n', '<p>\r\n	asdfa</p>\r\n', NULL, 'asdf', NULL, '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 'eddieokemwa@gmail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', NULL, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', 0, 0, 0, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL, '2012-11-30 10:07:07', '2012-11-30 10:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 6),
(2, NULL, 'Group', 2, NULL, 7, 10),
(3, NULL, 'Group', 3, NULL, 11, 26),
(4, NULL, 'Group', 4, NULL, 27, 30),
(5, NULL, 'Group', 5, NULL, 31, 36),
(6, 1, 'User', 1, NULL, 2, 3),
(7, 2, 'User', 2, NULL, 8, 9),
(8, 3, 'User', 3, NULL, 12, 13),
(9, 4, 'User', 4, NULL, 28, 29),
(10, 1, 'User', 5, NULL, 4, 5),
(11, 5, 'User', 6, NULL, 32, 33),
(12, 5, 'User', 7, NULL, 34, 35),
(13, 3, 'User', 8, NULL, 14, 15),
(14, 3, 'User', 9, NULL, 16, 17),
(15, 3, 'User', 10, NULL, 18, 19),
(16, 3, 'User', 11, NULL, 20, 21),
(17, 3, 'User', 12, NULL, 22, 23),
(18, 3, 'User', 13, NULL, 24, 25);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '-1', '-1', '-1', '-1'),
(3, 3, 1, '-1', '-1', '-1', '-1'),
(4, 4, 1, '-1', '-1', '-1', '-1'),
(5, 5, 1, '-1', '-1', '-1', '-1'),
(6, 5, 55, '1', '1', '1', '1'),
(7, 5, 56, '1', '1', '1', '1'),
(8, 5, 96, '1', '1', '1', '1'),
(9, 5, 43, '1', '1', '1', '1'),
(10, 5, 49, '1', '1', '1', '1'),
(11, 5, 87, '1', '1', '1', '1'),
(12, 5, 37, '1', '1', '1', '1'),
(13, 5, 70, '1', '1', '1', '1'),
(14, 5, 78, '1', '1', '1', '1'),
(15, 5, 104, '1', '1', '1', '1'),
(16, 5, 105, '1', '1', '1', '1'),
(17, 5, 106, '1', '1', '1', '1'),
(18, 5, 107, '1', '1', '1', '1'),
(19, 5, 111, '1', '1', '1', '1'),
(20, 5, 115, '1', '1', '1', '1'),
(21, 5, 116, '1', '1', '1', '1'),
(22, 5, 117, '1', '1', '1', '1'),
(23, 2, 118, '1', '1', '1', '1'),
(24, 2, 119, '1', '1', '1', '1'),
(25, 2, 120, '1', '1', '1', '1'),
(26, 2, 124, '1', '1', '1', '1'),
(27, 3, 133, '1', '1', '1', '1'),
(28, 3, 134, '1', '1', '1', '1'),
(29, 3, 135, '1', '1', '1', '1'),
(30, 3, 142, '1', '1', '1', '1'),
(31, 2, 143, '1', '1', '1', '1'),
(32, 3, 144, '1', '1', '1', '1'),
(33, 3, 145, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) NOT NULL,
  `dirname` varchar(255) DEFAULT NULL,
  `basename` varchar(255) NOT NULL,
  `checksum` varchar(255) NOT NULL,
  `alternative` varchar(50) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `model`, `file`, `foreign_key`, `dirname`, `basename`, `checksum`, `alternative`, `group`, `description`, `created`, `modified`) VALUES
(4, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/move.png', 1, 'img', 'move.png', '', NULL, 'protocol', NULL, '2012-11-08 21:28:39', '2012-11-19 16:04:17'),
(5, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/arrow_left.png', 1, 'img', 'arrow_left.png', '', NULL, 'patient_leaflet', NULL, '2012-11-08 21:28:39', '2012-11-19 16:04:17'),
(6, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/under_construction.png', 1, 'img', 'under_construction.png', '', NULL, 'brochure', NULL, '2012-11-08 21:28:39', '2012-11-19 16:04:17'),
(7, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/wheelbarrow.jpg', 1, 'img', 'wheelbarrow.jpg', '', NULL, 'gmp_certificate', NULL, '2012-11-08 21:28:39', '2012-11-19 16:04:17'),
(8, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/doc/mozilla.pdf', 1, 'doc', 'mozilla.pdf', '', NULL, 'declaration', NULL, '2012-11-08 21:58:11', '2012-11-19 16:04:17'),
(9, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/gen/authors', 1, 'gen', 'authors', '', NULL, 'opinion_letter', NULL, '2012-11-08 21:58:11', '2012-11-19 16:04:17'),
(12, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/txt/glossary.txt', 1, 'txt', 'glossary.txt', '', NULL, 'fee', NULL, '2012-11-08 21:58:11', '2012-11-19 16:04:17'),
(13, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/ollogo.png', 1, 'img', 'ollogo.png', '57e3cc0ecb639d34a46fe1abfa157592', NULL, 'cover_letter', NULL, '2012-11-12 14:10:55', '2012-11-19 16:04:17'),
(14, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/gen/license', 1, 'gen', 'license', 'fa8608154dcdd4029ae653131d4b7365', NULL, 'cv', NULL, '2012-11-13 16:55:37', '2012-11-19 16:04:17'),
(15, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/gen/setup.cfg', 1, 'gen', 'setup.cfg', '171cc0c41b2ea97dea7f64dae4f95add', NULL, 'finance', NULL, '2012-11-13 16:55:37', '2012-11-19 16:04:17'),
(16, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/txt/index.txt', 1, 'txt', 'index.txt', 'a7550e6d8c646dea34c8b301722dcfce', NULL, 'indemnity_cover', NULL, '2012-11-13 16:56:25', '2012-11-19 16:04:17'),
(17, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/gen/makefile', 1, 'gen', 'makefile', 'cbad6178405d82f293de389356f78b69', NULL, 'statement', NULL, '2012-11-13 16:56:25', '2012-11-19 16:04:17'),
(24, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/txt/admin_css.txt', 3, 'txt', 'admin_css.txt', '2ac51608cabb77ca01f5c95b6961374f', NULL, 'attachment', 'watta gwan mon', '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(25, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/txt/index_3.txt', 3, 'txt', 'index_3.txt', '95419c0e808d8c393b4740851b742c6b', NULL, 'attachment', 'ting de, ting de', '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(27, NULL, '/home/eddie/ctr/app/webroot/media/transfer/img/formrow.png', 1, 'img', 'formrow.png', 'c7e5b0bd989d923cb93574b853677137', NULL, NULL, 'formrow', '2012-11-14 17:08:28', '2012-11-14 17:08:28'),
(28, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/module.png', 1, 'img', 'module.png', '862ca82a75afa856416ea2a9dd996b30', NULL, 'attachment', 'watt', '2012-11-14 17:21:04', '2012-11-19 16:04:17'),
(29, 'Application', '/home/eddie/ctr/app/webroot/media/transfer/img/objecttools_02.png', 1, 'img', 'objecttools_02.png', '39684713878b51139a123521dcc72964', NULL, 'attachment', 'gwan', '2012-11-14 17:21:04', '2012-11-19 16:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE IF NOT EXISTS `counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`id`, `county_name`, `created`, `modified`) VALUES
(1, 'Mombasa', '2012-05-31 16:15:11', '2012-07-09 13:06:23'),
(2, 'Kwale', '2012-05-31 16:15:21', '2012-05-31 16:15:21'),
(3, 'Kilifi', '2012-05-31 16:15:49', '2012-05-31 16:15:49'),
(4, 'Tana River', '2012-05-31 16:15:57', '2012-05-31 16:15:57'),
(5, 'Lamu', '2012-05-31 16:16:04', '2012-05-31 16:16:04'),
(6, 'Taita Taveta', '2012-05-31 16:16:22', '2012-05-31 16:16:22'),
(7, 'Garissa', '2012-05-31 16:16:29', '2012-05-31 16:16:29'),
(8, 'Wajir', '2012-06-15 10:22:58', '2012-06-15 10:22:58'),
(9, 'Mandera', '2012-06-15 10:23:07', '2012-06-15 10:23:07'),
(10, 'Marsabit', '2012-06-15 10:23:14', '2012-06-15 10:23:14'),
(11, 'Isiolo', '2012-06-15 10:23:21', '2012-06-15 10:23:21'),
(12, 'Meru', '2012-06-15 10:23:27', '2012-06-15 10:23:27'),
(13, 'Tharaka Nithi', '2012-06-15 10:23:35', '2012-06-15 10:23:35'),
(14, 'Embu', '2012-06-15 10:23:42', '2012-06-15 10:23:42'),
(15, 'Kitui', '2012-06-15 10:23:48', '2012-06-15 10:23:48'),
(16, 'Machakos', '2012-06-15 10:23:55', '2012-06-15 10:23:55'),
(17, 'Makueni', '2012-06-15 10:24:02', '2012-06-15 10:24:02'),
(18, 'Nyandarua', '2012-06-15 10:24:09', '2012-06-15 10:24:09'),
(19, 'Nyeri', '2012-06-15 10:24:16', '2012-06-15 10:24:16'),
(20, 'Kirinyaga', '2012-06-15 10:24:22', '2012-06-15 10:24:22'),
(21, 'Murang''a', '2012-06-15 10:24:31', '2012-06-15 10:24:31'),
(22, 'Kiambu', '2012-06-15 10:24:37', '2012-06-15 10:24:37'),
(23, 'Turkana', '2012-06-15 10:24:43', '2012-06-15 10:24:43'),
(24, 'West Pokot', '2012-06-15 10:24:52', '2012-06-15 10:24:52'),
(25, 'Samburu', '2012-06-15 10:24:58', '2012-06-15 10:24:58'),
(26, 'Trans Nzoia', '2012-06-15 10:25:05', '2012-06-15 10:25:05'),
(27, 'Uasin Gishu', '2012-06-15 10:25:15', '2012-06-15 10:25:15'),
(28, 'Elgeyo/Marakwet', '2012-06-15 10:25:27', '2012-06-15 10:25:27'),
(29, 'Nandi', '2012-06-15 10:25:33', '2012-06-15 10:25:33'),
(30, 'Baringo', '2012-06-15 10:25:39', '2012-06-15 10:25:39'),
(31, 'Laikipia', '2012-06-15 10:25:46', '2012-06-15 10:25:46'),
(32, 'Nakuru', '2012-06-15 10:25:52', '2012-06-15 10:25:52'),
(33, 'Narok', '2012-06-15 10:26:02', '2012-06-15 10:26:02'),
(34, 'Kajiado', '2012-06-15 10:26:09', '2012-06-15 10:26:09'),
(35, 'Kericho', '2012-06-15 10:26:16', '2012-06-15 10:26:16'),
(36, 'Bomet', '2012-06-15 10:26:23', '2012-06-15 10:26:23'),
(37, 'Kakamega', '2012-06-15 10:26:29', '2012-06-15 10:26:29'),
(38, 'Vihiga', '2012-06-15 10:26:37', '2012-06-15 10:26:37'),
(39, 'Bung''oma', '2012-06-15 10:26:45', '2012-06-15 10:26:45'),
(40, 'Busia', '2012-06-15 10:26:51', '2012-06-15 10:26:51'),
(41, 'Siaya', '2012-06-15 10:26:56', '2012-06-15 10:26:56'),
(42, 'Kisumu', '2012-06-15 10:27:02', '2012-06-15 10:27:02'),
(43, 'Homa Bay', '2012-06-15 10:27:10', '2012-06-15 10:27:10'),
(44, 'Migori', '2012-06-15 10:27:16', '2012-06-15 10:27:16'),
(45, 'Kisii', '2012-06-15 10:27:25', '2012-06-15 10:27:25'),
(46, 'Nyamira', '2012-06-15 10:27:32', '2012-06-15 10:27:32'),
(47, 'Nairobi City', '2012-06-15 10:27:40', '2012-06-15 10:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(2) CHARACTER SET latin1 DEFAULT '',
  `name` tinytext CHARACTER SET latin1,
  `name_fr` tinytext CHARACTER SET latin1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `name_fr`, `created`, `modified`) VALUES
(1, 'AD', 'Andorra', 'Andorre', NULL, NULL),
(2, 'AE', 'United Arab Emirates', 'Émirats arabes unis', NULL, NULL),
(3, 'AF', 'Afghanistan', 'Afghanistan', NULL, NULL),
(4, 'AG', 'Antigua and Barbuda', 'Antigua-et-Barbuda', NULL, NULL),
(5, 'AI', 'Anguilla', 'Anguilla', NULL, NULL),
(6, 'AL', 'Albania', 'Albanie', NULL, NULL),
(7, 'AM', 'Armenia', 'Arménie', NULL, NULL),
(8, 'AO', 'Angola', 'Angola', NULL, '2012-07-09 14:58:07'),
(9, 'AQ', 'Antarctica', 'Antarctique', NULL, NULL),
(10, 'AR', 'Argentina', 'Argentine', NULL, NULL),
(11, 'AS', 'American Samoa', 'Samoa américaine', NULL, NULL),
(12, 'AT', 'Austria', 'Autriche', NULL, NULL),
(13, 'AU', 'Australia', 'Australie', NULL, NULL),
(14, 'AW', 'Aruba', 'Aruba', NULL, NULL),
(16, 'AZ', 'Azerbaijan', 'Azerbaïdjan', NULL, NULL),
(17, 'BA', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine', NULL, NULL),
(18, 'BB', 'Barbados', 'Barbade', NULL, NULL),
(19, 'BD', 'Bangladesh', 'Bangladesh', NULL, NULL),
(20, 'BE', 'Belgium', 'Belgique', NULL, NULL),
(21, 'BF', 'Burkina Faso', 'Burkina Faso', NULL, NULL),
(22, 'BG', 'Bulgaria', 'Bulgarie', NULL, NULL),
(23, 'BH', 'Bahrain', 'Bahreïn', NULL, NULL),
(24, 'BI', 'Burundi', 'Burundi', NULL, NULL),
(25, 'BJ', 'Benin', 'Bénin', NULL, NULL),
(26, 'BL', 'Saint Barthélemy', 'Saint-Barthélemy', NULL, NULL),
(27, 'BM', 'Bermuda', 'Bermudes', NULL, NULL),
(28, 'BN', 'Brunei Darussalam', 'Brunei Darussalam', NULL, NULL),
(29, 'BO', 'Bolivia', 'Bolivie', NULL, NULL),
(30, 'BQ', 'Caribbean Netherlands ', 'Pays-Bas caribéens', NULL, NULL),
(31, 'BR', 'Brazil', 'Brésil', NULL, NULL),
(32, 'BS', 'Bahamas', 'Bahamas', NULL, NULL),
(33, 'BT', 'Bhutan', 'Bhoutan', NULL, NULL),
(34, 'BV', 'Bouvet Island', 'Île Bouvet', NULL, NULL),
(35, 'BW', 'Botswana', 'Botswana', NULL, NULL),
(36, 'BY', 'Belarus', 'Bélarus', NULL, NULL),
(37, 'BZ', 'Belize', 'Belize', NULL, NULL),
(38, 'CA', 'Canada', 'Canada', NULL, NULL),
(39, 'CC', 'Cocos (Keeling) Islands', 'Îles Cocos (Keeling)', NULL, NULL),
(40, 'CD', 'Congo, Democratic Republic of', 'Congo, République démocratique du', NULL, NULL),
(41, 'CF', 'Central African Republic', 'République centrafricaine', NULL, NULL),
(42, 'CG', 'Congo', 'Congo', NULL, NULL),
(43, 'CH', 'Switzerland', 'Suisse', NULL, NULL),
(44, 'CI', 'Côte D’Ivoire', 'Côte d’Ivoire', NULL, NULL),
(45, 'CK', 'Cook Islands', 'Îles Cook', NULL, NULL),
(46, 'CL', 'Chile', 'Chili', NULL, NULL),
(47, 'CM', 'Cameroon', 'Cameroun', NULL, NULL),
(48, 'CN', 'China', 'Chine', NULL, NULL),
(49, 'CO', 'Colombia', 'Colombie', NULL, NULL),
(50, 'CR', 'Costa Rica', 'Costa Rica', NULL, NULL),
(51, 'CU', 'Cuba', 'Cuba', NULL, NULL),
(52, 'CV', 'Cape Verde', 'Cap-Vert', NULL, NULL),
(53, 'CW', 'Curaçao', 'Curaçao', NULL, NULL),
(54, 'CX', 'Christmas Island', 'Île Christmas', NULL, NULL),
(55, 'CY', 'Cyprus', 'Chypre', NULL, NULL),
(56, 'CZ', 'Czech Republic', 'République tchèque', NULL, NULL),
(57, 'DE', 'Germany', 'Allemagne', NULL, NULL),
(58, 'DJ', 'Djibouti', 'Djibouti', NULL, NULL),
(59, 'DK', 'Denmark', 'Danemark', NULL, NULL),
(60, 'DM', 'Dominica', 'Dominique', NULL, NULL),
(61, 'DO', 'Dominican Republic', 'République dominicaine', NULL, NULL),
(62, 'DZ', 'Algeria', 'Algérie', NULL, NULL),
(63, 'EC', 'Ecuador', 'Équateur', NULL, NULL),
(64, 'EE', 'Estonia', 'Estonie', NULL, NULL),
(65, 'EG', 'Egypt', 'Égypte', NULL, NULL),
(66, 'EH', 'Western Sahara', 'Sahara Occidental', NULL, NULL),
(67, 'ER', 'Eritrea', 'Érythrée', NULL, NULL),
(68, 'ES', 'Spain', 'Espagne', NULL, NULL),
(69, 'ET', 'Ethiopia', 'Éthiopie', NULL, NULL),
(70, 'FI', 'Finland', 'Finlande', NULL, NULL),
(71, 'FJ', 'Fiji', 'Fidji', NULL, NULL),
(72, 'FK', 'Falkland Islands', 'Îles Malouines', NULL, NULL),
(73, 'FM', 'Micronesia, Federated States of', 'Micronésie, États fédérés de', NULL, NULL),
(74, 'FO', 'Faroe Islands', 'Îles Féroé', NULL, NULL),
(75, 'FR', 'France', 'France', NULL, NULL),
(76, 'GA', 'Gabon', 'Gabon', NULL, NULL),
(77, 'GB', 'United Kingdom', 'Royaume-Uni', NULL, NULL),
(78, 'GD', 'Grenada', 'Grenade', NULL, NULL),
(79, 'GE', 'Georgia', 'Géorgie', NULL, NULL),
(80, 'GF', 'French Guiana', 'Guyane française', NULL, NULL),
(81, 'GG', 'Guernsey', 'Guernesey', NULL, NULL),
(82, 'GH', 'Ghana', 'Ghana', NULL, NULL),
(83, 'GI', 'Gibraltar', 'Gibraltar', NULL, NULL),
(84, 'GL', 'Greenland', 'Groenland', NULL, NULL),
(85, 'GM', 'Gambia', 'Gambie', NULL, NULL),
(86, 'GN', 'Guinea', 'Guinée', NULL, NULL),
(87, 'GP', 'Guadeloupe', 'Guadeloupe', NULL, NULL),
(88, 'GQ', 'Equatorial Guinea', 'Guinée équatoriale', NULL, NULL),
(89, 'GR', 'Greece', 'Grèce', NULL, NULL),
(90, 'GS', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les îles Sandwich du Sud', NULL, NULL),
(91, 'GT', 'Guatemala', 'Guatemala', NULL, NULL),
(92, 'GU', 'Guam', 'Guam', NULL, NULL),
(93, 'GW', 'Guinea-Bissau', 'Guinée-Bissau', NULL, NULL),
(94, 'GY', 'Guyana', 'Guyana', NULL, NULL),
(95, 'HK', 'Hong Kong', 'Hong Kong', NULL, NULL),
(96, 'HM', 'Heard and McDonald Islands', 'Îles Heard et McDonald', NULL, NULL),
(97, 'HN', 'Honduras', 'Honduras', NULL, NULL),
(98, 'HR', 'Croatia', 'Croatie', NULL, NULL),
(99, 'HT', 'Haiti', 'Haïti', NULL, NULL),
(100, 'HU', 'Hungary', 'Hongrie', NULL, NULL),
(101, 'ID', 'Indonesia', 'Indonésie', NULL, NULL),
(102, 'IE', 'Ireland', 'Irlande', NULL, NULL),
(103, 'IL', 'Israel', 'Israël', NULL, NULL),
(104, 'IM', 'Isle of Man', 'Île de Man', NULL, NULL),
(105, 'IN', 'India', 'Inde', NULL, NULL),
(106, 'IO', 'British Indian Ocean Territory', 'Territoire britannique de l''océan Indien', NULL, NULL),
(107, 'IQ', 'Iraq', 'Irak', NULL, NULL),
(108, 'IR', 'Iran', 'Iran', NULL, NULL),
(109, 'IS', 'Iceland', 'Islande', NULL, NULL),
(110, 'IT', 'Italy', 'Italie', NULL, NULL),
(111, 'JE', 'Jersey', 'Jersey', NULL, NULL),
(112, 'JM', 'Jamaica', 'Jamaïque', NULL, NULL),
(113, 'JO', 'Jordan', 'Jordanie', NULL, NULL),
(114, 'JP', 'Japan', 'Japon', NULL, NULL),
(115, 'KE', 'Kenya', 'Kenya', NULL, NULL),
(116, 'KG', 'Kyrgyzstan', 'Kirghizistan', NULL, NULL),
(117, 'KH', 'Cambodia', 'Cambodge', NULL, NULL),
(118, 'KI', 'Kiribati', 'Kiribati', NULL, NULL),
(119, 'KM', 'Comoros', 'Comores', NULL, NULL),
(120, 'KN', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis', NULL, NULL),
(121, 'KP', 'North Korea', 'Corée du Nord', NULL, NULL),
(122, 'KR', 'South Korea', 'Corée du Sud', NULL, NULL),
(123, 'KW', 'Kuwait', 'Koweït', NULL, NULL),
(124, 'KY', 'Cayman Islands', 'Îles Caïmans', NULL, NULL),
(125, 'KZ', 'Kazakhstan', 'Kazakhstan', NULL, NULL),
(126, 'LA', 'Lao People’s Democratic Republic', 'Laos', NULL, NULL),
(127, 'LB', 'Lebanon', 'Liban', NULL, NULL),
(128, 'LC', 'Saint Lucia', 'Sainte-Lucie', NULL, NULL),
(129, 'LI', 'Liechtenstein', 'Liechtenstein', NULL, NULL),
(130, 'LK', 'Sri Lanka', 'Sri Lanka', NULL, NULL),
(131, 'LR', 'Liberia', 'Libéria', NULL, NULL),
(132, 'LS', 'Lesotho', 'Lesotho', NULL, NULL),
(133, 'LT', 'Lithuania', 'Lituanie', NULL, NULL),
(134, 'LU', 'Luxembourg', 'Luxembourg', NULL, NULL),
(135, 'LV', 'Latvia', 'Lettonie', NULL, NULL),
(136, 'LY', 'Libya', 'Libye', NULL, NULL),
(137, 'MA', 'Morocco', 'Maroc', NULL, NULL),
(138, 'MC', 'Monaco', 'Monaco', NULL, NULL),
(139, 'MD', 'Moldova', 'Moldavie', NULL, NULL),
(140, 'ME', 'Montenegro', 'Monténégro', NULL, NULL),
(141, 'MF', 'Saint-Martin (France)', 'Saint-Martin (France)', NULL, NULL),
(142, 'MG', 'Madagascar', 'Madagascar', NULL, NULL),
(143, 'MH', 'Marshall Islands', 'Îles Marshall', NULL, NULL),
(144, 'MK', 'Macedonia', 'Macédoine', NULL, NULL),
(145, 'ML', 'Mali', 'Mali', NULL, NULL),
(146, 'MM', 'Myanmar', 'Myanmar', NULL, NULL),
(147, 'MN', 'Mongolia', 'Mongolie', NULL, NULL),
(148, 'MO', 'Macau', 'Macao', NULL, NULL),
(149, 'MP', 'Northern Mariana Islands', 'Mariannes du Nord', NULL, '2012-07-09 14:14:26'),
(150, 'MQ', 'Martinique', 'Martinique', NULL, NULL),
(151, 'MR', 'Mauritania', 'Mauritanie', NULL, NULL),
(152, 'MS', 'Montserrat', 'Montserrat', NULL, NULL),
(153, 'MT', 'Malta', 'Malte', NULL, NULL),
(154, 'MU', 'Mauritius', 'Maurice', NULL, NULL),
(155, 'MV', 'Maldives', 'Maldives', NULL, NULL),
(156, 'MW', 'Malawi', 'Malawi', NULL, NULL),
(157, 'MX', 'Mexico', 'Mexique', NULL, NULL),
(158, 'MY', 'Malaysia', 'Malaisie', NULL, NULL),
(159, 'MZ', 'Mozambique', 'Mozambique', NULL, NULL),
(160, 'NA', 'Namibia', 'Namibie', NULL, NULL),
(161, 'NC', 'New Caledonia', 'Nouvelle-Calédonie', NULL, NULL),
(162, 'NE', 'Niger', 'Niger', NULL, NULL),
(163, 'NF', 'Norfolk Island', 'Île Norfolk', NULL, NULL),
(164, 'NG', 'Nigeria', 'Nigeria', NULL, NULL),
(165, 'NI', 'Nicaragua', 'Nicaragua', NULL, NULL),
(166, 'NL', 'The Netherlands', 'Pays-Bas', NULL, NULL),
(167, 'NO', 'Norway', 'Norvège', NULL, NULL),
(168, 'NP', 'Nepal', 'Népal', NULL, NULL),
(169, 'NR', 'Nauru', 'Nauru', NULL, NULL),
(170, 'NU', 'Niue', 'Niue', NULL, NULL),
(171, 'NZ', 'New Zealand', 'Nouvelle-Zélande', NULL, NULL),
(172, 'OM', 'Oman', 'Oman', NULL, NULL),
(173, 'PA', 'Panama', 'Panama', NULL, NULL),
(174, 'PE', 'Peru', 'Pérou', NULL, NULL),
(175, 'PF', 'French Polynesia', 'Polynésie française', NULL, NULL),
(176, 'PG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée', NULL, NULL),
(177, 'PH', 'Philippines', 'Philippines', NULL, NULL),
(178, 'PK', 'Pakistan', 'Pakistan', NULL, NULL),
(179, 'PL', 'Poland', 'Pologne', NULL, NULL),
(180, 'PM', 'St. Pierre and Miquelon', 'Saint-Pierre-et-Miquelon', NULL, NULL),
(181, 'PN', 'Pitcairn', 'Pitcairn', NULL, NULL),
(182, 'PR', 'Puerto Rico', 'Puerto Rico', NULL, NULL),
(183, 'PS', 'Palestinian Territory, Occupied', 'Territoires palestiniens', NULL, NULL),
(184, 'PT', 'Portugal', 'Portugal', NULL, NULL),
(185, 'PW', 'Palau', 'Palau', NULL, NULL),
(186, 'PY', 'Paraguay', 'Paraguay', NULL, NULL),
(187, 'QA', 'Qatar', 'Qatar', NULL, NULL),
(188, 'RE', 'Reunion', 'Réunion', NULL, NULL),
(189, 'RO', 'Romania', 'Roumanie', NULL, NULL),
(190, 'RS', 'Serbia', 'Serbie', NULL, NULL),
(191, 'RU', 'Russian Federation', 'Russie', NULL, NULL),
(192, 'RW', 'Rwanda', 'Rwanda', NULL, NULL),
(193, 'SA', 'Saudi Arabia', 'Arabie saoudite', NULL, NULL),
(194, 'SB', 'Solomon Islands', 'Îles Salomon', NULL, NULL),
(195, 'SC', 'Seychelles', 'Seychelles', NULL, NULL),
(196, 'SD', 'Sudan', 'Soudan', NULL, NULL),
(197, 'SE', 'Sweden', 'Suède', NULL, NULL),
(198, 'SG', 'Singapore', 'Singapour', NULL, NULL),
(199, 'SH', 'Saint Helena', 'Sainte-Hélène', NULL, NULL),
(200, 'SI', 'Slovenia', 'Slovénie', NULL, NULL),
(201, 'SJ', 'Svalbard and Jan Mayen Islands', 'Svalbard et île de Jan Mayen', NULL, NULL),
(202, 'SK', 'Slovakia (Slovak Republic)', 'Slovaquie (République slovaque)', NULL, NULL),
(203, 'SL', 'Sierra Leone', 'Sierra Leone', NULL, NULL),
(204, 'SM', 'San Marino', 'Saint-Marin', NULL, NULL),
(205, 'SN', 'Senegal', 'Sénégal', NULL, NULL),
(206, 'SO', 'Somalia', 'Somalie', NULL, NULL),
(207, 'SR', 'Suriname', 'Suriname', NULL, NULL),
(208, 'SS', 'South Sudan', 'Soudan du Sud', NULL, NULL),
(209, 'ST', 'Sao Tome and Principe', 'Sao Tomé-et-Principe', NULL, NULL),
(210, 'SV', 'El Salvador', 'El Salvador', NULL, NULL),
(211, 'SX', 'Saint-Martin (Pays-Bas)', 'Sint Maarten ', NULL, NULL),
(212, 'SY', 'Syria', 'Syrie', NULL, NULL),
(213, 'SZ', 'Swaziland', 'Swaziland', NULL, NULL),
(214, 'TC', 'Turks and Caicos Islands', 'Îles Turks et Caicos', NULL, NULL),
(215, 'TD', 'Chad', 'Tchad', NULL, NULL),
(216, 'TF', 'French Southern Territories', 'Terres australes françaises', NULL, NULL),
(217, 'TG', 'Togo', 'Togo', NULL, NULL),
(218, 'TH', 'Thailand', 'Thaïlande', NULL, NULL),
(219, 'TJ', 'Tajikistan', 'Tadjikistan', NULL, NULL),
(220, 'TK', 'Tokelau', 'Tokelau', NULL, NULL),
(221, 'TL', 'Timor-Leste', 'Timor-Leste', NULL, NULL),
(222, 'TM', 'Turkmenistan', 'Turkménistan', NULL, NULL),
(223, 'TN', 'Tunisia', 'Tunisie', NULL, NULL),
(224, 'TO', 'Tonga', 'Tonga', NULL, NULL),
(225, 'TR', 'Turkey', 'Turquie', NULL, NULL),
(226, 'TT', 'Trinidad and Tobago', 'Trinité-et-Tobago', NULL, NULL),
(227, 'TV', 'Tuvalu', 'Tuvalu', NULL, NULL),
(228, 'TW', 'Taiwan', 'Taïwan', NULL, NULL),
(229, 'TZ', 'Tanzania', 'Tanzanie', NULL, NULL),
(230, 'UA', 'Ukraine', 'Ukraine', NULL, NULL),
(231, 'UG', 'Uganda', 'Ouganda', NULL, NULL),
(232, 'UM', 'United States Minor Outlying Islands', 'Îles mineures éloignées des États-Unis', NULL, NULL),
(233, 'US', 'United States', 'États-Unis', NULL, NULL),
(234, 'UY', 'Uruguay', 'Uruguay', NULL, NULL),
(235, 'UZ', 'Uzbekistan', 'Ouzbékistan', NULL, NULL),
(236, 'VA', 'Vatican', 'Vatican', NULL, NULL),
(237, 'VC', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les-Grenadines', NULL, NULL),
(238, 'VE', 'Venezuela', 'Venezuela', NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', 'Îles Vierges britanniques', NULL, NULL),
(240, 'VI', 'Virgin Islands (U.S.)', 'Îles Vierges américaines', NULL, NULL),
(241, 'VN', 'Vietnam', 'Vietnam', NULL, NULL),
(242, 'VU', 'Vanuatu', 'Vanuatu', NULL, NULL),
(243, 'WF', 'Wallis and Futuna Islands', 'Îles Wallis-et-Futuna', NULL, NULL),
(244, 'WS', 'Samoa', 'Samoa', NULL, NULL),
(245, 'YE', 'Yemen', 'Yémen', NULL, NULL),
(246, 'YT', 'Mayotte', 'Mayotte', NULL, NULL),
(247, 'ZA', 'South Africa', 'Afrique du Sud', NULL, NULL),
(248, 'ZM', 'Zambia', 'Zambie', NULL, NULL),
(249, 'ZW', 'Zimbabwe', 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'PPB Admins', '2012-10-05 20:01:19', '2012-10-05 20:02:54'),
(2, 'PPB Managers', '2012-10-05 20:01:36', '2012-10-05 20:02:58'),
(3, 'ECCT Reviewers', '2012-10-05 20:02:09', '2012-10-05 20:02:09'),
(4, 'Partners', '2012-10-05 20:02:23', '2012-10-05 20:02:23'),
(5, 'Principal Investigators', '2012-10-05 20:02:39', '2012-10-05 20:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `investigator_contacts`
--

CREATE TABLE IF NOT EXISTS `investigator_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `given_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `family_name` varchar(100) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `professional_address` varchar(255) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `investigator_contacts`
--

INSERT INTO `investigator_contacts` (`id`, `application_id`, `given_name`, `middle_name`, `family_name`, `qualification`, `professional_address`, `telephone`, `created`, `modified`) VALUES
(1, 1, 'a', 'b', 'c', 'd', 'e', NULL, '2012-11-08 12:57:00', '2012-11-19 16:04:17'),
(2, 1, 'f', 'g', 'h', 'i', 'j', NULL, '2012-11-08 16:32:45', '2012-11-19 16:04:17'),
(3, 2, '', '', '', '', '', NULL, '2012-11-14 11:16:40', '2012-11-14 11:16:40'),
(4, 3, '', '', '', '', '', NULL, '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(5, 4, '', '', '', '', '', NULL, '2012-11-14 19:14:21', '2012-11-16 19:39:34'),
(6, 15, '', '', '', '', '', NULL, '2012-11-28 12:05:54', '2012-11-29 18:13:03'),
(7, 16, '', '', '', '', '', NULL, '2012-11-29 18:45:25', '2012-11-29 19:05:59'),
(8, 17, '', '', '', '', '', NULL, '2012-11-30 10:07:07', '2012-11-30 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` char(30) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `system_message` text,
  `user_message` text,
  `expired` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `model`, `foreign_key`, `title`, `url`, `system_message`, `user_message`, `expired`, `created`, `modified`) VALUES
(1, 8, 'request', 'Application', 1, 'Protocol Review.', '', 'PPB is requesting you to declare if there is a conflict of interest.', 'xxx', 1, '2012-12-01 14:49:32', '2012-12-01 15:50:11'),
(2, 10, 'request', 'Application', 1, 'Protocol Review.', '', 'PPB is requesting you to declare if there is a conflict of interest.', 'xxx', 0, '2012-12-01 14:49:32', '2012-12-01 14:49:32'),
(3, 12, 'request', 'Application', 1, 'Protocol Review.', '', 'PPB is requesting you to declare if there is a conflict of interest.', 'xxx', 0, '2012-12-01 14:49:32', '2012-12-01 14:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone_number` varchar(255) DEFAULT NULL,
  `all_tasks` char(30) DEFAULT NULL,
  `monitoring` char(30) DEFAULT NULL,
  `regulatory` char(30) DEFAULT NULL,
  `investigator_recruitment` char(30) DEFAULT NULL,
  `ivrs_treatment_randomisation` char(30) DEFAULT NULL,
  `data_management` char(30) DEFAULT NULL,
  `e_data_capture` char(30) DEFAULT NULL,
  `susar_reporting` char(30) DEFAULT NULL,
  `quality_assurance_auditing` char(30) DEFAULT NULL,
  `statistical_analysis` char(30) DEFAULT NULL,
  `medical_writing` char(30) DEFAULT NULL,
  `other_duties` char(30) DEFAULT NULL,
  `other_duties_specify` text,
  `misc` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `application_id`, `organization`, `contact_person`, `address`, `telephone_number`, `all_tasks`, `monitoring`, `regulatory`, `investigator_recruitment`, `ivrs_treatment_randomisation`, `data_management`, `e_data_capture`, `susar_reporting`, `quality_assurance_auditing`, `statistical_analysis`, `medical_writing`, `other_duties`, `other_duties_specify`, `misc`, `created`, `modified`) VALUES
(1, 1, 'a', 'b', 'c', 'd', 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'please specify', NULL, '2012-11-08 12:57:00', '2012-11-19 16:04:17'),
(2, 1, 'z', 'y', 'x', 'w', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'this is it', NULL, '2012-11-08 18:49:53', '2012-11-19 16:04:17'),
(3, 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2012-11-14 11:16:40', '2012-11-14 11:16:40'),
(4, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(5, 4, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2012-11-14 19:14:21', '2012-11-16 19:39:34'),
(6, 15, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2012-11-28 12:05:54', '2012-11-29 18:13:03'),
(7, 16, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2012-11-29 18:45:25', '2012-11-29 19:05:59'),
(8, 17, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '2012-11-30 10:07:07', '2012-11-30 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `placebos`
--

CREATE TABLE IF NOT EXISTS `placebos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `placebo_present` varchar(30) DEFAULT NULL,
  `pharmaceutical_form` varchar(255) DEFAULT NULL,
  `route_of_administration` varchar(255) DEFAULT NULL,
  `composition` varchar(255) DEFAULT NULL,
  `identical_indp` varchar(30) DEFAULT NULL,
  `major_ingredients` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `placebos`
--

INSERT INTO `placebos` (`id`, `application_id`, `placebo_present`, `pharmaceutical_form`, `route_of_administration`, `composition`, `identical_indp`, `major_ingredients`, `created`, `modified`) VALUES
(1, 1, NULL, 'a', 'b', 'c', 'No', 'd', '2012-11-08 12:57:00', '2012-11-19 16:04:17'),
(2, 1, NULL, 'e', 'f', 'g', 'No', 'h', '2012-11-08 21:09:22', '2012-11-19 16:04:17'),
(3, 2, NULL, '', '', '', '', '', '2012-11-14 11:16:40', '2012-11-14 11:16:40'),
(4, 3, NULL, '', '', '', '', '', '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(5, 4, NULL, '', '', '', '', '', '2012-11-14 19:14:21', '2012-11-16 19:39:34'),
(6, 15, NULL, '', '', '', '', '', '2012-11-28 12:05:54', '2012-11-29 18:13:03'),
(7, 16, NULL, '', '', '', '', '', '2012-11-29 18:45:25', '2012-11-29 19:05:59'),
(8, 17, NULL, '', '', '', '', '', '2012-11-30 10:07:07', '2012-11-30 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `previous_dates`
--

CREATE TABLE IF NOT EXISTS `previous_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `date_of_previous_protocol` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `previous_dates`
--

INSERT INTO `previous_dates` (`id`, `application_id`, `date_of_previous_protocol`, `created`, `modified`) VALUES
(1, 1, '2012-11-07', '2012-11-08 12:57:00', '2012-11-19 16:04:17'),
(2, 1, NULL, '2012-11-08 16:27:17', '2012-11-19 16:04:17'),
(3, 1, '2003-11-05', '2012-11-08 16:06:14', '2012-11-19 16:04:17'),
(4, 2, NULL, '2012-11-14 11:16:40', '2012-11-14 11:16:40'),
(5, 3, NULL, '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(6, 4, NULL, '2012-11-14 19:14:21', '2012-11-16 19:39:34'),
(7, 15, NULL, '2012-11-28 12:05:54', '2012-11-29 18:13:03'),
(8, 16, NULL, '2012-11-29 18:45:25', '2012-11-29 19:05:59'),
(9, 17, NULL, '2012-11-30 10:07:07', '2012-11-30 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `reviewers`
--

CREATE TABLE IF NOT EXISTS `reviewers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `description` text,
  `notified` tinyint(1) DEFAULT '0',
  `accepted` char(30) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `type` char(30) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `recommendation` text,
  `notified` tinyint(2) DEFAULT '0',
  `accepted` char(30) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `application_id`, `type`, `title`, `text`, `recommendation`, `notified`, `accepted`, `created`, `modified`) VALUES
(1, 8, 1, 'request', 'PPB request', 'xxx', NULL, 1, NULL, '2012-11-30 14:41:55', '2012-11-30 14:41:55'),
(2, 10, 1, 'request', 'PPB request', 'xxx', NULL, 1, NULL, '2012-11-30 14:41:55', '2012-11-30 14:41:55'),
(3, 12, 1, 'request', 'PPB request', 'xxx', NULL, 1, NULL, '2012-11-30 14:41:55', '2012-11-30 14:41:55'),
(8, 10, 1, 'response', 'accepted', 'dss', NULL, 0, '', '2012-11-30 16:09:45', '2012-11-30 16:09:45'),
(9, 10, 1, 'reviewer_comment', NULL, 'modo', 'wa nyumba', 0, NULL, '2012-11-30 17:05:31', '2012-11-30 17:05:31'),
(10, 10, 1, 'reviewer_comment', NULL, 'a second commento', 'I hereby comment', 0, NULL, '2012-12-01 14:22:02', '2012-12-01 14:22:02'),
(12, 8, 1, 'response', 'accepted', 'nimikubali', NULL, 0, '', '2012-12-01 15:50:11', '2012-12-01 15:50:11'),
(13, 8, 1, 'reviewer_comment', NULL, 'gilbert commento', 'my first commentoo', 0, NULL, '2012-12-01 15:59:44', '2012-12-01 15:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `site_details`
--

CREATE TABLE IF NOT EXISTS `site_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `physical_address` varchar(255) DEFAULT NULL,
  `contact_details` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `site_capacity` varchar(30) DEFAULT NULL,
  `misc` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `site_details`
--

INSERT INTO `site_details` (`id`, `application_id`, `county_id`, `site_name`, `physical_address`, `contact_details`, `contact_person`, `site_capacity`, `misc`, `created`, `modified`) VALUES
(1, 1, NULL, '', '', '', '', NULL, NULL, '2012-11-08 12:57:00', '2012-11-19 16:04:17'),
(2, 1, NULL, '', '', '', '', NULL, NULL, '2012-11-08 18:24:59', '2012-11-19 16:04:17'),
(3, 2, NULL, '', '', '', '', NULL, NULL, '2012-11-14 11:16:40', '2012-11-14 11:16:40'),
(4, 3, NULL, '', '', '', '', NULL, NULL, '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(5, 4, NULL, '', '', '', '', NULL, NULL, '2012-11-14 19:14:21', '2012-11-16 19:39:34'),
(6, 15, NULL, '', '', '', '', NULL, NULL, '2012-11-28 12:05:54', '2012-11-29 18:13:03'),
(7, 16, NULL, '', '', '', '', NULL, NULL, '2012-11-29 18:45:25', '2012-11-29 19:05:59'),
(8, 17, NULL, '', '', '', '', NULL, NULL, '2012-11-30 10:07:07', '2012-11-30 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) DEFAULT NULL,
  `sponsor` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone_number` varchar(255) DEFAULT NULL,
  `fax_number` varchar(255) DEFAULT NULL,
  `cell_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `application_id`, `sponsor`, `contact_person`, `address`, `telephone_number`, `fax_number`, `cell_number`, `email_address`, `created`, `modified`) VALUES
(1, 1, 'a', 'b', 'c', 'd', 'e', 'f', 'edward.okemwa@intellisoftkenya.com', '2012-11-08 12:57:00', '2012-11-19 16:04:17'),
(2, 1, 'g', 'h', 'i', 'j', 'k', 'l', 'eddieokemwa@gmail.com', '2012-11-08 16:48:44', '2012-11-19 16:04:17'),
(3, 2, '', '', '', '', '', '', '', '2012-11-14 11:16:40', '2012-11-14 11:16:40'),
(4, 3, '', '', '', '', '', '', '', '2012-11-14 17:05:01', '2012-11-14 17:07:25'),
(5, 4, '', '', '', '', '', '', '', '2012-11-14 19:14:21', '2012-11-16 19:39:34'),
(6, 15, '', '', '', '', '', '', '', '2012-11-28 12:05:54', '2012-11-29 18:13:03'),
(7, 16, '', '', '', '', '', '', '', '2012-11-29 18:45:25', '2012-11-29 19:05:59'),
(8, 17, '', '', '', '', '', '', '', '2012-11-30 10:07:07', '2012-11-30 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `trial_statuses`
--

CREATE TABLE IF NOT EXISTS `trial_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `trial_statuses`
--

INSERT INTO `trial_statuses` (`id`, `value`, `name`, `created`, `modified`) VALUES
(1, 'recruiting', 'recruiting', '2012-10-19 16:07:50', '2012-10-19 16:07:50'),
(2, 'not yet recruiting', 'not yet recruiting', '2012-10-19 16:08:11', '2012-10-19 16:08:11'),
(3, 'suspended', 'suspended', '2012-10-19 16:08:38', '2012-10-19 16:08:38'),
(4, 'stopped', 'stopped', '2012-10-19 16:08:51', '2012-10-19 16:08:51'),
(5, 'completed', 'completed', '2012-10-19 16:09:04', '2012-10-19 16:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` char(40) DEFAULT NULL,
  `name_of_institution` varchar(255) DEFAULT NULL,
  `institution_physical` varchar(255) DEFAULT NULL,
  `institution_address` varchar(255) DEFAULT NULL,
  `institution_contact` varchar(255) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `confirm_password`, `name`, `email`, `phone_no`, `name_of_institution`, `institution_physical`, `institution_address`, `institution_contact`, `county_id`, `country_id`, `group_id`, `is_admin`, `created`, `modified`) VALUES
(1, 'admin', '371151bc2bbb590b04bea744fba7f74d366ccd3c', NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2012-10-05 20:03:17', '2012-10-05 20:03:17'),
(2, 'manager', 'fb2684ae01eee6760a5b8ef3328ba7596c9e3a84', NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, '2012-10-05 20:03:27', '2012-10-05 20:03:27'),
(3, 'reviewer', '2a305ae5a2867e3dc78f8b30f3f1e3f857deda2e', NULL, 'reviewer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, '2012-10-05 20:03:56', '2012-10-05 20:03:56'),
(4, 'partner', 'ca19ef9a100d2d43e436e21b4fa13026b4959fd6', NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, '2012-10-05 20:04:11', '2012-10-05 20:04:11'),
(5, 'investigator', 'fe00e126a2471c20d3b4dac642364ab81cfe35cb', NULL, 'investigator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2012-10-05 20:04:30', '2012-10-05 20:04:30'),
(6, 'roberto', '4fcf56b5d5d770946d510587f9220bca2f5311e1', '4fcf56b5d5d770946d510587f9220bca2f5311e1', 'Roberto di matteo', 'eddieokemwa@gmail.com', '0732302934', '', '', '', '', 47, NULL, 5, 0, '2012-10-18 14:07:07', '2012-10-18 14:07:07'),
(7, 'claudio', 'af9742afc9073bf8b94549aee2f5217d02d66b8c', 'fc319d1f53fd10f53b37b960b923dc5b900f1dce', 'sidi benks', 'sidibenks@jd.com', '+2548 54552', '', '', '', '', 28, 115, 5, 0, '2012-10-24 17:56:12', '2012-10-24 17:56:12'),
(8, 'gilbert', 'fa67ab04ff93bbcf8378dee993e692bfdbaabbbd', 'fa67ab04ff93bbcf8378dee993e692bfdbaabbbd', 'Prof. Gilbert Kokwaro', 'gilbert@kokwaro.com', '', '', '', '', '', NULL, NULL, 3, 0, '2012-11-26 18:18:53', '2012-11-26 18:18:53'),
(9, 'walter', 'df2aea25af5ed496c33beb8a6f7d3d8a592cc3ed', 'df2aea25af5ed496c33beb8a6f7d3d8a592cc3ed', 'Prof. Walter Jaoko', 'walter@jaoko.com', '', '', '', '', '', NULL, NULL, 3, 0, '2012-11-26 18:22:04', '2012-11-26 18:22:04'),
(10, 'monique', '45b0b6f60c04df63c06262ac66894802e503a4bb', '45b0b6f60c04df63c06262ac66894802e503a4bb', 'Dr. Monique Wasunna', 'monique@wasunna.com', '', '', '', '', '', NULL, NULL, 3, 0, '2012-11-26 18:22:59', '2012-11-26 18:22:59'),
(11, 'rashid', 'f0bd7fc87b8fe4b23b4b5f993338efdc05c00b53', 'f0bd7fc87b8fe4b23b4b5f993338efdc05c00b53', 'Dr. Rashid Amon', 'rashid@amon.com', '', '', '', '', '', NULL, NULL, 3, 0, '2012-11-26 18:24:00', '2012-11-26 18:24:00'),
(12, 'george', 'a86c4a98655d53570a1a349f2af5fc9e100d975f', 'a86c4a98655d53570a1a349f2af5fc9e100d975f', 'Dr. George Osanjo', 'george@osanjo.com', '', '', '', '', '', NULL, NULL, 3, 0, '2012-11-26 18:24:47', '2012-11-26 18:24:47'),
(13, 'bernhards', '77536e1ffe56bd8878e3f407353ac22fe0f37030', '77536e1ffe56bd8878e3f407353ac22fe0f37030', 'Dr. Bernhards Ogutu', 'bernhards@ogutu.com', '', '', '', '', '', NULL, NULL, 3, 0, '2012-11-26 18:27:21', '2012-11-26 18:27:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
