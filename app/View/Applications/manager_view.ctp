<?php
  $this->extend('/Elements/application/applicant_view');
?>

<?php $this->start('amendment-lead'); ?>
<?php
      $this->assign('Applications', 'active');
      $this->Html->script('ckeditor/ckeditor', array('inline' => false));
      $this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
      $this->Html->script('jquery.blockUI.js', array('inline' => false));
    ?>
    <div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
      <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Application</a></li>
          <?php
              $count_reviews = 0;
              $count_comments = 0;
              $my_reviews = 0;
               foreach ($application['Review'] as $review) {
                    if($review['type'] == 'request' && $review['accepted'] != 'declined') {
                      $count_reviews++;
                    }
                    if ($review['type'] == 'reviewer_comment') {
                      $count_comments++;
                    }
                    if($review['type'] == 'ppb_comment') {
                      $my_reviews++;
                    }
               }
          ?>
          <li><a href="#tab2" data-toggle="tab">Assigned Reviewers <small>(<?php echo $count_reviews;?>)</small></a></li>
          <li><a href="#tab3" data-toggle="tab">Reviewer Comments  <small>(<?php echo $count_comments; ?>)</small></a></li>
          <li><a href="#tab4" data-toggle="tab">My Reviews <small>(<?php echo $my_reviews; ?>)</small></a></li>
          <li><a href="#tab5" data-toggle="tab">Approve / Reject <small>(<?php
                   if($application['Application']['approved'] == 2) echo 'Approved';
                   elseif($application['Application']['approved'] == 1) echo 'Rejected';
                   ?>)</small></a></li>
          <?php
              echo  '<li><a href="#tab6" data-toggle="tab">Site Inspections</a></li>';
          ?>
      </ul>
      <div class="tab-content my-tab-content">
        <div class="tab-pane active" id="tab1">
          <!-- content for tab1 comes here -->

  <div class="row-fluid">
    <?php if($application['Application']['submitted'] == 1 ) { ?>
      <h4 class="text-success">
       Submitted Application :  (<?php echo $application['Application']['protocol_no'];?>) &mdash;
       <small> Created on:
        <?php
         echo date('d-m-Y h:i:s a', strtotime($application['Application']['created']));
       ?>
      </small>
      </h4>
    <?php } else { ?>
      <h4 class="text-success">
        UnSubmitted Application :  &mdash; <small> Created on:
        <?php
         echo date('d-m-Y h:i:s a', strtotime($application['Application']['created']));
       ?>
      </small>
      </h4>
    <?php } ?>
  </div>
<?php $this->end();?>


