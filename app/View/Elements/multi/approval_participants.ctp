  
<div class="row-fluid">
  <div class="span12">
      <?php 
        echo $this->Session->flash();
      ?>
    <div class="page-header">
      <div class="styled_title"><h3>Participants Flow</h3></div>
    </div>
    
  <?php foreach ($application['ParticipantFlow'] as $participantFlow) { ?>
  <table class="table table-bordered table-condensed">
      <thead>
        <th colspan="4"><h4 class="text-warning">Study Recruitment Status (<?php echo $participantFlow['year']; ?>)</h4></th>
      </thead>
      <tbody>
          <tr>
            <td class="table-label required"><p>Number of subjects Originally Authorized to enroll:</p></td>
            <td><?php echo $participantFlow['original_subjects']; ?></td>
            <td class="table-label required"><p>Number Consented</p></td>
            <td><?php echo $participantFlow['consented']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Number Screened:</p></td>
            <td><?php echo $participantFlow['screened']; ?></td>
            <td class="table-label required"><p>Number Enrolled</p></td>
            <td><?php echo $participantFlow['enrolled']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Number Lost (deaths,other) and reason for each:</p></td>
            <td><?php echo $participantFlow['lost']; ?></td>
            <td class="table-label required"><p>Reasons</p></td>
            <td><?php echo $participantFlow['lost_reason']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Number Withdrawn by Investigator and reason for withdrawal(s) of each:</p></td>
            <td><?php echo $participantFlow['withdrawn']; ?></td>
            <td class="table-label required"><p>Reasons</p></td>
            <td><?php echo $participantFlow['withdrawal_reason']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Number Withdrawn (drop outs - subject withdrew him/herself) and reason for withdrawal(s) for each:</p></td>
            <td><?php echo $participantFlow['self_withdrawal']; ?></td>
            <td class="table-label required"><p>Reasons</p></td>
            <td><?php echo $participantFlow['self_withdrawal_reasons']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Number of Active Subjects:</p></td>
            <td><?php echo $participantFlow['active_subjects']; ?></td>
            <td class="table-label required"><p>Number Completed all study activities:</p></td>
            <td><?php echo $participantFlow['completed_number']; ?></td>
          </tr>
      </tbody>
  </table>
  <?php } ?>

  <?php if($redir == 'applicant') { ?>
  <h3>Form</h3>
  <div class="well">
    <div class="row-fluid">
      <div class="span12">
      <?php

        echo $this->Form->create('ParticipantFlow', array(
            'url' => array('controller' => 'participant_flows', 'action' => 'add'),
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
      ?>

      <div class="row-fluid">
        <div class="span6">
          <?php
            echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
            $years = [];
            foreach (range(1986, date('Y')) as $value) {
               $years[$value] = $value;
            }
            arsort($years);
            echo $this->Form->input('year', array('type' => 'select', 'options' => ($years),
                'label' => array('class' => 'control-label', 'text' => 'Year')
              ));
            echo $this->Form->input('original_subjects',
              array('label' => array('class' => 'control-label required', 'text' => 'Number of subjects originally authorized to enroll: <span class="sterix">*</span>'),));
            echo $this->Form->input('consented', array(
                'label' => array('class' => 'control-label required', 'text' => 'Number Consented <span class="sterix">*</span>'), ));
            echo $this->Form->input('screened', array('label' => array('class' => 'control-label', 'text' => 'Number Screened'),));
            echo $this->Form->input('enrolled', array(
              'div' => array('class' => 'control-group required'),
              'label' => array('class' => 'control-label required', 'text' => 'Number Enrolled <span class="sterix">*</span>')
            ));
            echo $this->Form->input('lost', array(
              'div' => array('class' => 'control-group required'),
              'label' => array('class' => 'control-label required', 'text' => 'Number Lost <span class="muted">(deaths/other)</span>and reason for each')
            ));
            echo $this->Form->input('lost_reason',
              array('type' => 'textarea', 'label' => array('class' => 'control-label required', 'text' => 'Reasons'),));

            ?>
        </div><!--/span-->
        <div class="span6">
          <?php
            echo $this->Form->input('withdrawn',
              array(
                'label' => array('class' => 'control-label required', 'text' => 'Number withdrawn by Investigator'),                
                'after'=>'<p class="help-block"> Number withdrawn by Investigator and reason for withdrawal(s) of each </p></div>',
                ));
            echo $this->Form->input('withdrawal_reason', array(
              'type' => 'textarea',
              'label' => array('class' => 'control-label', 'text' => 'Reason'),       
                'after'=>'<p class="help-block"> Reason for withdrawal(s) of each </p></div>',
            ));
            echo $this->Form->input('self_withdrawal',
              array(
                'label' => array('class' => 'control-label required', 'text' => 'Number withdrawn by subjects'),                
                'after'=>'<p class="help-block"> Number withdrawn (drop outs - subject withdrew him/herself) and reason for withdrawal(s) of withdrawal(s) for each </p></div>',
                ));
            echo $this->Form->input('self_withdrawal_reasons', array(
              'type' => 'textarea',
              'label' => array('class' => 'control-label', 'text' => 'Reason'),       
                'after'=>'<p class="help-block"> Reason for subjects withdrawing </p></div>',
            ));
            echo $this->Form->input('active_subjects', array(
              'label' => array('class' => 'control-label', 'text' => 'Number of Active Subjects'),
            ));
            echo $this->Form->input('completed_number', array('label' => array('class' => 'control-label', 'text' => 'Number Completed all study activities'),));
            ?>
        </div><!--/span-->
      </div><!--/row-->
       <hr>

      <?php
        echo $this->Form->end(array(
          'label' => 'Submit',
          'value' => 'Save',
          'class' => 'btn btn-primary',
          'id' => 'ParticipantsSaveChanges',
          'div' => array(
            'class' => 'form-actions',
          )
        ));
      ?>
     </div>  
    </div>
  </div>   <!-- ctr-groups -->
  <hr>
  <?php } ?>



  </div><!--/span-->
</div><!--/row-->
