<?php
echo $this->Session->flash();
?>

<br>
<div class="row-fluid">
  <div class="span12">
    <?php
    if ($redir == 'applicant') {
      echo $this->Html->link(
        __('<i class="icon-upload"></i> Upload CIOM'),
        array('controller' => 'cioms', 'action' => 'add', $application['Application']['id']),
        array('escape' => false, 'class' => 'btn btn-inverse')
      ); ?>
   
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#ciomUpload" aria-controls="ciomUpload"><i class="icon-user"></i> Allocate Report</a>

    <div id="ciomUpload" class="collapse show">
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
      echo $this->Form->input('model', array('type' => 'hidden', 'value' => 'CIOM'));
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

    <?php  }
    ?>
  </div>
</div>
<br>
<table class="table table-condensed table-bordered" style="margin-bottom: 2px;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Filename</th>
      <th>Created</th>
      <th><?php echo __('Actions'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($application['Ciom'] as $akey => $ciom) {
    ?>
      <tr>
        <td><?php echo $ciom['id'] ?></td>
        <td>
          <?php
          // echo h($ciom['Ciom']['basename']); 
          // echo $this->Html->link(
          //     $ciom['basename'],
          //     str_replace('/var/www/ctr/app/webroot', '', $ciom['file']),
          //     array('class' => 'button', 'target' => '_blank')
          // );
          echo $this->Html->link(__($ciom['basename']), array('controller' => 'cioms', 'action' => 'download', $ciom['id'], 'admin' => false), array('escape' => false));
          ?>
        </td>
        <td><?php echo $ciom['created'] ?></td>
        <td>
          <?php echo $this->Html->link(__('<label class="label label-info">View</label>'), array('controller' => 'cioms', 'action' => 'view', $ciom['id']), array('escape' => false)); ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<br>
<hr>