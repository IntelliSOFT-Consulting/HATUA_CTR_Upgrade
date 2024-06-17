

<h3 style="text-align: center;"> Protocol Deviation</h3>   
<hr class="soften" style="margin: 10px 0px;">

<?php
  if (($this->Session->read('Auth.User.group_id') == '5' || $this->Session->read('Auth.User.group_id') == '6' || $this->Session->read('Auth.User.group_id') == '8'|| $this->Session->read('Auth.User.group_id') == '7')   and $deviation['status'] == 'Unsubmitted') {

  echo $this->Form->create('Deviation', array(
        'url' => array('controller' => 'deviations','action' => 'edit', $deviation['id'], $deviation['application_id']),
        'type' => 'file',
        'class' => 'form-inline',
        'inputDefaults' => array(
          // 'div' => array('class' => 'control-group'),
          'label' => array('class' => 'control-label'),
          // 'between' => '<div class="controls">',
          // 'after' => '</div>',
          'class' => '',
          'format' => array('before', 'label', 'between', 'input', 'after','error'),
          'error' => array('attributes' => array( 'class' => 'controls help-block')),
         ),
  ));
  echo $this->Form->input('Deviation.'.$akey.'.id', array('value' => $deviation['id'], 'type' => 'hidden'));
?>

  <table class="table table-bordered table-condensed">
    <tbody>
      <tr>
        <th class="my-well" style="width: 45%">Study Title</th>
        <td><?php echo $deviation['study_title'];?></td>
      </tr>
      <tr>
        <th class="my-well">Reference No.</th>
        <td><?php echo $deviation['reference_no'];?></td>
      </tr>
      <tr>
        <th class="my-well">Type of deviation <span class="sterix">*</span></th>
        <td>
          <?php 
            // echo $this->Form->input('Deviation.'.$akey.'.deviation_type', array('label' => false, 'value' => $deviation['deviation_type'])); 
            // echo $this->Form->input('id', array('label' => false, 'value' => $deviation['id'])); 
            echo $this->Form->input('Deviation.'.$akey.'.deviation_type', array(
              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
              'class' => 'deviation_type',
              'before' => '<div class="control-group">
                <div class="controls">
                <input type="hidden" value="" id="ApplicationDesignControlled_" name="data[Application][deviation_type]"> <label class="radio inline">',
              'after' => '</label>',
              'options' => array('Violation' => 'Violation'),
            ));
            echo $this->Form->input('Deviation.'.$akey.'.deviation_type', array(
              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'class' => 'deviation_type',
              'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
              'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
              'before' => '<label class="radio inline">',
              'after' => '</label>
                    <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                    onclick="$(\'.deviation_type\').removeAttr(\'checked disabled\')">
                    <em class="accordion-toggle">clear!</em></a> </span>
                    </div> </div>',
              'options' => array('Deviation' => 'Deviation'),
            ));
          ?>            
      </td>
      </tr> 
      <tr>
        <th class="my-well">PI Name</th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.pi_name', array('label' => false, 'value' => $deviation['pi_name'])); ?></td>
      </tr>        
      <tr>
        <th class="my-well">Date of deviation </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.deviation_date', array('label' => false, 'type' => 'text', 'class' => 'pickadate')); ?></td>
      </tr>
      <tr>
        <th class="my-well">Study participant number </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.participant_number', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Name of treating physician </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.treating_physician', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Description of deviation </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.deviation_description', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Explanation why deviation occurred</th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.deviation_explanation', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Measures taken to address the deviation </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.deviation_measures', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Measures taken to preclude further occurrence of the deviation  </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.deviation_preclude', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Indicate whether the study sponsor has been notified </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.sponsor_notified', array('label' => false)); ?></td>
      </tr>
      <tr>
        <th class="my-well">Impact on the study </th>
        <td><?php echo $this->Form->input('Deviation.'.$akey.'.study_impact', array('label' => false)); ?></td>
      </tr> 
    </tbody>        
  </table>

    <div class="controls">
      <?php
        echo $this->Form->button('<i class="icon-save"></i> Save Changes', array(
            'name' => 'saveChanges',
            'class' => 'btn btn-success mapop',
            'id' => 'DeviationSaveChanges', 'title'=>'Save & continue editing',
            'data-content' => 'Save changes to form without submitting it.
                                        The form will still be available for further editing.',
            'div' => false,
        ));
      ?>
      <?php
        echo $this->Form->button('<i class="icon-rocket"></i> Submit', array(
            'name' => 'submitReport',
            'onclick'=>"return confirm('Are you sure you wish to submit the protocol deviation report?');",
            'class' => 'btn btn-primary mapop',
            'id' => 'DeviationSubmitReport', 'title'=>'Save and Submit Report',
            'data-content' => 'Submit report for peer review and approval.',
            'div' => false,
          ));

      ?>
     </div>

<?php
    echo $this->Form->end();
  }
?>   
