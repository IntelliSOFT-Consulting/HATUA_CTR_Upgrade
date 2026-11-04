<?php
$formatReviewContent = function ($content) {
  $content = trim((string)$content);
  if ($content === '') {
    return '<span class="muted">No content provided.</span>';
  }
  if (preg_match('/<\s*(p|ul|ol|li|br|div|strong|em|span|h[1-6]|table|blockquote)\b/i', $content)) {
    return $content;
  }
  $lines = preg_split('/\r\n|\r|\n/', $content);
  $lines = array_values(array_filter(array_map('trim', $lines), 'strlen'));
  if (count($lines) > 1) {
    return '<ul><li>' . implode('</li><li>', array_map('h', $lines)) . '</li></ul>';
  }
  return '<p>' . nl2br(h($content)) . '</p>';
};

$reviewerAssessments = array();
if (!empty($application['Review'])) {
  foreach ($application['Review'] as $rev) {
    if (!empty($rev['type']) && $rev['type'] === 'reviewer_comment') {
      $reviewerAssessments[] = $rev;
    }
  }
}

$managerComments = array();
if (!empty($application['Review'])) {
  foreach ($application['Review'] as $rev) {
    if (!empty($rev['type']) && $rev['type'] === 'ppb_comment') {
      $managerComments[] = $rev;
    }
  }
}

$stages = $this->requestAction('applications/stages/' . $application['Application']['id']);
?>

