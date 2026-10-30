<?php

// app/Views/Subscribers/export.ctp
$header = array('id' => '#', 'protocol_no' => 'Protocol No.', 'study_title' => 'Study Title', 'reference_no' => 'Reference No.', 'reporter_email' => 'Reporter email', 'basename' => 'Filename', 'created' => 'Creation date');


echo implode(',', $header)."\n";
// debug($data);
foreach ($cioms as $ciom):
	$content = '';
	$row = [];
	foreach ($header as $key => $val) {
		
		if (array_key_exists($key, $ciom['Ciom'])) {
			$row[$key] = '"' . preg_replace('/"/','""',$ciom['Ciom'][$key]) . '"';
		} elseif ($key == 'protocol_no') {
			$row[$key] = '"' . preg_replace('/"/','""', isset($ciom['Application'][$key]) ? $ciom['Application'][$key] : '') . '"';
		} elseif ($key == 'study_title') {
			$studyTitle = !empty($ciom['Application']['study_title']) ? $ciom['Application']['study_title'] : (!empty($ciom['Application']['short_title']) ? $ciom['Application']['short_title'] : '');
			$row[$key] = '"' . preg_replace('/"/','""', $studyTitle) . '"';
		}  
	}
	echo implode(',', $row) . "\n";
endforeach;

?>