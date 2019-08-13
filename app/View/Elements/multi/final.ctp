<?php  if ($this->fetch('is-applicant') == 'true') { ?>
  <div class="row-fluid">
    <div class="span12">
    <?php 
        echo $this->Session->flash();
      ?>
      <h4>15. Final Study Report <small>For complete and approved trials</small></h4>
        <hr>
        <div class="row-fluid">
          <div class="span12">
            <?php          
              
                  echo $this->Form->create('Application', array(
                      'url' => array('controller' => 'applications', 'action' => 'final_report', $application['Application']['id']),
                      'class' => 'form-horizontal',
                      'inputDefaults' => array(
                      'div' => array('class' => 'control-group'),
                      'label' => array('class' => 'control-label'),
                      'between' => '<div class="controls">',
                      'after' => '</div>',
                      'class' => '',
                      'format' => array('before', 'label', 'between', 'input', 'after','error'),
                      'error' => array('attributes' => array('class' => 'controls help-block')),
                     ),
                  ));
                  echo $this->Form->input('id', array('type' => 'hidden' ,'value' => $application['Application']['id']));
                  echo $this->Form->input('final_date', array('value' => date('d-m-Y'), 'type' => 'hidden'));
                  echo $this->Form->input('final_report', array(
                      'label' => array('class' => 'control-nolabel required', 'text' => 'Executive summary'),
                      'between'=>'<div class="nocontrols">', 'placeholder' => 'final report' , 'class' => 'input-large',
                      'value' => $application['Application']['final_report']
                    ));
                  echo $this->Form->input('laymans_summary', array(
                      'label' => array('class' => 'control-nolabel required', 'text' => 'Laymans summary'),
                      'between'=>'<div class="nocontrols">', 'placeholder' => 'final report' , 'class' => 'input-large',
                      'value' => $application['Application']['laymans_summary']
                    ));
                  echo $this->Form->end(array(
                    'label' => 'Save',
                    'escape' => false,
                    'value' => 'Save',
                    'class' => 'btn btn-primary',
                    'id' => 'EthicalSaveChanges',
                    'div' => array(
                      'class' => 'form-actions',
                    )
                  ));
               
            ?>
            <hr>        
            <?php
                echo $this->element('multi/documents');
            ?>
            <br>
            <?php
              
                // echo $this->Form->end('<i class="icon-save"></i> Save', array(
                //     'name' => 'submitReport',
                //     // 'onclick'=>"return confirm('Are you sure you wish to submit the form to PPB? You will not be able to edit it later.');",
                //     'class' => 'btn btn-info btn-block',
                //     'id' => 'ApplicationViewSaveReport', 
                //     'div' => false,
                //     'type' => 'button'
                //   ));
            ?>
          </div> <!-- span12 -->
      </div>
    </div>
  </div><!--/row-->
<?php } else { ?>
  <div class="row-fluid">
    <div class="span12">
      <h4>15. Final Study Report <small>For complete and approved trials</small></h4>
        <hr>

            <?php      
               echo $application['Application']['final_report'];
            ?>
            <hr>        
            <?php
                echo $this->element('multi/documents');
            ?>

    </div>
  </div><!--/row-->
<?php } ?>
