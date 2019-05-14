<?php
  $this->extend('/Elements/application/applicant_view');
?>

<!-- START AMENDMENT LEAD -->
<?php $this->start('amendment-lead'); ?>
<?php
      $this->assign('MyApplications', 'active');
      $this->Html->script('ckeditor/ckeditor', array('inline' => false));
      $this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
      $this->Html->script('jUpload/vendor/jquery.ui.widget.js', array('inline' => false));
      $this->Html->script('jUpload/jquery.iframe-transport.js', array('inline' => false));
      $this->Html->script('jUpload/jquery.fileupload.js', array('inline' => false));
      $this->Html->script('jquery.blockUI.js', array('inline' => false));
      $this->Html->script('bootstrap-editable', array('inline' => false));
      $this->Html->css('bootstrap-editable', null, array('inline' => false));
      //Only meant for applicant
      $this->Html->script('multi/approval', array('inline' => false));
      $this->Html->script('multi/documents', array('inline' => false));

      $reviewers_comments = 0;
     foreach ($application['Review'] as $review) {
          if($review['type'] == 'ppb_comment') {
            $reviewers_comments++;
          }
     }

     $this->assign('is-applicant', 'true');
    ?>
    <div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
      <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Application</a></li>
          <li><a href="#tab2" data-toggle="tab">Reviewers&rsquo; Comments  <small>(<?php echo $reviewers_comments;?>)</small></a></li>          
          <?php
              echo  '<li><a href="#tab6" data-toggle="tab">Site Inspections ('.count($application['SiteInspection']).')</a></li>';
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
<!-- ######## -->
<!-- START RIGHT BAR -->
<?php $this->start('view-rightbar'); ?>
</div>

  <?php $this->end();  ?>
<!-- ######## -->
<!-- FORM HEADER -->
<?php $this->start('form-header'); ?>
    <div class="span12">
  <?php
      echo $this->Form->create('Application', array(
            'type' => 'file',
            'class' => 'form-horizontal',
            'id' => 'fakeidshouldnotexist',
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
        echo $this->Form->input('id', array('value' => $application['Application']['id']));
    ?>
<?php $this->end();?>

<?php
$this->start('form-actions');
  if($application['Application']['submitted'] == 1) {
?>
<div class="form-actions"  style="margin-top: 0px; padding-left: 10px;">
	<?php
          $openAmendment = false;
          foreach ($application['Amendment'] as $key => $value) {
            if($value['submitted'] == 0) {
              $openAmendment = $value['id'];
              break;
            }
          }
          if($openAmendment) {
             echo $this->Html->link('<i class="icon-edit"></i> Edit Open Amendment',
               array('controller' => 'amendments', 'action' => 'edit', $openAmendment),
               array('escape' => false, 'class' => 'btn btn-success',  'style'=>'margin-right: 10px;'));
          } else {
             echo $this->Html->link('New Amendment',
           	   array('controller' => 'amendments', 'action' => 'add', $application['Application']['id']),
          	   array('escape' => false, 'class' => 'btn btn-primary', 'style'=>'margin-right: 10px;'));
          }

          echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
            array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
            array('escape' => false, 'class' => 'btn pull-right', 'style'=>'margin-right: 10px;'));

  ?>
</div>
<?php
  }
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
  <?php if ($application['Application']['approved'] == 2) { ?>
    <li><a href="#tabs-16" style="color: #52A652;">16. Final Study Report</a></li>
  <?php } ?>
</ul>
<?php $this->end(); ?>


<?php $this->start('endjs'); ?>
 </div> <!-- End or bootstrab tab1 -->
    <div class="tab-pane" id="tab2">
        <div class="marketing">
             <div class="row-fluid">
                <div class="span12">
                   <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
                   <h3 class="text-info" style="text-decoration: underline;">Reviewer's Comments</h3>
                </div>
             </div>
              <hr class="soften" style="margin: 10px 0px;">
        </div>
        <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no'];?></p>
        <p><strong>2. Protocol title: </strong><?php echo $application['Application']['study_title'];?></p>
        <div class="row-fluid">
          <div class="span12">
            <h4 class="text-success">Reviewer's Comments
              <?php
                echo $this->Html->link(__('<i class="icon-download-alt"></i> Download Comments <small>(PDF)</small>'),
                  array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
                  array('escape' => false, 'class' => 'btn pull-right', 'style'=>'margin-right: 10px;'));
                ?>
              </h4>
            <?php
                $counter = 0;
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

    <div class="tab-pane" id="tab6">   
      <div class="row-fluid">
        <div class="span12">

          <?php
            echo $this->element('/application/inspection_edit');
          ?>

          </div>
      </div>
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
    // var editor = $('#ApplicationFinalReport').ckeditor();
    var editor = CKEDITOR.editor.replace('ApplicationFinalReport');
    $(document).on('click', '#ApplicationViewSaveReport', function() {
          var data_save = $('#ApplicationId').serializeArray();
          //var value = $('#ApplicationFinalReport').val();
          data_save.push({ name: $('#ApplicationFinalReport').attr('name'), value: editor.getData() });

          $.ajax({
              url     : $('form').attr('action'),
              type    : $('form').attr('method'),
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
                    alert('Executive Summary saved!');
              },
              error   : function( xhr, err ) {
                    alert('Error: Could not save executive summary of the study. Kindly refresh the page.');
              }
          });
          return false;
      });
  $('#ApplicationTrialStatusId').on('change',  function() {
      // console.log($(this).serialize())
        var data_save = $('#ApplicationId').serializeArray();
        data_save.push({ name: $(this).attr('name'), value: $(this).val() });
        
        $.ajax({
            url     : $('form').attr('action'),
            type    : $('form').attr('method'),
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
                  alert('Status updated!');
            },
            error   : function( xhr, err ) {
                  alert('Error: Could not update the status of the trial. Please logout and login again.');
            }
        });
        return false;
    });
  // CKEDITOR.replace( 'data[Application][final_report]');
    $(document).on('click', '#ApplicationViewSaveShortTitle', function() {
          var data_save = $('#ApplicationId').serializeArray();
          //var value = $('#ApplicationFinalReport').val();
          data_save.push({ name: $('#ApplicationShortTitle').attr('name'), value: $('#ApplicationShortTitle').val() });

          $.ajax({
              url     : $('form').attr('action'),
              type    : $('form').attr('method'),
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
                    alert('Short title successfully saved!');
              },
              error   : function( xhr, err ) {
                    alert('Error: Could not save short title of the study. Kindly refresh the page.');
              }
          });
          return false;
      });
});
</script>
<?php $this->end();?>