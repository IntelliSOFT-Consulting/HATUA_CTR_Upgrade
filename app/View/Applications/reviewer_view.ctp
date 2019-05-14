<?php
  $this->extend('/Elements/application/applicant_view');
?>

<?php $this->start('amendment-lead'); ?>
<?php
      $this->assign('Applications', 'active');
      $this->Html->script('ckeditor/ckeditor', array('inline' => false));
      $this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
    ?>
    <div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
      <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Application</a></li>
          <li><a href="#tab2" data-toggle="tab">My Reviews <small>(<?php echo count($application['Review']);?>)</small></a></li>
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
 <!-- content for form actions -->
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
  <li><a href="#tabs-15">15. Annual Approval</a></li>
</ul>
<?php $this->end(); ?>

<!-- START RIGHTBAR -->
<?php $this->start('view-rightbar'); ?>
  </div>
  <div class="span2">
    <div class="form-actions"  style="margin-top: 0px; margin-bottom: 0px; padding-left: 10px;">
    <?php
       echo $this->Html->link(__('<i class="icon-download-alt"></i> <br> <span><strong>Download PDF</strong></span>'),
              array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
              array('escape' => false, 'class' => 'btn pull-right', 'style'=>'margin-right: 10px;'));
    ?>
  </div>
</div>
<?php $this->end();  ?>
<!-- END RIGHTBAR -->

<?php $this->start('endjs'); ?>
  </div> <!-- End or bootstrab tab1 -->
    <div class="tab-pane" id="tab2">
        <div class="marketing">
             <div class="row-fluid">
                <div class="span12">
                   <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
                   <h3 class="text-info" style="text-decoration: underline;">Reviewer's Comments Form</h3>
                </div>
             </div>
              <hr class="soften" style="margin: 10px 0px;">
        </div>
        <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <p><strong>2. Protocol title: </strong><?php echo $application['Application']['study_title'];?></p>
        <div class="row-fluid">
          <div class="span8">
          <?php
             echo $this->Form->create('Review', array('url' => array('controller' => 'reviews', 'action' => 'add', $application['Application']['id'])));
                $counter = 0;

                echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                echo $this->Form->input('text', array('type' => 'textarea', 'rows' => 3,
                  'label' => array('class' => 'required','text' => '3. Reviewer\'s Comment(s)')));
                echo $this->Form->input('recommendation', array('type' => 'textarea', 'rows' => 3,
                  'label' => array('class' => 'required', 'text' => '4. Reviewer\'s recommendation(s)')));
                echo $this->Form->input('password', array('type' => 'password', 'label' => 'Your Password *'));
                echo $this->Form->end(array(
                        'label' => 'Submit Review',
                        'value' => 'SubmitReviews',
                       'class' => 'btn btn-success',
                  ));
            ?>
          </div>
          <div class="span4">
            <h4 class="text-success">My Previous Comments <small>(<?php echo count($application['Review']);?>)</small></h4>
            <?php
                foreach ($application['Review'] as $review) {
                   $counter++;
                   echo "<hr><span class=\"badge badge-success\">".$counter."</span> <small class='muted'>created on: ".date('d-m-Y H:i:s', strtotime($review['created']))."</small>";
                   echo "<div style='padding-left: 29px;' class='morecontent'>".$review['text']."</div>";
                   // echo "<br>";
                   echo "<div style='padding-left: 29px;' class='morecontent'>".$review['recommendation']."</div>";
                }
            ?>
          </div>
       </div>
    </div>
</div>
</div>

<script text="type/javascript">
$.expander.defaults.slicePoint = 170;
$(function() {
  $( "#tabs" ).tabs({
      cookie: {
        expires: 1
      }
  });
  $(".morecontent").expander();
  $('#ReviewText').ckeditor();
  $('#ReviewRecommendation').ckeditor();
});
</script>
<?php $this->end();?>