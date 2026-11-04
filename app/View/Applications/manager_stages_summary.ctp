<?php
$this->assign('Reports', 'active');

$stageColumns = array(
  array('key' => 'Creation', 'label' => 'Application<br>Creation', 'target' => 'Start', 'annual' => false),
  array('key' => 'Screening', 'label' => 'Screening', 'target' => '<= 5d', 'annual' => false),
  array('key' => 'ScreeningSubmission', 'label' => 'Response to<br>Queries', 'target' => '<= 10d', 'annual' => false),
  array('key' => 'Assign', 'label' => 'Assigned to<br>Reviewers', 'target' => '<= 5d', 'annual' => false),
  array('key' => 'Review', 'label' => 'Review<br>Comments', 'target' => '<= 30d', 'annual' => false),
  array('key' => 'ReviewSubmission', 'label' => 'Sponsor<br>Feedback', 'target' => '<= 90d', 'annual' => false),
  array('key' => 'FinalDecision', 'label' => 'Final<br>Decision', 'target' => '<= 15d', 'annual' => false),
  array('key' => 'AnnualApproval', 'label' => 'Annual<br>Approval', 'target' => 'Annual', 'annual' => true),
);
?>

<div class="row-fluid">
  <div class="span12">
    <div class="page-header" style="margin-top: 0;">
      <div class="pull-right">
        <?php
        echo $this->Html->link(
          '<i class="icon-file-alt"></i> Export Excel',
          array_merge(array('action' => 'stages_summary', 'ext' => 'csv'), $this->request->named),
          array('class' => 'btn btn-success', 'escape' => false, 'style' => 'margin-right: 5px;')
        );
        echo $this->Html->link(
          '<i class="icon-file"></i> Export PDF',
          array_merge(array('action' => 'stages_summary', 'ext' => 'pdf'), $this->request->named),
          array('class' => 'btn btn-primary', 'escape' => false)
        );
        ?>
      </div>
      <h3><i class="icon-dashboard"></i> Internal Benchmark Tracking System</h3>
      <p class="muted">Assessment turnaround against WHO Global Benchmarking Tool (GBT) targets for Clinical Trials Oversight</p>
    </div>

    <!-- Benchmark Reference Banner -->
    <div class="alert alert-info">
      <strong><i class="icon-info-sign"></i> WHO GBT Assessment Turnaround Benchmarks:</strong>
      Screening: <strong>&le; 5 days</strong> &bull;
      Response to Queries: <strong>&le; 10 days</strong> &bull;
      Assign Reviewers: <strong>&le; 5 days</strong> &bull;
      PPB / Committee Review: <strong>&le; 30 days</strong> &bull;
      Sponsor Feedback: <strong>&le; 90 days</strong> &bull;
      Final Decision: <strong>&le; 15 days</strong>
      <span class="pull-right">
        <span class="label label-success">Met Target</span>
        <span class="label label-warning">In Progress</span>
        <span class="label label-important">Exceeded Benchmark</span>
      </span>
    </div>

    <!-- Filter Form -->
    <?php
    echo $this->Form->create('Application', array(
      'url' => array_merge(array('action' => 'stages_summary'), $this->params['pass']),
      'class' => 'ctr-groups form-inline',
      'style' => 'padding: 9px; background-color: #f5f5f5; margin-bottom: 15px; border-radius: 4px;'
    ));
    ?>
    <div class="row-fluid">
      <div class="span3">
        <?php
        echo $this->Form->input('protocol_no', array(
          'div' => false,
          'class' => 'span12',
          'label' => array('class' => 'control-label', 'text' => 'ECCT Reference No.')
        ));
        ?>
      </div>
      <div class="span4">
        <?php
        echo $this->Form->input('start_date', array(
          'div' => false,
          'type' => 'text',
          'class' => 'input-small',
          'after' => ' -to- ',
          'label' => array('class' => 'control-label', 'text' => 'Submission Date Range: '),
          'placeholder' => 'Start Date',
          'id' => 'ApplicationStartDate'
        ));
        echo $this->Form->input('end_date', array(
          'div' => false,
          'type' => 'text',
          'class' => 'input-small',
          'label' => false,
          'placeholder' => 'End Date',
          'id' => 'ApplicationEndDate'
        ));
        ?>
      </div>
      <div class="span2">
        <?php
        echo $this->Form->input('pages', array(
          'type' => 'select',
          'div' => false,
          'class' => 'span12',
          'selected' => isset($this->request->params['paging']['Application']['limit']) ? $this->request->params['paging']['Application']['limit'] : null,
          'empty' => true,
          'options' => $page_options,
          'label' => array('class' => 'control-label', 'text' => 'Rows')
        ));
        ?>
      </div>
      <div class="span3" style="text-align: right; padding-top: 15px;">
        <?php
        echo $this->Form->button('<i class="icon-search icon-white"></i> Filter', array(
          'class' => 'btn btn-inverse',
          'div' => false,
          'style' => 'margin-right: 5px;'
        ));
        echo $this->Html->link('<i class="icon-remove"></i> Clear', array('action' => 'stages_summary'), array('class' => 'btn', 'escape' => false));
        ?>
      </div>
    </div>
    <?php echo $this->Form->end(); ?>

    <!-- Table of Turnaround against WHO Targets -->
    <?php if (count($applications) > 0) { ?>
      <div style="overflow-x: auto;">
        <table class="table table-bordered table-striped table-condensed" style="font-size: 11px;">
          <thead>
            <tr style="background-color: #f5f5f5;">
              <th style="width: 3%;">#</th>
              <th style="width: 12%;">ECCT Reference No.</th>
              <th style="width: 18%;">Study Title</th>
              <?php foreach ($stageColumns as $col) { ?>
                <th style="text-align: center;">
                  <?php echo $col['label']; ?><br>
                  <small class="muted"><?php echo $col['target']; ?></small>
                </th>
              <?php } ?>
              <th style="width: 7%; text-align: center;">Date Submitted</th>
              <th style="width: 7%; text-align: center;">Date Approved</th>
              <th style="width: 7%; text-align: center;">Total Turnaround</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = ($this->request->paging['Application']['page'] - 1) * $this->request->paging['Application']['limit'];
            foreach ($applications as $application) {
              $count++;
              $stages = $this->requestAction('applications/stages/' . $application['Application']['id']);
              $rowClass = '';
              if (Hash::check($stages, '{s}[color!=success]')) {
                $colors = Hash::extract($stages, '{s}[color!=success].color');
                if (in_array('danger', $colors)) {
                  $rowClass = 'error';
                } elseif (in_array('warning', $colors)) {
                  $rowClass = 'warning';
                }
              }
            ?>
              <tr class="<?php echo $rowClass; ?>">
                <td><?php echo $count; ?></td>
                <td>
                  <?php
                  echo $this->Html->link(
                    $application['Application']['protocol_no'],
                    array('action' => 'view', $application['Application']['id']),
                    array('escape' => false, 'style' => 'font-weight: bold;')
                  );
                  ?>
                </td>
                <td>
                  <small><?php echo h(String::truncate(strip_tags($application['Application']['study_title']), 80)); ?></small>
                </td>
                <?php foreach ($stageColumns as $col) { ?>
                  <td style="text-align: center;">
                    <?php
                    if (isset($stages[$col['key']])) {
                      $st = $stages[$col['key']];
                      $badgeStyle = 'badge-success';
                      if ($st['color'] === 'warning') $badgeStyle = 'badge-warning';
                      elseif ($st['color'] === 'danger') $badgeStyle = 'badge-important';
                      elseif ($st['color'] === 'default') $badgeStyle = '';

                      $daysDisplay = ($st['days'] !== '' && $st['days'] !== null) ? $st['days'] . 'd' : '';
                      if (!empty($st['start_date'])) {
                        echo '<small>' . h($st['start_date']) . '</small>';
                      }
                      if ($daysDisplay !== '') {
                        echo '<br><span class="badge ' . $badgeStyle . '" style="font-size: 10px;">' . h($daysDisplay) . '</span>';
                      }
                    } else {
                      echo '<span class="muted">-</span>';
                    }
                    ?>
                  </td>
                <?php } ?>
                <td style="text-align: center;">
                  <small><?php echo !empty($application['Application']['date_submitted']) ? h($application['Application']['date_submitted']) : '-'; ?></small>
                </td>
                <td style="text-align: center;">
                  <small><?php echo !empty($application['Application']['approval_date']) ? h(date('d-m-Y', strtotime($application['Application']['approval_date']))) : '-'; ?></small>
                </td>
                <td style="text-align: center;">
                  <?php
                  $initialSub = !empty($application['Application']['initial_date_submitted']) ? $application['Application']['initial_date_submitted'] : (!empty($application['Application']['date_submitted']) ? $application['Application']['date_submitted'] : null);
                  if (!empty($application['Application']['approval_date']) && !empty($initialSub)) {
                    $sD = new DateTime($initialSub);
                    $eD = new DateTime($application['Application']['approval_date']);
                    $diff = $sD->diff($eD);
                    echo '<span class="badge badge-info" style="font-size: 10px;">' . $diff->days . 'd</span>';
                  } else {
                    echo '<span class="muted">-</span>';
                  }
                  ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="pagination pagination-centered">
        <ul>
          <?php
          echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
          echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active'));
          echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
          ?>
        </ul>
      </div>
      <p class="text-center muted">
        <?php
        echo $this->Paginator->counter(array(
          'format' => __('Page {:page} of {:pages}, showing {:current} applications out of {:count} total')
        ));
        ?>
      </p>
    <?php } else { ?>
      <p class="lead text-center">No applications matched the benchmark tracking criteria.</p>
    <?php } ?>
  </div>
</div>

<script type="text/javascript">
$(function() {
  $('#ApplicationStartDate, #ApplicationEndDate').datepicker({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
    changeYear: true
  });
});
</script>
