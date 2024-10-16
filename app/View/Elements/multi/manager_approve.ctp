<div class="row-fluid">
  <div class="span12">
    <?php 
        echo $this->Session->flash();
      ?>
    <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <p><strong>2. Study Title: </strong><?php echo $application['Application']['study_title'];?></p>
        <hr class="soften" style="margin: 10px 0px;">
        <div class="row-fluid">
          <div class="span12">
            <?php
                if ($application['Application']['approved'] == 2) {
                   echo "<h2> Approved <h2>";
               } elseif($application['Application']['approved'] == 1) {
                    echo "<h2>Rejected</h2>";
                } else {
            ?>
              <h4 class="text-success">Approve or Reject application <span class="muted">:if no, the application is rejected</span></h4>
              <hr>
            <?php
                  echo $this->Form->create('Application', array(
                        'url' => array('action' => 'approve', $application['Application']['id']),
                        'type' => 'post',
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
                  echo $this->Form->input('id', array('value' => $application['Application']['id'], 'type' => 'hidden'));
                  echo $this->Form->input('approval_date', array('value' => date('d-m-Y'), 'type' => 'hidden'));

                  echo $this->Form->input('approved', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                      'class' => 'approved',
                      'before' => '<div class="control-group">   <label class="control-label required">
                        Approve? <span class="sterix">*</span></label>  <div class="controls">
                        <input type="hidden" value="" id="ApplicationApproved_" name="data[Application][approved]"> <label class="radio inline">',
                      'after' => '</label>',
                      'options' => array(2 => 'Yes'),
                    ));
                    echo $this->Form->input('approved', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'class' => 'approved',
                      'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                      'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                      'before' => '<label class="radio inline">',
                      'after' => '</label>
                            <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                            onclick="$(\'.approved\').removeAttr(\'checked disabled\')">
                            <em class="accordion-toggle">clear!</em></a> </span>
                            </div> </div>',
                      'options' => array(1 => 'No'),
                    ));

                  echo $this->Form->input('approved_reason', array(
                    'label' => array('class' => 'control-label', 'text' => 'Message'),
                    'placeholder' => ' ' , 'class' => 'input-xlarge',  'rows' => '3'
                  ));
                  echo $this->Form->input('password', array(
                    'label' => array('class' => 'control-label', 'text' => 'Your Password <span class="sterix">*</span>'),
                    'placeholder' => 'password' , 'class' => 'input-large',
                  ));
              ?>
              <div class="controls">
              <?php
                echo $this->Form->button('<i class="icon-save"></i> Submit', array(
                    'name' => 'submit',
                    'class' => 'btn btn-primary',
                    'id' => 'ApproveProtocol',
                  ));
                ?>
              </div>
              <?php
                  echo $this->Form->end();
                }
               ?>
       </div>
       </div>

    </div>
  </div>