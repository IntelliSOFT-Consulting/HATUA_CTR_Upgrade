<?php
    $this->Html->script('multi/inspection_summary', array('inline' => false));
  ?>

<div class="tab-pane" id="summary_report">

<?php if(($this->Session->read('Auth.User.id') == $site_inspection['user_id'] or $this->Session->read('Auth.User.group_id') == '2') and $site_inspection['summary_approved'] < 1) { ?>
  <div class="page-header">
    <div class="styled_title"><h3>Summary Report</h3></div>
  </div>
    <?php
      echo $this->Form->create('SiteInspection', array(
            'url' => array('controller' => 'site_inspections','action' => 'summary', $site_inspection['id'], $site_inspection['application_id']),
            'type' => 'file',
            'class' => 'form-horizontal',
            'inputDefaults' => array(
              'div' => array('class' => 'control-group'),
              'label' => array('class' => 'control-label'),
              'between' => '<div class="controls">',
              'after' => '</div>',
              'class' => '',
              'format' => array('before', 'label', 'between', 'input', 'after','error'),
              'error' => array('attributes' => array( 'class' => 'controls help-block')),
             ),
      ));
      echo $this->Form->input('SiteInspection.'.$akey.'.id', array('value' => $site_inspection['id'], 'type' => 'hidden'));
      echo $this->Form->input('SiteInspection.'.$akey.'.outcome',
            array('type' => 'select', 'empty' => true,
              'options' =>  array('Passed' => 'Passed', 'Under Review' => 'Under Review', 
                                  'Failed Inspection' => 'Failed Inspection'), 
              'label' => array('class' => 'control-label required', 'text' => 'Inspection Outcome <span class="sterix">*</span>')));
      echo $this->Form->input('SiteInspection.'.$akey.'.conclusion',
        array('class' => 'input-xxlarge', 'label' => array('class' => 'control-label required', 'text' => 'Conclusion <span class="sterix">*</span>')));
      echo $this->Form->input('SiteInspection.'.$akey.'.summary_report',
        array('class' => 'input-xxlarge', 'label' => array('class' => 'control-label required', 'text' => 'Summary Report <span class="sterix">*</span>')));
      ?>

      <?php if (!empty($site_inspection['Attachment'])) { ?>
    <div class="row-fluid">
      <div class="span6">Uploaded Files:</div>
      <div class="span6">
        <?php
          
            foreach ($site_inspection['Attachment'] as $key => $value) {
              echo '<p>';
               echo $this->Html->link(__($value['basename']),
                 array('controller' => 'attachments',  'action' => 'download', $value['id'],
                   'full_base' => true),
                 array('class' => 'btn btn-info'));
               echo '</p>';
              }
            
        ?>
      </div>
    </div>
    <?php } ?>

    <div class="row-fluid">
      <div class="span6 control-label">
        <label>Attach report(s) (if available)</label>
      </div>
      <div class="span6">
        <div class="uploadsTable">
          <h6>
              <button type="button" class="btn btn-primary btn-small addGCPfile" value="<?php echo $akey; ?>">&nbsp;<i class="icon-plus"></i>&nbsp;</button>
          </h6>
          <hr>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="span10">
        <div class="well">
          <?php
            echo $this->Form->button('<i class="icon-save"></i> Save Changes', array(
                'name' => 'saveChanges',
                'class' => 'btn btn-success  mapop',
                'id' => 'LeloSaveChanges', 'title'=>'Save & continue editing',
                'data-content' => 'Save changes to form without submitting it.
                                            The form will still be available for further editing.',
                'div' => false,
              ));
          ?>
          <?php
            echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                'name' => 'submitReport',
                'onclick'=>"return confirm('Are you sure you wish to submit the report?');",
                'class' => 'btn btn-info  mapop',
                'id' => 'LeloSubmitReport', 'title'=>'Save and Submit Report',
                'data-content' => 'Save the report and submit.',
                'div' => false,
              ));

          ?>
        </div>
      </div>
    </div>

    <?php
    echo $this->Form->end();
  ?>

  <?php } else { ?>
  <div class="page-header">
    <div class="styled_title"><h3>Summary Report</h3></div>
  </div>
    <table class="table  table-condensed">
      <tbody>
       <tr>
        <td class="table-label required"><p>Outcome: <span class="sterix">*</span></p></td>
        <td>
          <?php 
               echo $site_inspection['outcome'];
          ?>
        </td>
       </tr>
       <tr>
        <td class="table-label required"><p>Conclusion: <span class="sterix">*</span></p></td>
        <td>
          <?php 
               echo $site_inspection['conclusion'];
          ?>
        </td>
       </tr>
       <tr>
        <td class="table-label required"><p>Summary Report: <span class="sterix">*</span></p></td>
        <td>
          <?php 
               echo $site_inspection['summary_report'];
          ?>
        </td>
       </tr>
       <tr>
        <td class="table-label required"><p>Attachments: <span class="sterix">*</span></p></td>
        <td>
          <?php
          
            foreach ($site_inspection['Attachment'] as $key => $value) {
              echo '<p>';
               echo $this->Html->link(__($value['basename']),
                 array('controller' => 'attachments',  'action' => 'download', $value['id'],
                   'full_base' => true),
                 array('class' => 'btn btn-info'));
               echo '</p>';
              }
            
          ?>
        </td>
       </tr>
      </tbody>
    </table>
  <?php } ?>
</div>