<?php $this->start('form-header'); ?>
  <div class="span10">
  <?php
      echo $this->Form->create('Application', array(
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
      echo $this->Form->input('id');
    ?>
<?php $this->end();?>

<?php
  $this->start('form-actions');
?>

<?php
  $this->end();
?>

<?php $this->start('tabs'); ?>
<ul>
  <li><a href="#tabs-1">1. Abstract</a></li>
  <li><a href="#tabs-2">2. Investigator</a></li>
  <li><a href="#tabs-3">3. Sponsor</a></li>
  <li><a href="#tabs-4">4. Participants</a></li>
  <li><a href="#tabs-5">5. Sites</a></li>
  <li><a href="#tabs-6">6. Placebo</a></li>
  <li><a href="#tabs-7">7. Criteria</a></li>
  <li><a href="#tabs-8">8. Scope</a></li>
  <li><a href="#tabs-9">9. Design</a></li>
  <li><a href="#tabs-10">10. Organizations</a></li>
  <li><a href="#tabs-11">11. Other details</a></li>
  <li><a href="#tabs-12">12. Checklist </a></li>
  <li><a href="#tabs-13">13. Declaration</a></li>
  <li><a href="#tabs-14">14. Notifications</a></li>
  <li><a href="#tabs-15" style="color: #52A652;">15. Annual Approval</a></li>
  <li><a href="#tabs-16" style="color: #52A652;">16. Final Study Report</a></li>
</ul>
<?php $this->end(); ?>


<?php $this->start('view-rightbar'); ?>
</div>
<div class="span2">
    <?php
        if($application['Application']['submitted'] == 1) {
      ?>
      <div class="well">
        <?php
           echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                  array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
                  array('escape' => false, 'class' => 'btn'));
           echo "<hr>";
           if(!$application['Application']['deactivated']) echo $this->Form->postLink(__('Deactivate'), array('action' => 'deactivate', $application['Application']['id']), array('escape' => false, 'class' => 'btn btn-warning'), __('Are you sure you want to Deactivate Application # %s? The applicant will not be able to amend it.', $application['Application']['id']));
           else  echo $this->Form->postLink(__('Reactivate'), array('action' => 'deactivate', $application['Application']['id'], 0), array('escape' => false, 'class' => 'btn btn-success'), __('Are you sure you want to Reactivate Application # %s? The applicant will now be able to amend it.', $application['Application']['id']));
           echo "<hr>";

           echo $this->Form->postLink(__('<i class="icon-trash"></i> Delete'), array('action' => 'delete', $application['Application']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete Application # %s? You will not be able to recover it later.', $application['Application']['id']));

            if ($application['Application']['approved'] == 2) {
               echo "<hr>";                
               echo $this->Html->link(__('<i class="icon-search"></i> Site Inspection'),
                      array('controller' => 'site_inspections', 'action' => 'add', $application['Application']['id']),
                      array('escape' => false, 'class' => 'btn btn-info'));
            }

           ?>
      </div>
      <?php
        }
      ?>
</div>
  <?php $this->end();  ?>

<?php $this->start('endjs'); ?>
</div> <!-- End or bootstrab tab1 -->
    <div class="tab-pane" id="tab2">
        <p style="text-align: center;"><strong>Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <hr class="soften" style="margin: 10px 0px;">
        <div class="row-fluid">
          <h4 class="text-success">Assigned Reviewers (<?php echo $count_reviews;?>)</h4>
            <hr>
            <div class="span12">
            <?php
               echo $this->Form->create('Review',
                array('url' => array('controller' => 'reviews', 'action' => 'add', $application['Application']['id'])));
                  $counter = 0;
                  echo "<ol>";
                   foreach ($users as $user_id => $user) {
                    echo "<li>";
                       $responded = false;
                       foreach ($application['Review'] as $response) {
                         if($response['user_id'] == $user_id) {
                            if($response['type'] == 'request' && $response['accepted'] == '') {
                               $responded = true;
                               echo '<p class="text-info"><i class="icon-check-empty"> </i> '.$user.'.
                               <small class="muted">(Notified but no response yet. 
                                <a class="ResendReview tiptip" href="#" id="'.$response['id'].'" title="Resend Notification?">Resend?</a>)</small> </p>';
                            } elseif($response['type'] == 'request' && $response['accepted'] == 'accepted') {
                              $responded = true;
                              echo '<p class="text-success"><i class="icon-check"> </i> '.$user.' <small class="muted">(Accepts)</small> <i class="icon-minus"> </i> '.$response['recommendation'].'</p>';
                              // echo '<p><i class="icon-minus"> </i> '.$response['text'].'</p>';
                            } elseif ($response['type'] == 'request' && $response['accepted'] == 'declined') {
                              $responded = true;
                              echo '<p class="text-error"><i class="icon-remove"> </i> '.$user.' <small class="muted">(Declines)</small> <i class="icon-minus"> </i> '.$response['recommendation'].'</p>';
                            }
                         }
                       }

                      if (!$responded) {
                          echo '<label class="checkbox" style="color: #333333">';
                          echo $this->Form->checkbox($counter.'.Review.user_id', array('hiddenField' => false, 'value' => $user_id));
                          echo $user;
                          echo '</label>';
                         // echo $this->Form->input('Reviewer.'.$counter.'.application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                      }
                      $counter++;
                      echo "</li>";
                   }
                  echo "</ol>";
                echo $this->Form->input('Message.text', array('type' => 'textarea', 'rows' => 3, 'label' => 'Message'));
                echo $this->Form->end(array(
                        'label' => 'Assign',
                        'value' => 'Assign',
                       'class' => 'btn btn-success',
                  ));
            ?>
       </div>
       </div>
    </div>

    <div class="tab-pane" id="tab3">
        <p style="text-align: center;"><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <hr class="soften" style="margin: 10px 0px;">
        <div class="row-fluid">
          <h4 class="text-success">Reviewer Comments (<?php echo $count_comments; ?>)</h4>
            <hr>
            <div class="span12">
            <?php
                  $counter = 0;
                  foreach ($users as $user_id => $user) {
                       $responded = false;

                       foreach ($application['Review'] as $response) {
                        // pr($response);
                         if($response['user_id'] == $user_id) {
                            if($response['type'] == 'request' && $response['accepted'] == 'accepted') {
                              $responded = true;
                              echo '<h4 style="text-decoration: underline"><i class="icon-check"> </i> '.$user.'</h4>';
                              echo '<p style="padding-left: 29px;"><i class="icon-minus"> </i> '.$response['recommendation'].'</p>';
                            }

                            if ($response['type'] == 'reviewer_comment') {
                              echo "<small  style='padding-left: 29px;' class='muted'>created on: ".date('d-m-Y H:i:s', strtotime($response['created']))."</small>";
                              echo "<div style='padding-left: 29px;' class='morecontent'> <i class='icon-comment-alt'></i>
                                          <strong>Comment</strong><br>".$response['text']."</div>";
                              echo "<div style='padding-left: 29px;' class='morecontent'> <i class=\"icon-comment-alt\"></i>
                                          <strong>Recommendation</strong><br>".$response['recommendation']."</div><hr>";

                            }
                         }
                       }
                      $counter++;
                  }
            ?>
       </div>
       </div>
    </div>

    <div class="tab-pane" id="tab4">
        <div class="marketing">
             <div class="row-fluid">
                <div class="span12">
                   <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
                   <h3 class="text-info" style="text-decoration: underline;">PPB Manager's Comments Form</h3>
                </div>
             </div>
              <hr class="soften" style="margin: 10px 0px;">
        </div>
        <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <p><strong>2. Protocol title: </strong><?php echo $application['Application']['study_title'];?></p>
        <div class="row-fluid">
          <div class="span8">
          <?php
             echo $this->Form->create('Review', array('url' => array('controller' => 'reviews',
              'action' => 'comment', $application['Application']['id'])));


                echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                echo $this->Form->input('text', array('type' => 'textarea', 'rows' => 3,
                  'label' => array('class' => 'required','text' => '3. Manager\'s Comment(s)')));
                echo $this->Form->input('recommendation', array('type' => 'textarea', 'rows' => 3,
                  'label' => array('class' => 'required', 'text' => '4. Manager\'s recommendation(s)')));
                echo $this->Form->input('password', array('type' => 'password', 'label' => 'Your Password *'));
                echo $this->Form->end(array(
                        'label' => 'Submit Review',
                        'value' => 'SubmitReviews',
                       'class' => 'btn btn-success',
                  ));
            ?>
          </div>
          <div class="span4">
            <h4 class="text-success">My Previous Comments  <small>(<?php echo $my_reviews; ?>)</small></h4>
            <?php
              $counter = 0;
              // pr($this->Session->read('Auth.User.id'));
                foreach ($application['Review'] as $review) {
                  // PPB Manager should be able to see all manager's comments
                  if ($review['type'] == 'ppb_comment') {
                     $counter++;
                     echo "<hr><span class=\"badge badge-success\">".$counter."</span> <small class='muted'>
                                created on: ".date('d-m-Y H:i:s', strtotime($review['created']))."</small>";
                     echo "<div style='padding-left: 29px;' class='morecontent'>".$review['text']."</div>";
                     echo "<div style='padding-left: 29px;' class='morecontent'>".$review['recommendation']."</div>";
                  }
                }
            ?>
          </div>
       </div>
    </div>

    <div class="tab-pane" id="tab5">
        <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <p><strong>2. Study Title: </strong><?php echo $application['Application']['study_title'];?></p>
        <hr class="soften" style="margin: 10px 0px;">
        <div class="row-fluid">
          <div class="span12">
            <?php
                if ($application['Application']['approved'] == 2) {
                   echo "<h2> Approved <h2>";
               } elseif($application['Application']['approved'] == 1) {
                    echo "<h2>Rejected</h2>";
                } else {
            ?>
              <h4 class="text-success">Approve or Reject application <span class="muted">:if no, the application is rejected</span></h4>
              <hr>
            <?php
                  echo $this->Form->create('Application', array(
                        'url' => array('action' => 'approve', $application['Application']['id']),
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
                  echo $this->Form->input('id', array('value' => $application['Application']['id'], 'type' => 'hidden'));
                  echo $this->Form->input('approval_date', array('value' => date('d-m-Y'), 'type' => 'hidden'));

                  echo $this->Form->input('approved', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                      'class' => 'approved',
                      'before' => '<div class="control-group">   <label class="control-label required">
                        Approve? <span class="sterix">*</span></label>  <div class="controls">
                        <input type="hidden" value="" id="ApplicationApproved_" name="data[Application][approved]"> <label class="radio inline">',
                      'after' => '</label>',
                      'options' => array(2 => 'Yes'),
                    ));
                    echo $this->Form->input('approved', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'class' => 'approved',
                      'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                      'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                      'before' => '<label class="radio inline">',
                      'after' => '</label>
                            <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                            onclick="$(\'.approved\').removeAttr(\'checked disabled\')">
                            <em class="accordion-toggle">clear!</em></a> </span>
                            </div> </div>',
                      'options' => array(1 => 'No'),
                    ));

                  echo $this->Form->input('approved_reason', array(
                    'label' => array('class' => 'control-label', 'text' => 'Message'),
                    'placeholder' => ' ' , 'class' => 'input-xlarge',  'rows' => '3'
                  ));
                  echo $this->Form->input('password', array(
                    'label' => array('class' => 'control-label', 'text' => 'Your Password <span class="sterix">*</span>'),
                    'placeholder' => 'password' , 'class' => 'input-large',
                  ));
              ?>
              <div class="controls">
              <?php
                echo $this->Form->button('<i class="icon-save"></i> Submit', array(
                    'name' => 'submit',
                    'onclick' => '$(\'#ApplicationEditForm\').validate().cancelSubmit = true;',
                    'class' => 'btn btn-primary',
                    'id' => 'SadrSaveChanges',
                  ));
                ?>
              </div>
              <?php
                  echo $this->Form->end();
                }
               ?>
       </div>
       </div>
    </div>

    <div class="tab-pane" id="tab6">   
      <div class="row-fluid">
        <div class="span12">


          <h2 style="text-align: center;"> AVAREF</h2>   
          <hr class="soften" style="margin: 10px 0px;">
          <?php
            foreach ($application['SiteInspection'] as $site_inspection) {
          ?>

          <?php
            echo $this->Form->create('SiteInspection', array(
                  'url' => array('controller' => 'site_inspections','action' => 'edit', $site_inspection['id']),
                  'type' => 'file',
                  'class' => 'form-inline',
                  'inputDefaults' => array(
                    // 'div' => array('class' => 'control-group'),
                    'label' => array('class' => 'control-label'),
                    // 'between' => '<div class="controls">',
                    // 'after' => '</div>',
                    'class' => '',
                    'format' => array('before', 'label', 'between', 'input', 'after','error'),
                    'error' => array('attributes' => array( 'class' => 'controls help-block')),
                   ),
            ));
            // echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
            echo $this->Form->input('id', array('value' => $site_inspection['id'], 'type' => 'hidden'));
          ?>

          <h3>Part 1: General Information</h3>

            <table class="table table-bordered">
              <tbody>
                  <tr>
                    <th class="my-well">Study Title</th>
                    <td><?php echo $site_inspection['study_title'];?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Protocol number and version</th>
                    <td><?php echo $site_inspection['protocol_no'];?><br/><?php echo $site_inspection['version_no'];?></td>
                  </tr>
                  <tr>
                    <th class="my-well">PACTR Registration number</th>
                    <td><?php echo $this->Form->input('pactr_number', array('label' => false)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Phase of trial</th>
                    <td><?php echo $this->Form->input('trial_phase', array('label' => false)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Investigator(s)</th>
                    <td><?php echo $this->Form->input('investigators', array('label' => false, 'rows' => 2)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Co-investigator(s)</th>
                    <td><?php echo $this->Form->input('co_investigators', array('label' => false, 'rows' => 2)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Stage of study inspected:</th>
                    <td>
                      <?php
                          echo $this->Form->input('study_stage',
                                array('type' => 'select', 'empty' => false,
                                  'options' =>  array('Before trial commencement' => 'Before trial commencement', 'During clinical conduct' => 'During clinical conduct', 
                                                      'After completion of trial' => 'After completion of trial'), 
                                  'label' => false));
                      ?>                      
                    </td>
                  </tr>
                  <tr>
                    <th class="my-well">Country where the study is inspected</th>
                    <td><?php echo $this->Form->input('inspection_country', array('label' => false, 'rows' => 2)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Names of Inspectors, and countries represented</th>
                    <td><?php echo $this->Form->input('inspector_names', array('label' => false, 'rows' => 2)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Date of Inspection</th>
                    <td><?php echo $this->Form->input('inspection_date', array('label' => false)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Name and address of the clinical site</th>
                    <td><?php echo $this->Form->input('site_address', array('label' => false, 'rows' => 2)); ?></td>
                  </tr>
                  <tr>
                    <th class="my-well">Name and address of laboratories (clinical, bio-analytical)</th>
                    <td><?php echo $this->Form->input('lab_address', array('label' => false, 'rows' => 2)); ?></td>
                  </tr>
              </tbody>
            </table>
              <table class="table table-bordered table-condensed">
              <thead><th></th><th></th><th width="20%"></th><th></th></thead>
              <tbody>
                  <?php
                  // foreach ($site_inspection['SiteAnswer'] as $site_answer) { 
                  for ($i = 0; $i <= count($site_inspection['SiteAnswer'])-1; $i++) {
                      echo $this->Form->input('SiteAnswer.'.$i.'.id', array('type' => 'hidden', 'value' => $site_inspection['SiteAnswer'][$i]['id']));
                      echo $this->Form->input('SiteAnswer.'.$i.'.site_inspection_id', array('type' => 'hidden', 'value' => $site_inspection['id']));
                      if ($site_inspection['SiteAnswer'][$i]['question_type'] == 'section') {
                           echo "<tr class='success'><td colspan='4'><strong>".$site_inspection['SiteAnswer'][$i]['question']."</strong></td></tr>";                     
                      } elseif ($site_inspection['SiteAnswer'][$i]['question_type'] == 'comment') {
                          echo "<tr><td colspan='2'>"; 
                              echo $this->Form->input('SiteAnswer.'.$i.'.comment', array('label' => false, 'rows' => 1));
                              echo '</td>';
                          echo "<td colspan='2'>"; 
                             echo $this->Form->input('SiteAnswer.'.$i.'.finding',
                              array('type' => 'select', 'empty' => true,
                                'options' =>  array('major' => 'major', 'minor' => 'minor', 'critical' => 'critical'), 
                                'label' => false));
                          echo "</td></tr>"; 
                      } else {                    
                           echo "<tr><td>".$site_inspection['SiteAnswer'][$i]['question_number']."</td>";   
                              echo "<td>".$site_inspection['SiteAnswer'][$i]['question']."</td>"; 
                              echo "<td>";
                              echo $this->Form->input('SiteAnswer.'.$i.'.answer', array(
                                'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                                'class' => 'answer',
                                'before' => '
                                  <input type="hidden" value="" id="ApplicationApproved_" name="data[SiteInspection][0][SiteAnswer][answer]"> <label class="radio inline">',
                                'after' => '</label>',
                                'options' => array(2 => 'Yes'),
                              ));                          
                              echo $this->Form->input('SiteAnswer.'.$i.'.answer', array(
                                'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'class' => 'answer',
                                'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                                'before' => '<label class="radio inline">',
                                'after' => '</label>
                                      <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                                      onclick="$(\'.answer\').removeAttr(\'checked disabled\')">
                                      <em class="accordion-toggle">clear!</em></a> </span>
                                     ',
                                'options' => array(1 => 'No'),
                              ));
                              echo "</td>";
                              echo "<td>";
                              echo $this->Form->input('SiteAnswer.'.$i.'.comment', array('label' => false, 'rows' => 1));
                              echo '</td></tr>';
                      }
                  }

                  ?>     
               </tbody>        
              </table>
                  <div class="controls">
                  <?php
                    echo $this->Form->button('<i class="icon-save"></i> Submit', array(
                        'name' => 'submit',
                        'class' => 'btn btn-primary'
                      ));
                    ?>
                  </div>
                  <?php
                      echo $this->Form->end();
                   ?>   
          </div>
        </div>
      <?php
        }
      ?>
    </div>


</div>
</div>

<script text="type/javascript">
$.expander.defaults.slicePoint = 170;
$(function() {
  $(document).ajaxStop($.unblockUI);
  $( "#tabs" ).tabs({
      cookie: {
        expires: 1
      }
  });
  $(".morecontent").expander();
  $('#ReviewText').ckeditor();
  $('#ReviewRecommendation').ckeditor();

  $('.ResendReview').on('click',  function() {
    // console.log($(this).serialize())
      var data_save = new Array();
      var aindi = $(this).attr('id');
      data_save.push({ name: "data[Review][id]", value: aindi});
      $.ajax({
          url     : '/manager/notifications/resend/'+aindi,
          type    : 'put',
          dataType: 'json',
          data    : data_save,
          beforeSend: function () {
              $.blockUI({
              css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
                  },
              message: '<p class="lead"><span><i class="icon-spinner icon-spin"></i> Please wait... </span></p>'
             });
          },
          success : function( data ) {
                alert('Notification has been resent!');
          },
          error   : function( xhr, err ) {
                alert('Error: Could not resend notification. Contact administrator.');
          }
      });
      return false;
  });
});
</script>
<?php $this->end();?>
