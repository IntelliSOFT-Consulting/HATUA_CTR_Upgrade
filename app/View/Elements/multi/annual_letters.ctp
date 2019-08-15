<h3>Annual Approval Letters</h3>
  <?php 
    echo $this->Session->flash();
  ?>

<table  class="table  table-bordered table-striped">
     <thead>
        <tr>
            <th>Id</th>
            <th>Approval No.</th>
            <th>Approval date</th>
            <th>Created</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
         </tr>
       </thead>
      <tbody>
    <?php
    foreach ($application['AnnualLetter'] as $anl): ?>
    <tr class="">
        <td><?php echo h($anl['id']); ?>&nbsp;</td>
        <td><?php echo h($anl['approval_no']); ?>&nbsp;</td>
        <td><?php echo h($anl['approval_date']); ?>&nbsp;</td>
        <td><?php echo h($anl['created']); ?>&nbsp;</td>
        <td class="actions">
          <?php 
              echo $this->Html->link('<span class="label label-info"> View </span>', array('action' => 'view', $application['Application']['id'], 'anl' => $anl['id']), array('escape'=>false));
              echo "&nbsp;";
              if($anl['status'] == 'submitted') 
                echo $this->Html->link('<span class="label label-success"> Approve </span>', array('action' => 'view', $application['Application']['id'], 'ane' => $anl['id']), array('escape'=>false));
              echo "&nbsp;";
              // if($anl['status'] == 'submitted') 
                echo $this->Html->link('<span class="label label-inverse"> Download PDF </span>', array('controller' => 'annual_letters','action' => 'view', $anl['id'], 'ext' => 'pdf',), array('escape'=>false));
          ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br>
<hr>
  
  <!-- View approval letter -->
  <?php
    if(isset($this->params['named']['anl'])) {
        foreach ($application['AnnualLetter'] as $akey => $annual_letter) {
            if ($annual_letter['id'] == $this->params['named']['anl']) {               
  ?>
    <div class="ctr-groups">
        <?php   echo $anl["content"]; ?> &nbsp;
    </div>
  <?php } } } ?>

  <!-- Edit approval letter -->
  <?php
  if(isset($this->params['named']['ane'])) {
      foreach ($application['AnnualLetter'] as $akey => $annual_letter) {
          if ($annual_letter['id'] == $this->params['named']['ane']) {               
  ?>
    <div class="ctr-groups">
        <?php echo $this->Form->create('AnnualLetter', array(
              'url' => array('controller' => 'annual_letters', 'action' => 'approve', $annual_letter['id']),
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
        echo $this->Form->input('id'); ?>
        <fieldset>
            <legend>Approve</strong></legend>
        <?php
            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $annual_letter['id']));
            echo $this->Form->input('status', array('type' => 'hidden', 'value' => 'approved'));
            echo $this->Form->input('content', array(
                  'label' => false, 'value' => $annual_letter['content'],
                  'between'=>'<div class="controle">',  'class' => 'input-large',
                ));
        ?>
        </fieldset>
      <?php echo  $this->Form->end(array(
                'label' => 'Paste Signagure and Approve',
                'value' => 'Approve',
                'class' => 'btn btn-success',
                'div' => array(
                    'class' => 'form-actions',
                )
            ));
            ?>
      <script type="text/javascript">
          CKEDITOR.replace( 'data[AnnualLetter][content]');
      </script>
    </div>
  <?php } } } ?>