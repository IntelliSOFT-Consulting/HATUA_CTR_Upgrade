<?php
  // echo $this->element('application/application_edit');
  $this->extend('/Elements/application/application_edit');
?>

<?php $this->start('header'); ?>
    <?php if (!empty($protocol_no)) { ?>
        <h4 class="text-success"> Unsubmitted Protocol: <small><?php echo $protocol_no;?></small></h4>
    <?php } else { ?>
        <h4 class="text-success"> Unsubmitted Application <small>(<?php echo $this->request->data['Application']['id'];?>)</small></h4>
    <?php } ?>
  <hr style="margin:5px;">
<?php $this->end(); ?>
