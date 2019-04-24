<?php echo $this->element('application/application_edit'); ?>

<?php $this->start('header'); ?>
<h4 class="text-success">
    Unsubmitted Application <small>(<?php echo $this->request->data['Application']['id'];?>)</small>
  </h4>
  <hr style="margin:5px;">
<?php $this->end(); ?>
