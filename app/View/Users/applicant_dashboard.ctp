<?php
    $this->assign('Dashboard', 'active');
    $this->Html->script('dashboard', array('inline' => false));
    $this->Html->script('bootstrap-editable', array('inline' => false));
    $this->Html->css('bootstrap-editable', null, array('inline' => false));
?>
<section>
<div class="row-fluid">
    <ul class="thumbnails">
      <li class="span4">
        <div class="thumbnail">
          <img alt="" src="/img/authenticated/text.png">
          <div class="caption">
            <h4>New Application</h4>
            <?php
                echo $this->Form->create('Application');
                echo $this->Form->input('email_address', array('type' => 'email', 'value' => $this->Session->read('Auth.User.email')));
                echo $this->Form->end(array(
                    'label' => 'Create',
                    'value' => 'Create',
                    'class' => 'btn btn-success btn-large',
                    // 'div' => array(
                        // 'class' => 'form-actions',
                    // )
                ));
                // echo $this->Form->end(__('Submit'), array('class' => 'btn btn-large btn-success'));
            ?>
            <hr>
            <p><small><i class="icon-minus"></i> <span class="label label-info">NOTE!</span> Fields marked with <span class="sterix">*</span> are mandatory and your application will not be submitted to PPB without first completing them.</small></p>
            <p><small><i class="icon-minus"></i> Notifications will be sent to the email address entered above</small></p>

          </div>
        </div>
      </li>
      <li class="span4">
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
            <!-- Trial status start -->
                <small>
                 Trial Status: 
                  <?php
                    $assoc = array();
                    foreach ($trial_statuses as $i => $value) {
                            $assoc[] = array('value' => $i, 'text' => $value);
                    }
                    // print_r(json_encode($assoc));
                    if(!empty($application['Application']['trial_status_id'])) {
                  ?>
                  <span class="xeditable tiptip" data-type="select" data-name="data[Application][trial_status_id]"
                          data-url="/applicant/applications/view/<?php echo $application["Application"]["id"];?>"
                          data-pk="<?php echo $application['Application']['id'];?>"
                          data-original-title="Update trial status">                                          
                    <?php  echo $trial_statuses[$application['Application']['trial_status_id']]; ?>
                  </span>
                  <?php
                    }
                    else { 
                  ?>                      
                      <span class="xeditable tiptip" data-type="select" data-name="data[Application][trial_status_id]"
                          data-url="/applicant/applications/view/<?php echo $application["Application"]["id"];?>"
                          data-pk="<?php echo $application['Application']['id'];?>"
                          data-original-title="Update trial status">
                      <em>&laquo;(click to set!)&raquo;</em>
                    </span>
                  <?php
                    }
                  ?>
                </small>
            <!-- Trial Status end -->
                        <?php
                    } else {
                        $ndata = (!empty($application['Application']['study_drug'])   ? $application['Application']['study_drug'] : date('d-m-Y h:i a', strtotime($application['Application']['created'])) );
                        echo $this->Html->link('<li>'.$ndata.'</li>', array('controller' => 'applications', 'action' => 'edit', $application['Application']['id']),
                            array('escape' => false));                      
                    }
                    if ($application['Application']['submitted']) {
                      echo "<br>";
                      echo $this->Html->link('<i class="icon-list-alt"></i> Create SAE', array('controller' => 'saes', 'action' => 'add', $application['Application']['id'], 'sae'), 
                            array('escape' => false, 'class' => 'btn btn-success btn-mini')); 
                      echo "&nbsp;";
                      echo $this->Html->link('<i class="icon-credit-card"></i> Create SUSAR', array('controller' => 'saes', 'action' => 'add', $application['Application']['id'], 'susar'), 
                            array('escape' => false, 'class' => 'btn btn-primary btn-mini'));   
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
                    // echo $this->Form->create('Sae', array('controller' => 'saes', 'action' => 'add'));
                    // echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                    // echo $this->Form->input('email_address', array('type' => 'email', 'value' => $this->Session->read('Auth.User.email')));
                    // echo $this->Form->button('<i class="icon-list-alt"></i> Create SAE', array(
                    //   'name' => 'createSAE',
                    //   'class' => 'btn btn-success btn-small',
                    //   'id' => 'SaeCreate', 
                    //   'div' => false,
                    // ));
                    // echo "&nbsp;";
                    // echo $this->Form->button('<i class="icon-credit-card"></i> Create SUSAR', array(
                    //   'name' => 'createSUSAR',
                    //   'class' => 'btn btn-primary btn-small',
                    //   'id' => 'SusarCreate', 
                    //   'div' => false,
                    // ));
                    // echo $this->Form->end();
                    echo '<ol>';
                    foreach ($saes as $sae) {
                      if($sae['Sae']['approved'] < 1) {
                          echo $this->Html->link('<li>'.$sae['Sae']['reference_no'].'</li>', array('controller' => 'saes', 'action' => 'edit', $sae['Sae']['id']),
                            array('escape' => false));   
                      } else {
                          echo $this->Html->link('<li>'.$sae['Sae']['reference_no'].'</li>', array('controller' => 'saes', 'action' => 'view', $sae['Sae']['id']),
                            array('escape' => false));   
                      }
                    }
                    echo '</ol>';
                ?>
            </div>
        </div>
      </li>
      <li class="span4">
        <div class="thumbnail">
          <img alt="" src="/img/authenticated/preferences_desktop_notification.png">
          <div class="caption">
            <h4>Notifications <small>Actions that require your attention.</small></h4>
            <!-- <dl class="notifications"> -->
            <?php
                // pr($notifications);
                
            ?>
            <!-- </dl> -->
          </div>
        </div>
      </li>
     <!--  <li class="span3">
        <div class="thumbnail">
          <img alt="" src="/img/authenticated/beos_query.png">
          <div class="caption">
            <h3>Queries</h3>
            <p>Respond to queries raised by reviewers below</p>
          </div>
        </div>
      </li> -->
    </ul>
  </div>
 </section>


<script text="type/javascript">
$.fn.editable.defaults.mode = 'popup';
$(function() {
  //$('#data\\[Application\\]\\[approval_date\\] ,  #data\\[Application\\]\\[date_submitted\\]').editable({
  $('.xeditable').editable({
      //url: '/admin/applications/view/<?php echo $application["Application"]["id"];?>',
      ajaxOptions: {
           dataType: 'json' //assuming json response
      },
      value: <?php if(isset($application['Application']['trial_status_id'])) echo $application['Application']['trial_status_id'] ;
                   else echo 0; ?>,
      source: <?php echo json_encode($assoc);?>,
      params: function(params) {
        var data = {};
        data['_method'] = 'POST';
        data['data[Application][id]'] = params.pk;
        data[params.name] = params.value;
        return data;
      }
    });

});
</script>