<div class="row-fluid">
  <div class="span12">
    <div class="page-header" style="margin-top: 0;">
      <div class="pull-right">
        <?php
        echo $this->Html->link(
          '<i class="icon-file-alt"></i> Stage Turnaround PDF',
          array('controller' => 'applications', 'action' => 'stages_summary', 'manager' => true, 'ext' => 'pdf'),
          array('class' => 'btn btn-small btn-info', 'escape' => false, 'style' => 'margin-right: 5px;')
        );
        ?>
        <button type="button" class="btn btn-small btn-inverse" onclick="window.print();">
          <i class="icon-print"></i> Print
        </button>
      </div>
      <h3><i class="icon-file-text-alt"></i> Summary Evaluation Report</h3>
      <p class="muted">Aligned with WHO Global Benchmarking Tool (GBT) for Clinical Trials Oversight &mdash; CT04 Guidelines</p>
    </div>

    <!-- Section 1: Protocol Overview -->
    <div class="well well-small" style="background-color: #fafafa;">
      <h4 class="text-info" style="margin-top: 0;"><i class="icon-info-sign"></i> 1. Protocol & Trial Overview</h4>
      <table class="table table-bordered table-condensed" style="background-color: #fff; margin-bottom: 0;">
        <tbody>
          <tr>
            <th style="width: 25%;" class="my-well">ECCT Reference No.</th>
            <td style="width: 25%;"><strong><?php echo h($application['Application']['protocol_no']); ?></strong></td>
            <th style="width: 25%;" class="my-well">Protocol Date</th>
            <td style="width: 25%;"><?php echo h($application['Application']['date_of_protocol']); ?></td>
          </tr>
          <tr>
            <th class="my-well">Study Title</th>
            <td colspan="3"><?php echo h(strip_tags($application['Application']['study_title'])); ?></td>
          </tr>
          <tr>
            <th class="my-well">Disease Condition</th>
            <td><?php echo h($application['Application']['disease_condition']); ?></td>
            <th class="my-well">Trial Phase</th>
            <td>
              <?php
              $phases = array();
              if (!empty($application['Application']['trial_human_pharmacology'])) $phases[] = 'Phase I';
              if (!empty($application['Application']['trial_therapeutic_exploratory'])) $phases[] = 'Phase II';
              if (!empty($application['Application']['trial_therapeutic_confirmatory'])) $phases[] = 'Phase III';
              if (!empty($application['Application']['trial_therapeutic_use'])) $phases[] = 'Phase IV';
              echo !empty($phases) ? implode(', ', $phases) : '<span class="muted">N/A</span>';
              ?>
            </td>
          </tr>
          <tr>
            <th class="my-well">Principal Investigator(s)</th>
            <td>
              <?php
              if (!empty($application['InvestigatorContact'])) {
                foreach ($application['InvestigatorContact'] as $pi) {
                  echo h($pi['given_name'] . ' ' . $pi['middle_name'] . ' ' . $pi['family_name']) . '<br>';
                }
              } else {
                echo '<span class="muted">Not recorded</span>';
              }
              ?>
            </td>
            <th class="my-well">Study Site(s)</th>
            <td>
              <?php
              if (!empty($application['SiteDetail'])) {
                foreach ($application['SiteDetail'] as $site) {
                  $countyName = !empty($site['County']['county_name']) ? ' (' . $site['County']['county_name'] . ')' : '';
                  echo h($site['site_name']) . h($countyName) . '<br>';
                }
              } else {
                echo '<span class="muted">Not recorded</span>';
              }
              ?>
            </td>
          </tr>
          <tr>
            <th class="my-well">Regulatory Decision</th>
            <td>
              <?php
              if ($application['Application']['approved'] == 2) {
                echo '<span class="label label-success">Approved</span>';
                if (!empty($application['Application']['approval_date'])) {
                  echo ' <small class="muted">on ' . h(date('d-m-Y', strtotime($application['Application']['approval_date']))) . '</small>';
                }
              } elseif ($application['Application']['approved'] == 1) {
                echo '<span class="label label-important">Rejected</span>';
                if (!empty($application['Application']['approval_date'])) {
                  echo ' <small class="muted">on ' . h(date('d-m-Y', strtotime($application['Application']['approval_date']))) . '</small>';
                }
              } else {
                echo '<span class="label label-warning">Under Review</span>';
              }
              ?>
            </td>
            <th class="my-well">Date Submitted</th>
            <td>
              <?php echo !empty($application['Application']['date_submitted']) ? h($application['Application']['date_submitted']) : '<span class="muted">Not recorded</span>'; ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Section 2: Turnaround Benchmarks against WHO Targets -->
    <div class="well well-small" style="background-color: #fafafa;">
      <h4 class="text-info" style="margin-top: 0;"><i class="icon-dashboard"></i> 2. Assessment Turnaround Benchmarks (WHO Targets)</h4>
      <div style="overflow-x: auto;">
        <table class="table table-bordered table-condensed" style="background-color: #fff; font-size: 11px; margin-bottom: 0;">
          <thead>
            <tr style="background-color: #f5f5f5;">
              <th>Stage</th>
              <th>Benchmark Target</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Turnaround (Days)</th>
              <th>Benchmark Compliance</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $benchmarkConfigs = array(
              'Creation' => array('target' => 'Initial', 'unit' => 'N/A'),
              'Screening' => array('target' => '<= 5 days', 'unit' => 'days'),
              'ScreeningSubmission' => array('target' => '<= 10 days', 'unit' => 'days'),
              'Assign' => array('target' => '<= 5 days', 'unit' => 'days'),
              'Review' => array('target' => '<= 30 days', 'unit' => 'days'),
              'ReviewSubmission' => array('target' => '<= 90 days', 'unit' => 'days'),
              'FinalDecision' => array('target' => '<= 15 days', 'unit' => 'days'),
              'AnnualApproval' => array('target' => 'Annual (365 days)', 'unit' => 'to expiry'),
            );

            foreach ($benchmarkConfigs as $stKey => $bmInfo) {
              $stData = isset($stages[$stKey]) ? $stages[$stKey] : null;
              if (!$stData) continue;
              $statusBadge = '<span class="label label-success">Met Target</span>';
              if ($stData['color'] === 'warning') {
                $statusBadge = '<span class="label label-warning">Pending / In Progress</span>';
              } elseif ($stData['color'] === 'danger') {
                $statusBadge = '<span class="label label-important">Exceeded Benchmark</span>';
              }
            ?>
              <tr>
                <td><strong><?php echo strip_tags($stData['label']); ?></strong></td>
                <td><?php echo $bmInfo['target']; ?></td>
                <td><?php echo !empty($stData['start_date']) ? h($stData['start_date']) : '-'; ?></td>
                <td><?php echo !empty($stData['end_date']) ? h($stData['end_date']) : '-'; ?></td>
                <td>
                  <?php
                  $days = ($stData['days'] !== '' && $stData['days'] !== null) ? $stData['days'] : '-';
                  echo h($days);
                  ?>
                </td>
                <td><?php echo $statusBadge; ?></td>
              </tr>
            <?php } ?>
            <?php
            $initialSub = !empty($application['Application']['initial_date_submitted']) ? $application['Application']['initial_date_submitted'] : (!empty($application['Application']['date_submitted']) ? $application['Application']['date_submitted'] : null);
            $totalDays = null;
            if (!empty($application['Application']['approval_date']) && !empty($initialSub)) {
              $sD = new DateTime($initialSub);
              $eD = new DateTime($application['Application']['approval_date']);
              $totalDays = $sD->diff($eD)->days;
            }
            ?>
            <tr style="background-color: #f9f9f9; font-weight: bold;">
              <td colspan="4" style="text-align: right;">Total Turnaround (Initial Submission to Approval):</td>
              <td><?php echo ($totalDays !== null) ? ($totalDays . ' days') : '<span class="muted">-</span>'; ?></td>
              <td>
                <?php if ($totalDays !== null) { ?>
                  <span class="label label-info">Completed (<?php echo $totalDays; ?> days)</span>
                <?php } else { ?>
                  <span class="label">In Progress</span>
                <?php } ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Section 3: Expert Committee Summary Evaluation Reports -->
    <div class="well well-small" style="background-color: #fafafa;">
      <h4 class="text-info" style="margin-top: 0;"><i class="icon-user-md"></i> 3. Expert Committee Evaluation Reports</h4>
      <?php if (empty($reviewerAssessments)) { ?>
        <p class="muted">No expert reviewer evaluation reports submitted yet.</p>
      <?php } else { ?>
        <?php foreach ($reviewerAssessments as $idx => $rev) {
          $reviewerName = !empty($rev['User']['name']) ? $rev['User']['name'] : (!empty($rev['User']['username']) ? $rev['User']['username'] : 'Expert Reviewer');
          $assessmentType = !empty($rev['assessment_type']) ? ucfirst($rev['assessment_type']) . ' Assessment' : 'General Assessment';
        ?>
          <div class="well" style="background-color: #fff; margin-bottom: 12px; border-left: 4px solid #0088cc;">
            <div class="row-fluid">
              <div class="span8">
                <h5 style="margin: 0 0 5px 0;">
                  <span class="badge badge-info"><?php echo ($idx + 1); ?></span>
                  <?php echo h($assessmentType); ?> &mdash; <small>Reviewed by <strong><?php echo h($reviewerName); ?></strong></small>
                </h5>
                <small class="muted">
                  <i class="icon-calendar"></i> Evaluated on: <?php echo date('d-M-Y H:i', strtotime($rev['created'])); ?>
                  &nbsp;|&nbsp;
                  Status: <strong><?php echo h($rev['status']); ?></strong>
                </small>
              </div>
              <div class="span4" style="text-align: right;">
                <?php
                echo $this->Html->link(
                  '<i class="icon-download-alt"></i> Summary PDF',
                  array('controller' => 'reviews', 'ext' => 'pdf', 'action' => 'download_summary', $rev['id']),
                  array('class' => 'btn btn-small btn-info', 'escape' => false, 'style' => 'margin-right: 4px;')
                );
                echo $this->Html->link(
                  '<i class="icon-file-text"></i> Assessment PDF',
                  array('controller' => 'reviews', 'ext' => 'pdf', 'action' => 'download_assessment', $rev['id']),
                  array('class' => 'btn btn-small', 'escape' => false)
                );
                ?>
              </div>
            </div>

            <hr style="margin: 8px 0;">

            <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
              <tbody>
                <tr>
                  <th style="width: 25%; background-color: #f9f9f9;">Summary of Comments</th>
                  <td><?php echo $formatReviewContent($rev['summary']); ?></td>
                </tr>
                <tr>
                  <th style="width: 25%; background-color: #f9f9f9;">Recommendation</th>
                  <td><?php echo $formatReviewContent($rev['recommendation']); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        <?php } ?>
      <?php } ?>
    </div>

    <!-- Section 4: PPB Manager & Committee Evaluation -->
    <div class="well well-small" style="background-color: #fafafa;">
      <h4 class="text-info" style="margin-top: 0;"><i class="icon-legal"></i> 4. Regulatory Authority (PPB) Review & Recommendations</h4>
      <?php if (empty($managerComments)) { ?>
        <p class="muted">No manager comments or recommendations recorded yet.</p>
      <?php } else { ?>
        <?php foreach ($managerComments as $idx => $mRev) {
          $mUserName = !empty($mRev['User']['name']) ? $mRev['User']['name'] : 'PPB Manager';
        ?>
          <div class="well" style="background-color: #fff; margin-bottom: 10px; border-left: 4px solid #51a351;">
            <div class="row-fluid">
              <div class="span12">
                <h5 style="margin: 0 0 5px 0;">
                  <span class="badge badge-success"><?php echo ($idx + 1); ?></span>
                  Manager Review &mdash; <small>by <strong><?php echo h($mUserName); ?></strong> on <?php echo date('d-M-Y H:i', strtotime($mRev['created'])); ?></small>
                </h5>
              </div>
            </div>
            <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
              <tbody>
                <?php if (!empty($mRev['text'])) { ?>
                <tr>
                  <th style="width: 25%; background-color: #f9f9f9;">Manager's Comment(s)</th>
                  <td><?php echo $formatReviewContent($mRev['text']); ?></td>
                </tr>
                <?php } ?>
                <?php if (!empty($mRev['recommendation'])) { ?>
                <tr>
                  <th style="width: 25%; background-color: #f9f9f9;">Manager's Recommendation(s)</th>
                  <td><?php echo $formatReviewContent($mRev['recommendation']); ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } ?>
      <?php } ?>
    </div>

    <!-- Section 5: Official Regulatory Action Timestamps -->
    <div class="well well-small" style="background-color: #fafafa;">
      <h4 class="text-info" style="margin-top: 0;"><i class="icon-time"></i> 5. Regulatory Action Timestamps</h4>
      <table class="table table-bordered table-condensed" style="background-color: #fff; margin-bottom: 0;">
        <thead>
          <tr style="background-color: #f5f5f5;">
            <th>Regulatory Action</th>
            <th>Official Timestamp</th>
            <th>Status Indicator</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Application Submission</strong></td>
            <td><?php echo !empty($application['Application']['date_submitted']) ? h($application['Application']['date_submitted']) : '<span class="muted">Not recorded</span>'; ?></td>
            <td><?php echo $application['Application']['submitted'] ? '<span class="label label-success">Submitted</span>' : '<span class="label">Draft</span>'; ?></td>
          </tr>
          <?php if (!empty($application['Application']['approval_date'])) { ?>
          <tr>
            <td>
              <strong><?php echo ($application['Application']['approved'] == 2) ? 'Official Approval' : 'Official Rejection'; ?></strong>
            </td>
            <td><?php echo h(date('d-M-Y', strtotime($application['Application']['approval_date']))); ?></td>
            <td>
              <?php echo ($application['Application']['approved'] == 2) ? '<span class="label label-success">Approved</span>' : '<span class="label label-important">Rejected</span>'; ?>
            </td>
          </tr>
          <?php } ?>
          <?php if (!empty($application['Application']['trial_status_date'])) { ?>
          <tr>
            <td>
              <strong>Trial Status Change (<?php echo !empty($application['TrialStatus']['name']) ? h($application['TrialStatus']['name']) : 'Status'; ?>)</strong>
            </td>
            <td><?php echo h(date('d-M-Y H:i', strtotime($application['Application']['trial_status_date']))); ?></td>
            <td><span class="label label-info"><?php echo !empty($application['TrialStatus']['name']) ? h($application['TrialStatus']['name']) : 'Updated'; ?></span></td>
          </tr>
          <?php } ?>
          <?php if (!empty($application['Application']['final_date'])) { ?>
          <tr>
            <td><strong>Final Study Report / Completion</strong></td>
            <td><?php echo h(date('d-M-Y', strtotime($application['Application']['final_date']))); ?></td>
            <td><span class="label label-inverse">Completed</span></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
