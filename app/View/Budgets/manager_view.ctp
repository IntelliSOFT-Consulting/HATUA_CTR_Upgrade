<?php
    $this->assign('DEV', 'active');        
    echo $this->Session->flash();
?>

<ul id="devs_tab" class="nav nav-tabs">
  <li class="active"><a href="#budget_form">Budget</a></li> 
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="budget_form">
    <?php 
      echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                    array('controller' => 'budgets', 'ext' => 'pdf', 'action' => 'download_budget', $budget['Budget']['id']),
                    array('escape' => false, 'class' => 'btn btn-primary'));
      echo $this->element('application/budget_view', array('budget' => $budget['Budget'])); 
    ?>
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