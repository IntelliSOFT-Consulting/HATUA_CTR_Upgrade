<?php
    $this->assign('SAE', 'active');        
    echo $this->Session->flash();
?>

<ul id="cioms_tab" class="nav nav-tabs">
  <li class="active"><a href="#sae_form">SAE/SUSAR</a></li> 
  <li><a href="#external_comments">Feedback (<?php echo count($sae['Comment']); ?>)</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="sae_form">
    <?php 
      echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                    array('controller' => 'saes', 'ext' => 'pdf', 'action' => 'view', $sae['Sae']['id']),
                    array('escape' => false, 'class' => 'btn btn-primary'));
      echo $this->element('application/sae_view'); 
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
                <?php echo $this->element('comments/list', ['comments' => $sae['Comment']]) ?> 
              </div>
              <div class="span4 lefty">
              <?php  
                    echo $this->element('comments/add', [
                               'model' => ['model_id' => $sae['Sae']['id'], 'foreign_key' => $sae['Sae']['id'],   
                                           'model' => 'Sae', 'category' => 'external', 'url' => 'add_sae_external']]) 
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
    $('#cioms_tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#cioms_tab a').on("shown", function (e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('ciomsTab', id)
    });

    var ciomsTab = localStorage.getItem('ciomsTab');
    if (ciomsTab != null) {
        $('#cioms_tab a[href="' + ciomsTab + '"]').tab('show');
    }

    var hashTab = $('#cioms_tab a[href="' + location.hash + '"]');
    hashTab && hashTab.tab('show');
    //end mcaz
});
</script>