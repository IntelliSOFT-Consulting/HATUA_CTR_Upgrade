<?php
  $this->assign('Dashboard', 'active');
?>
  <div class="marketing">
    <h4>Administrators&rsquo; Dashboard <small class="text-error">(Restricted)</small></h4>
  </div>
  <hr class="soften" style="margin: 10px;">
  <div class="row-fluid">
    <div class="span4">
      <h4><img alt="" src="/img/report.ico" style="width: 25px;">&nbsp;
        <?php echo $this->Html->link('Reports', array('controller' => 'applications', 'action' => 'index')); ?></h4>
      <small class="muted">Filter, search and download reports</small>
      <ul class="nav nav-tabs nav-stacked">
        <li>
        <?php
          echo $this->Html->link('<i class="icon-table"></i> All Applications',
            array('controller' => 'applications', 'action' => 'index'),  array('escape' => false));
        ?>
        </li>
        <li>
          <?php     echo $this->Html->link('<i class="icon-ok"></i> Approved',
                      array('controller' => 'applications', 'action' => 'index', 'submitted'=>'1', 'approved'=>2), array('escape' => false, 'class' =>  'text-success'));   ?>
        </li>
        <li>
          <?php     echo $this->Html->link('<i class="icon-shopping-cart"></i> Waiting Approval',
                      array('controller' => 'applications', 'action' => 'index', 'submitted'=>'1', 'approved'=>0), array('escape' => false, 'class' =>  'text-success'));   ?>
        </li>
        <li>
          <?php     echo $this->Html->link('<i class="icon-pause"></i> On hold',
                      array('controller' => 'applications', 'action' => 'index', 'submitted'=>'1', 'approved'=>1), array('escape' => false, 'class' =>  'text-success'));   ?>
        </li>
        <li>
          <?php echo $this->Html->link('<i class="icon-minus"></i> Unsubmitted',
                      array('controller' => 'applications', 'action' => 'index', 'submitted'=>'0'), array('escape' => false, 'class' => 'text-info'));    ?>
        </li>
        <li>
        <?php
          echo $this->Html->link('<i class="icon-remove-circle"></i> Deactivated Applications',
            array('controller' => 'applications', 'action' => 'index', 'deactivated'=>'1'),  array('escape' => false, 'class' =>  'text-warning'));
        ?>
        </li>
        <li>
        <?php
          echo $this->Html->link('<i class="icon-remove"></i> Deleted Applications',
            array('controller' => 'applications', 'action' => 'index', 'deleted'=>'1'),  array('escape' => false, 'class' =>  'text-error'));
        ?>
        </li>
      </ul>
      <br>
      <hr>
      <h4><a href="http://www.google.com/analytics/" target="_blank"><i class="icon-globe"></i> Google Analytics</a></h4>
    </div>
       <div class="span4">
        <h4><img alt="" src="/img/user_group.ico" style="width: 25px;">&nbsp;<?php
               echo $this->Html->link('User Management',
                  array('controller' => 'users', 'action' => 'index', 'admin' => true), array('escape' => false));
        ?></h4>
      <small class="muted">Add, edit, deactivate users.</small>
      <ul class="nav nav-tabs nav-stacked">
        <li>
        <?php echo $this->Html->link('<i class="icon-user"></i> Users',
              array('controller' => 'users', 'action' => 'index', 'admin' => true),
              array('escape' => false)); ?>
        </li>
        <li>
        <?php echo $this->Html->link('<i class="icon-plus-sign"></i> Create User',
              array('controller' => 'users', 'action' => 'add', 'admin' => true),
              array('escape' => false)); ?>
        </li>
        <li>
        <?php echo $this->Html->link('<i class="icon-group"></i> User Roles',
              array('controller' => 'groups', 'action' => 'index', 'admin' => true),
              array('escape' => false)); ?>
        </li>
      </ul>
      <hr>
      <h4><img alt="" src="/img/comments.ico" style="width: 25px;">&nbsp;<?php
        echo $this->Html->link('User Feedback', array('controller' => 'feedbacks'), array('escape' => false));
        ?><small class="muted">&nbsp;(From Contact Us page)</small></h4>
      <div style="margin-left: 20px;">
         <?php if(count($previous_messages) > 0) { ?>
             <dl>
            <?php
              $count = 1;
              foreach ($previous_messages as $previous_message) {
                echo "<dt>".$count.". ".$previous_message['Feedback']['subject']." <small class='muted'> created on ".date('d-m-Y H:i:s', strtotime($previous_message['Feedback']['created']))."</small></dt>";
                echo "<dd class='morecontent'>".$previous_message['Feedback']['feedback']."</dd>";
                $count++;
              }
            ?>
             </dl>
         <?php } ?>
       </div>
      <small class="muted">Latest Feedback.</small>
    </div>


    <div class="span4">
      <h4><img alt="" src="/img/box_content.ico" style="width: 25px;">&nbsp;<a href="#">Content Management</a></h4>
      <small class="muted">Manage site content like emails, notifications, web pages etc</small>

      <ul class="nav nav-tabs nav-stacked">
        <li><?php
        echo $this->Html->link('<i class="icon-envelope"></i> Site Messages <small class="muted">(Emails &amp; Notifications)</small>',
            array('controller' => 'messages', 'action' => 'index', 'admin' => true), array('escape' => false)); ?>
        </li>
        <li>
        <?php
        echo $this->Html->link('<i class="icon-hand-right"></i> Counties',
          array('controller' => 'counties', 'action' => 'index',  'admin' => true),
          array('escape' => false));
        ?>
        </li>
        <li>
        <?php
        echo $this->Html->link('<i class="icon-globe"></i> Countries',
          array('controller' => 'countries', 'action' => 'index', 'admin' => true),
          array('escape' => false));
        ?>
        </li>
        <li>
        <?php
        echo $this->Html->link('<i class="icon-flag"></i> Trial Statuses',
          array('controller' => 'trial_statuses', 'action' => 'index', 'admin' => true), array('escape' => false));
        ?>
        </li>
        <li>
        <?php
        echo $this->Html->link('<i class="icon-question-sign"></i> Site Questions <small class="muted">(Site inspection questions)</small>',
          array('controller' => 'site_questions', 'action' => 'index', 'admin' => true), array('escape' => false));
        ?>
        </li>
        <li>
        <?php
        echo $this->Html->link('<i class="icon-check"></i> Annual Approval Checklist <small class="muted">(Files required)</small>',
          array('controller' => 'pockets', 'action' => 'cindex', 'admin' => true), array('escape' => false));
        ?>
        </li>
        <li>
        <?php
        echo $this->Html->link('<i class="icon-calendar"></i> Annual Approval Letter <small class="muted">(Edit content)</small>',
          array('controller' => 'pockets', 'action' => 'edit', 17, 'admin' => true), array('escape' => false));
        ?>
        </li>
      </ul>
    </div>
      </div> <!-- /row -->
      <hr>
      <div class="row-fluid" style="margin-bottom: 9px;">
        <div class="span4">
      <!-- SOME CONDEND HERE -->
    </div>
        <div class="span4">
      <!-- SOME OTHER CONDEND HERE -->
        </div>
        <div class="span4">
        </div>
      </div> <!-- /row -->



<script type="text/javascript">
  $.expander.defaults.slicePoint = 70;
  $(function() {
    $(".morecontent").expander();
  });
</script>
