<?php
    $this->assign('Dashboard', 'active');
    $this->Html->script('dashboard', array('inline' => false));
    $this->Html->script('bootstrap-editable', array('inline' => false));
    $this->Html->css('bootstrap-editable', null, array('inline' => false));
?>
<section>
  <?php
      // $apps = array_filter(Hash::combine($applications, '{n}.Application.id', '{n}.Application.protocol_no'), 'strlen');
      // debug(key($apps));
      $apps = array();
      foreach ($applications as $key => $value) {
        $apps[$value['Application']['id']] = ($value['Application']['protocol_no']) ? $value['Application']['protocol_no'] : $value['Application']['created'];
      }
      $stages = $this->requestAction(
          'applications/stages/'.key($apps)   //get first element of array
      );
         // debug($stages);
  ?>
<div class="row-fluid">  
  <div class="span12">
      <div class="process">
        <div class="process-row">
          <!-- <p style="margin-top: 40px;"></p> -->
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
              <span id="main-text"><?php echo $stages['Creation']['application_name']; ?></span>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <?php
                foreach ($apps as $ak => $app) {
                  echo '<li><a class="lnk" id="'.$ak.'" href="#">'.$app.'</a></li>';
                }
              ?>
            </ul>
          </div>
          <?php
            foreach ($stages as $stage_name => $stage) {
          ?>
            <div class="process-step">
                <button id="<?php echo $stage_name; ?>" type="button" class="btn btn-<?php echo $stage['color'];?> btn-circle" disabled="disabled">
                  <h5 style="text-decoration: underline;"><?php echo $stage['label']; ?></h5> 
                  <small><?php echo (isset($stage['start_date'])) ? $stage['start_date']: ''; ?> <br>
                  <?php echo (isset($stage['days'])) ? 'Days: '.$stage['days'].'' : ''; ?> 
                  </small>      
                </button>
                <!-- &nbsp;  -->
            </div>
          <?php } ?>
        </div>
    </div>
  </div>
</div>
<br>

<div class="row-fluid">
    <ul class="thumbnails">
      <li class="span6">
        <div class="thumbnail">
          <img alt="" src="/img/authenticated/preferences_composer.png">
          <div class="caption">
            <h4>Recent Protocols</h4>            
            <ol><?php
                 foreach($applications as $application) {
                    if($application['Application']['submitted']) {
                        $ndata = $application['Application']['study_drug'].' ('.$application['Application']['protocol_no'].')';
                        echo $this->Html->link('<li>'.$ndata.'</li>', array('controller' => 'applications', 'action' => 'view', $application['Application']['id']),
                            array('escape' => false, 'class' => 'text-success'));
                        ?>
                        <?php
                    } else {
                        $ndata = (!empty($application['Application']['study_drug'])   ? $application['Application']['study_drug'] : date('d-m-Y h:i a', strtotime($application['Application']['created'])) );
                        echo $this->Html->link('<li>'.$ndata.'</li>', array('controller' => 'applications', 'action' => 'edit', $application['Application']['id']),
                            array('escape' => false));                      
                    }
                    if ($application['Application']['submitted']) {
                      echo "<br>";
                      echo $this->Html->link('<i class="icon-list-alt"></i> Add SAE', array('controller' => 'saes', 'action' => 'add', $application['Application']['id'], 'sae'), 
                            array('escape' => false, 'class' => 'btn btn-success btn-mini')); 
                      echo "&nbsp;";
                      echo $this->Html->link('<i class="icon-credit-card"></i> Add SUSAR', array('controller' => 'saes', 'action' => 'add', $application['Application']['id'], 'susar'), 
                            array('escape' => false, 'class' => 'btn btn-primary btn-mini'));  
                      echo "&nbsp;";
                      echo $this->Html->link('<i class="icon-random"></i> Add Deviation', array('controller' => 'deviations', 'action' => 'add', $application['Application']['id']), 
                            array('escape' => false, 'class' => 'btn btn-warning btn-mini'));   
                      echo "&nbsp;";
                      echo $this->Html->link('<i class="icon-upload-alt"></i> Upload E2B CIOMS', array('controller' => 'cioms', 'action' => 'add', $application['Application']['id']), 
                            array('escape' => false, 'class' => 'btn btn-inverse btn-mini'));   
                    }
                    
                 }
                 ?>
            </ol>
            <br>
            <?php echo $this->Html->link('<i class="icon-link"></i> View All Applications', array('controller' => 'applications', 'action' => 'index'),
                    array('escape' => false, 'class' => 'btn'));?>
          </div>
        </div>

        <br>
        <div class="thumbnail">
            <div class="caption">               
                <h4>SAE / SUSAR</h4>
                <?php                   
                    echo '<ol>';
                    foreach ($saes as $sae) {
                      if($sae['Sae']['approved'] < 1) {
                          echo $this->Html->link('<li>'.$sae['Sae']['reference_no'].'</li>', array('controller' => 'saes', 'action' => 'edit', $sae['Sae']['id']),
                            array('escape' => false));   
                      } else {
                          echo $this->Html->link('<li>'.$sae['Sae']['reference_no'].'</li>', array('controller' => 'saes', 'action' => 'view', $sae['Sae']['id']),
                            array('escape' => false, 'class' => 'text-success'));   
                      }
                    }
                    echo '</ol>';
                ?>
            </div>
        </div>
      </li>
      <li class="span6">
        <div class="thumbnail">
          <img alt="" src="/img/authenticated/preferences_desktop_notification.png">
          <div class="caption">
            <h4>Notifications <small>Actions that require your attention.</small></h4>
            <!-- <dl class="notifications"> -->
            <?php
              echo $this->element('alerts/notifications', ['notifications' => $notifications]);
            ?>
            <!-- </dl> -->
          </div>
        </div>
      </li>
    </ul>
  </div>
 </section>
