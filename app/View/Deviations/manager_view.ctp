<?php
    $this->assign('DEV', 'active');        
    echo $this->Session->flash();
?>

<ul id="devs_tab" class="nav nav-tabs">
  <li class="active"><a href="#deviation_form">Deviation/Violation</a></li> 
  <li><a href="#external_comments">Feedback (<?php echo count($deviation['ExternalComment']); ?>)</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="deviation_form">
    <?php 
      echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                    array('controller' => 'deviations', 'ext' => 'pdf', 'action' => 'download_deviation', $deviation['Deviation']['id']),
                    array('escape' => false, 'class' => 'btn btn-primary'));
      echo $this->element('application/deviation_view', array('deviation' => $deviation['Deviation'])); 
    ?>
  </div>

  <div class="tab-pane" id="external_comments">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <br>
          <div class="amend-form">
            <h5 class="text-center"><u>FEEDBACK/QUERIES</u></h5>
            <div class="row-fluid">
              <div class="span8">    
                <?php echo $this->element('comments/list', ['comments' => $deviation['ExternalComment']]) ?> 
              </div>
              <div class="span4 lefty">
              <?php  
                    echo $this->element('comments/add', [
                               'model' => ['model_id' => $deviation['Deviation']['id'], 'foreign_key' => $deviation['Deviation']['id'],   
                                           'model' => 'Deviation', 'category' => 'external', 'url' => 'add_dev_external']]) 
              ?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>


<script text="type/javascript">
$(function() {
    //https://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
    //from mcaz
    $('#devs_tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#devs_tab a').on("shown", function (e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('ciomsTab', id)
    });

    var ciomsTab = localStorage.getItem('ciomsTab');
    if (ciomsTab != null) {
        $('#devs_tab a[href="' + ciomsTab + '"]').tab('show');
    }

    var hashTab = $('#devs_tab a[href="' + location.hash + '"]');
    hashTab && hashTab.tab('show');
    //end mcaz
});
</script>