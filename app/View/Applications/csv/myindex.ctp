<?php

// app/Views/Subscribers/export.ctp
$header = array('Protocol No', 'Study Title', 'Short Title', //'Date Submitted', 'Approval Date',
            // 'Assigned Reviewer 1', 'Reviewer response 1', 'Assigned Reviewer 2', 'Reviewer response 2', 'Assigned Reviewer 3', 'Reviewer response 3', 'Assigned Reviewer 4', 'Reviewer response 4',
            // 'Trial Status', 'Trial Phase I', 'Trial Phase II', 'Trial Phase III', 'Trial Phase IV', 
            // 'Study Site', 'Approved Participants',
            // 'Scope: Diagnosis', 'Scope: Prophylaxis', 'Scope: Therapy', 'Scope: Safety', 'Scope: Efficacy', 'Scope: Pharmacokinetic', 'Scope: Pharmacodynamic', 'Scope: Bioequivalence', 'Scope: Dose Response', 'Scope: Pharmacogenetic', 'Scope: Pharmacogenomic', 'Scope: Pharmacoecomomic', 'Scope: Others', 'Scope: Others Specify', 
            // 'Version No', 'Date of Protocol', 'Study Drug', 'Disease Condition',
            // 'Approval Date of Protocol', 'Biologicals', 'Proteins', 'Immunologicals', 'Vaccines', 'Hormones', 'Toxoid', 'Chemical', 'Chemical Name', 'Medical Device', 'Medical Device Name', 'Co-ordinating Investigator Name', 'Co-ordinating Investigator Qualification', 'Co-ordinating Investigator Telephone', 'Co-ordinating Investigator Email', 'Principal Investigator Name', 'Principal Investigator Qualification', 'Principal Investigator Telephone', 'Principal Investigator Email', 'Sponsor Name', 'Sponsor Phone', 'Sponsor Email',
            // 'Created',
            );
$sources = array('protocol_no', 'study_title', 'short_title', );
echo implode(',', $header) . "\n";
foreach ($data as $row):
	/*foreach ($row['Application'] as &$cell):
		// Escape double quotation marks
		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
	endforeach;*/
	// echo implode(',', $row['Application']) . "\n";
	$content = '';
	foreach ($sources as $key) {
		//if simple match 
		if (isset($row[$key])) {
			$content .= '"' . preg_replace('/"/','""',$row[$key]) . '",';
		}
	}
	echo $content. "\n";
endforeach;
