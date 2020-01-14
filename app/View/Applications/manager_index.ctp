<?php
  $this->extend('/Elements/application/application_index');


?>

<?php $this->start('header'); ?>
    <?php
      $this->assign('Applications', 'active');
  // debug('Yahoo');
  //     $h1['Application'] = min(Hash::extract($applications, '{n}.Application[id=76]'));
  // debug($h1);
  // debug(Hash::check($applications, '{n}.Application[id=76].id'));
    ?>
    <div class="marketing">
      <div class="row-fluid">
            <div class="span12">
              <h3>Clinical Trial Applications:<small> <i class="icon-glass"></i> Filter, <i class="icon-search"></i> Search, and <i class="icon-eye-open"></i> view applications</small></h3>
              <hr class="soften" style="margin: 10px 0px;">
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php
    $this->assign('color-codes', 'true');
    $this->assign('is-manager', 'true');
?>

<?php
    $this->assign('attributes', 'application/attributes/manager_attributes');
 ?>

<?php $this->start('sidebar'); ?>
    <?php
          $unsubmitted = '';
          if (isset($this->request->params['named']['submitted'])) {
            if ($this->request->params['named']['submitted'] == '0') {
                 $unsubmitted = 'active';
            }
          }
    ?>
      <li class="divider"></li>
      <li class="nav-header"><i class="icon-glass"></i> Submit Status</li>
      <li class="<?php echo $unsubmitted; ?>">
        <?php
          echo $this->Html->link('<i class="icon-minus"></i> Unsubmitted',
                    array('action' => 'index', 'submitted'=>'0'), array('escape' => false));
        ?>
      </li>
<?php $this->end(); ?>

<?php $this->start('persistent-search'); ?>
    <?php
         if (isset($this->request->params['named']['submitted'])) {
           echo $this->Form->input('Application.submitted', array('type' => 'hidden', 'value' => $this->request->params['named']['submitted']));
         }
    ?>
<?php $this->end(); ?>
