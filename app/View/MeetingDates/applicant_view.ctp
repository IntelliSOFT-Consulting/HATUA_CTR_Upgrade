<?php
    $this->assign('MEETINGS', 'active');        
    echo $this->Session->flash();
?>

<ul id="mds_tab" class="nav nav-tabs">
  <li class="active"><a href="#meetingDate_form">PRE-SUBMISSION MEETINGS</a></li> 
  <li><a href="#external_md_comments">PPB Feedback (<?php echo count($meetingDate['Comment']); ?>)</a></li>
  <li><a href="#final_decision">PPB Final Decision</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="meetingDate_form">
    <?php 
      echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                    array('controller' => 'meetingDates', 'ext' => 'pdf', 'action' => 'view', $meetingDate['MeetingDate']['id']),
                    array('escape' => false, 'class' => 'btn btn-primary'));
      echo "&nbsp;";

      echo "<br>";
      echo $this->element('pockets/meetingDates_view'); 
    ?>
  </div>

  <div class="tab-pane" id="external_md_comments">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <br>
          <div class="amend-form">
            <h5 class="text-center"><u>FEEDBACK</u></h5>
            <div class="row-fluid">
              <div class="span8">    
                <?php echo $this->element('comments/list', ['comments' => $meetingDate['Comment'],'show'=>false]) ?> 
              </div>
              <div class="span4 lefty">
              <?php  
                    echo $this->element('comments/add', [
                               'model' => ['model_id' => $meetingDate['MeetingDate']['id'], 'foreign_key' => $meetingDate['MeetingDate']['id'],   
                                           'model' => 'MeetingDate', 'category' => 'external', 'url' => 'add_meeting_date_external']]) 
              ?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="tab-pane" id="final_decision">
    <div class="row-fluid">
      <div class="span12">
          <h3>Final Decision</h3>
          <?php  echo $meetingDate['MeetingDate']['final_decision']; ?>
        </div>
    </div>
  </div>
</div>


<script text="type/javascript">
$(function() {
    //https://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
    //from mcaz
    $('#mds_tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#mds_tab a').on("shown", function (e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('mdsTab', id)
    });

    var mdsTab = localStorage.getItem('mdsTab');
    if (mdsTab != null) {
        $('#mds_tab a[href="' + mdsTab + '"]').tab('show');
    }

    var hashTab = $('#mds_tab a[href="' + location.hash + '"]');
    hashTab && hashTab.tab('show');
    //end mcaz
});
</script>