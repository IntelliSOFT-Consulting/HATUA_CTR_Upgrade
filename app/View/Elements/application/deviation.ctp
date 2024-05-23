<?php
echo $this->Session->flash();
?>

<br>
<div class="row-fluid">
  <div class="span12">
    <?php
    if ($redir == 'applicant' or $redir == 'monitor') {
      echo $this->Html->link(
        __('<i class="icon-random"></i> Add Protocol Deviation'),
        array('controller' => 'deviations', 'action' => 'add', $application['Application']['id']),
        array('escape' => false, 'class' => 'btn btn-info')
      );

    ?>

      <a class="btn btn-primary" role="button" data-toggle="collapse" href="#deviationUpload" aria-controls="deviationUpload"><i class="icon-user"></i> Allocate Report</a>

      <div id="deviationUpload" class="collapse show">
        <h5>Outsource Report</h5>
        <?php
        echo $this->Form->create('Outsource', array(
          'url' => array('controller' => 'applications', 'action' => 'assign_protocol', $application['Application']['id']),
          'type' => 'file',
          'class' => 'form-horizontal',
          'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => '',
            'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
            'error' => array('attributes' => array('class' => 'controls help-block')),
          ),
        ));
        echo $this->Form->input('id');
        echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
        echo $this->Form->input('model', array('type' => 'hidden', 'value' => 'Deviation'));
        ?>
        <hr>
        <?php

        echo $this->Form->input('username', array(
          'label' => array('class' => 'control-nolabel required', 'text' => 'Enter Username/Email'),
          'placeholder' => ' ', 'class' => 'input-xxlarge', 'between' => '<div class="nocontrols">',
          'escape' => false,
        ));
        ?>
        <?php
        echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
          'name' => 'submitReport',
          'formnovalidate' => 'formnovalidate',
          'onclick' => "return confirm('Are you sure you wish to allocate the report?.');",
          'class' => 'btn btn-info mapop',
          'id' => 'ApplicationSubmitReport', 'title' => 'Save and Submit Report',
          'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
          'div' => false,
        ));

        ?>
        <hr>
        <?php
        echo $this->Form->end();
        ?>
      </div>
    <?php }
    ?>
  </div>
