<?php
$header = array('id' => '#', 'protocol_no' => 'Protocol No.', 'stages' => 'Stages');
echo implode(',', $header) . "\n";
foreach ($applications as $application) :
    $content = '';
    $row = [];
    $stages = $this->requestAction(
        'applications/stages/' . $application['Application']['id']  //get first element of array
    );
    // debug($stages);
    // exit;
    foreach ($header as $key => $val) {
        if (array_key_exists($key, $application['Application'])) {
            $row[$key] = '"' . preg_replace('/"/', '""', $application['Application'][$key]) . '"';
        } elseif ($key == 'stages') {
            foreach ($stages as $stage) {
                if (!empty($stage['start_date'])) {

                    (isset($row[$key])) ? $row[$key] .= '; ' . $stage['label'] . ':' . $stage['start_date'] . ':' . $stage['end_date'] : $row[$key] = $stage['label'] . ':' . $stage['start_date'] . ':' . $stage['end_date'];
                }}
                (isset($row[$key])) ? $row[$key] = '"' . preg_replace('/"/', '""', $row[$key]) . '"' : $row[$key] = '""';
            
        }
    }
    echo implode(',', $row) . "\n";
endforeach;
