<?php

$header = array(
    'id' => '#', 'ip' => 'Protocol_No.', 'message' => 'Message', 'created' => 'Action_Date',
);

echo implode(',', $header) . "\n";
foreach ($audits as $audit) :
    $content = '';
    $row = [];
    foreach ($header as $key => $val) {
        if (array_key_exists($key, $audit['AuditTrail'])) {
            $row[$key] = '"' . preg_replace('/"/', '""', $audit['AuditTrail'][$key]) . '"';
        }
    }
    echo implode(',', $row) . "\n";
endforeach;