</div>
<br>
<table class="table table-condensed table-bordered" style="margin-bottom: 2px;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Reference No</th>
      <th>Deviation Date</th>
      <th>Deviation Type</th>
      <th>Status</th>
      <th>Created</th>
      <th><?php echo __('Actions'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($application['Deviation'] as $akey => $deviation) {
    ?>
      <tr>
        <td><?php echo $deviation['id'] ?></td>
        <td><?php echo $deviation['reference_no'] ?></td>
        <td><?php echo $deviation['deviation_date'] ?></td>
        <td><?php echo $deviation['deviation_type'] ?></td>
        <td><?php echo $deviation['status'] ?></td>
        <td><?php echo $deviation['created'] ?></td>
        <td>
          <?php
          if ($deviation['status'] === 'Unsubmitted') {
            if ($redir === 'applicant' && $deviation['user_id'] == $this->Session->read('Auth.User.id')) echo $this->Html->link(
              '<label class="label label-success">Edit</label>',
              array('action' => 'view', $application['Application']['id'], 'deviation_edit' => $deviation['id']),
              array('escape' => false)
            );
            if ($redir === 'monitor' && $deviation['user_id'] == $this->Session->read('Auth.User.id')) echo $this->Html->link(
              '<label class="label label-success">Edit</label>',
              array('action' => 'view', $application['Application']['id'], 'deviation_edit' => $deviation['id']),
              array('escape' => false)
            );
            if ($redir === 'inspector' && $deviation['user_id'] == $this->Session->read('Auth.User.id')) echo $this->Html->link(
              '<label class="label label-success">Edit</label>',
              array('action' => 'view', $application['Application']['id'], 'deviation_edit' => $deviation['id']),
              array('escape' => false)
            );
            echo "&nbsp;";

            if ($redir == 'applicant' && $deviation['user_id'] == $this->Session->read('Auth.User.id')) {
              echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('controller' => 'deviations', 'action' => 'delete', $deviation['id']), array('escape' => false), __('Are you sure you want to delete deviation # %s?', $deviation['id']));
            }
          } else {
            echo $this->Html->link(
              '<span class="label label-info"> View </span>',
              array('action' => 'view', $application['Application']['id'], 'deviation_view' => $deviation['id']),
              array('escape' => false)
            );
            echo "&nbsp;";

            if (($redir == 'manager')) {
              echo $this->Form->postLink(__('<label class="label label-inverse">Unsubmit</label>'), array('controller' => 'deviations', 'action' => 'unsubmit', $deviation['id']), array('escape' => false), __('Are you sure you want to unsubmit the deviation # %s? The applicant will be able to edit it.', $deviation['id']));
            }
          }
          ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<br>
<hr>

<?php
if (isset($this->params['named']['deviation_edit']))  $cid = $this->params['named']['deviation_edit'];
if (isset($this->params['named']['deviation_view']))  $cid = $this->params['named']['deviation_view'];

if (isset($this->params['named']['deviation_edit']) || isset($this->params['named']['deviation_view'])) {
  foreach ($application['Deviation'] as $akey => $deviation) {
    if ($deviation['id'] == $cid) {
?>

      <ul id="deviation_tab" class="nav nav-tabs">
        <li class="active"><a href="#deviation_form">Deviation Form</a></li>
        <li><a href="#deviation_comments">PI Comments (<?php echo count($deviation['ExternalComment']); ?>)</a></li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="deviation_form">
          <div style="position: relative; border-top: 1px solid #ddd;">
            <?php
            if (isset($this->params['named']['deviation_edit'])) {
              echo $this->element('/application/deviation_edit', array('deviation' => $deviation, 'akey' => $akey));
            } elseif (isset($this->params['named']['deviation_view'])) {
              echo $this->Html->link(
                __('<i class="icon-download-alt"></i> Download PDF'),
                array('controller' => 'deviations', 'ext' => 'pdf', 'action' => 'download_deviation', $deviation['id']),
                array('escape' => false, 'class' => 'btn btn-small btn-info topright')
              );
              echo $this->element('/application/deviation_view', array('deviation' => $deviation, 'akey' => $akey));
            }
            ?>
          </div>
        </div>

        <div class="tab-pane" id="deviation_comments">
          <div class="row-fluid">
            <div class="span12">
              <br>
              <div class="amend-form">
                <h5 class="text-center"><u>COMMENTS/QUERIES</u></h5>
                <div class="row-fluid">
                  <div class="span8">
                    <?php echo $this->element('comments/list', ['comments' => $deviation['ExternalComment'], 'show' => false]) ?>
                  </div>
                  <div class="span4 lefty">
                    <?php
                    echo $this->element('comments/add', [
                      // 'model' => ['model_id' => $deviation['id'], 'foreign_key' => $deviation['id'], 
                      'model' => [
                        'model_id' => $application['Application']['id'], 'foreign_key' => $deviation['id'],
                        'model' => 'Deviation', 'category' => 'external', 'url' => 'add_dev_external'
                      ]
                    ])
                    ?>
                  </div>
                </div>
              </div>
            </div><!--/span-->
          </div><!--/row-->
        </div>

      </div>

<?php
    }
  }
}
?>

<script text="type/javascript">
  $.expander.defaults.slicePoint = 170;
  $(function() {
    //https://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
    //from mcaz
    $('#deviation_tab a').click(function(e) {
      e.preventDefault();
      $(this).tab('show');
    });

    $('#deviation_tab a').on("shown", function(e) {
      var id = $(e.target).attr("href");
      localStorage.setItem('deviationTab', id)
    });

    var deviationTab = localStorage.getItem('deviationTab');
    if (deviationTab != null) {
      // console.log("select tab");
      // console.log($('#deviation_tab a[href="' + deviationTab + '"]'));
      $('#deviation_tab a[href="' + deviationTab + '"]').tab('show');
    }

    var hashTab = $('#deviation_tab a[href="' + location.hash + '"]');
    hashTab && hashTab.tab('show');
    //end mcaz
  });
</script>