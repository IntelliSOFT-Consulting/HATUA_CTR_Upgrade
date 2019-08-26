  
  <div class="marketing">
    <div class="row-fluid">
      <div class="span12">
         <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
         <!-- <h3 class="text-info" style="text-decoration: underline;">Reviewer's Comments Form</h3> -->
      </div>
    </div>
    <hr class="soften" style="margin: 10px 0px;">
  </div>

  <div class="row-fluid">
    <div class="span3">      
        <?php 
          echo $this->Html->link(__('<i class="icon-stethoscope"></i> Add Clinical Assessment'),
                    array('controller' => 'reviews', 'action' => 'add', $application['Application']['id'], 'clinical'),
                    array('escape' => false, 'class' => 'btn btn-primary'));
        ?>
    </div>
    <div class="span3">      
        <?php 
          echo $this->Html->link(__('<i class="icon-tint"></i> Add Non-Clinical Assessment'),
                    array('controller' => 'reviews', 'action' => 'add', $application['Application']['id'], 'non-clinical'),
                    array('escape' => false, 'class' => 'btn btn-success'));
        ?>
    </div>
    <div class="span3">      
        <?php 
          echo $this->Html->link(__('<i class="icon-medkit"></i> Add Quality Assessment'),
                    array('controller' => 'reviews', 'action' => 'add', $application['Application']['id'], 'quality'),
                    array('escape' => false, 'class' => 'btn btn-info'));
        ?>
    </div>
    <div class="span3">      
        <?php 
          echo $this->Html->link(__('<i class="icon-list-ol"></i> Add Statistical Assessment'),
                    array('controller' => 'reviews', 'action' => 'add', $application['Application']['id'], 'statistical'),
                    array('escape' => false, 'class' => 'btn btn-warning'));
        ?>
    </div>
  </div>
  <br>

  <br>
    <table class="table table-condensed table-bordered" style="margin-bottom: 2px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Recommendation</th>
          <th>Status</th>
          <th>Created</th>
          <th><?php echo __('Actions'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($application['Review'] as $akey => $rreview) {
        ?>
          <tr>
            <td><?php echo $rreview['id'] ?></td>
            <td><?php echo $rreview['recommendation'] ?></td>
            <td><?php echo $rreview['status'] ?></td>
            <td><?php echo $rreview['created'] ?></td> 
            <td>
              <?php
                
                if($rreview['status'] == 'Unsubmitted'){
                  echo $this->Html->link('<span class="label label-success"> Edit </span>',
                     array('action' => 'view', $application['Application']['id'], 'rreview_view' => $rreview['id']), array('escape'=>false));
                  echo "&nbsp;";
                } else {
                  echo $this->Html->link('<span class="label label-info"> View </span>',
                     array('action' => 'view', $application['Application']['id'], 'rreview_view' => $rreview['id']), array('escape'=>false));
                  echo "&nbsp;";
                }
                  

                  if (($redir == 'manager')) {                    
                      // echo $this->Form->postLink(__('<label class="label label-inverse">Unsubmit</label>'), array('controller' => 'rreviews', 'action' => 'unsubmit', $rreview['id']), array('escape' => false), __('Are you sure you want to unsubmit the rreview # %s? The applicant will be able to edit it.', $rreview['id']));
                  }          

              ?>                      
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>


  <br>
  <hr>

  <?php
  if(isset($this->params['named']['rreview_view']))  $cid = $this->params['named']['rreview_view'];

  if(isset($this->params['named']['rreview_view'])) {
    foreach ($application['Review'] as $akey => $rreview) {
      if ($rreview['id'] == $cid) {               
  ?>

  <ul id="rreview_tab" class="nav nav-tabs">
    <li class="active"><a href="#rreview_form">Assessment Form</a></li>
    <li><a href="#rreview_summary">Summary report</a></li>
    <li><a href="#rreview_comments">Comments (<?php echo count($rreview['InternalComment']); ?>)</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="rreview_form">
      <div style="position: relative; border-top: 1px solid #ddd;">
        <?php
          if($rreview['status'] == 'Unsubmitted') {
            echo $this->element('/application/rreview_edit', array('rreview' => $rreview, 'akey' => $akey));
          } else {
            echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                  array('controller' => 'reviews', 'ext' => 'pdf', 'action' => 'download_assessment', $rreview['id']),
                  array('escape' => false, 'class' => 'btn btn-small btn-info topright'));
            echo $this->element('/application/rreview_view', array('rreview' => $rreview, 'akey' => $akey));
          }
        ?>
      </div>
    </div>

    <div class="tab-pane" id="rreview_summary">
      <div style="position: relative; border-top: 1px solid #ddd;">        
        <?php
          echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                  array('controller' => 'reviews', 'ext' => 'pdf', 'action' => 'download_summary', $rreview['id']),
                  array('escape' => false, 'class' => 'btn btn-small btn-info topright'));
          echo $this->element('/application/rreview_summary', array('rreview' => $rreview, 'akey' => $akey));
        ?>
      </div>
    </div>
    
    <div class="tab-pane" id="rreview_comments">
      <div class="row-fluid">
          <div class="span12">
          <br>
            <div class="amend-form">
              <h5 class="text-center"><u>COMMENTS/QUERIES</u></h5>
              <div class="row-fluid">
                <div class="span8">    
                  <?php echo $this->element('comments/list', ['comments' => $rreview['InternalComment']]) ?> 
                </div>
                <div class="span4 lefty">
                  <?php  
                       echo $this->element('comments/add', [
                                // 'model' => ['model_id' => $rreview['id'], 'foreign_key' => $rreview['id'], 
                                'model' => ['model_id' => '1', 'foreign_key' => '1', 
                                            'model' => 'rreview', 'category' => 'external', 'url' => 'add_review_internal']]) 
                  ?>
                </div>
              </div>
            </div>
          </div><!--/span-->
      </div><!--/row-->
    </div>

  </div>
 
  <?php
        }
      }
    }
  ?>

<script text="type/javascript">
$.expander.defaults.slicePoint = 170;
$(function() {
    //https://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
    //from mcaz
    $('#rreview_tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#rreview_tab a').on("shown", function (e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('rreviewTab', id)
    });

    var rreviewTab = localStorage.getItem('rreviewTab');
    if (rreviewTab != null) {
        // console.log("select tab");
        // console.log($('#rreview_tab a[href="' + rreviewTab + '"]'));
        $('#rreview_tab a[href="' + rreviewTab + '"]').tab('show');
    }

    var hashTab = $('#rreview_tab a[href="' + location.hash + '"]');
    hashTab && hashTab.tab('show');
    //end mcaz
});
</script>