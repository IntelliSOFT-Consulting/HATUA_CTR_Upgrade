<?php
  $this->extend('/Elements/application/workflow');


?>

<?php $this->start('header'); ?>
    <?php
      $this->assign('Workflows', 'active');
    ?>
<?php $this->end(); ?>

<?php
    $this->assign('color-codes', 'true');
    $this->assign('is-manager', 'true');
?>


