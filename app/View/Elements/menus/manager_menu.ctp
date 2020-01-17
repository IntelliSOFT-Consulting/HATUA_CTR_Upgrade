
 <div class="menu text-center">
    <ul class="nav nav-pills center-pills">
      <li class="<?php echo $this->fetch('Dashboard') ?>">
        <?php
          echo $this->Html->link('<i class="icon-dashboard"></i> Dashboard',
          array('controller' => 'users', 'action'=>'dashboard', 'manager' => true ), array('escape' => false ));
            ?>
       </li>
       <li class="<?php echo $this->fetch('MEETINGS') ?>">
          <?php
              echo $this->Html->link('<i class="icon-calendar"></i> Meetings',
                  array('controller' => 'meeting_dates', 'action'=>'index', 'manager' => true ), array('escape' => false ));
              ?>
       </li>
       <li class="<?php echo $this->fetch('Applications') ?>">
        <?php
          echo $this->Html->link('<i class="icon-file-text"></i> Applications',
            array('controller' => 'applications', 'action'=>'index', 'manager' => true ), array('escape' => false ));
            ?>
       </li>
       <li class="<?php echo $this->fetch('Workflows') ?>">
        <?php
          echo $this->Html->link('<i class="icon-code-fork"></i> Workflows',
            array('controller' => 'applications', 'action'=>'workflow', 'manager' => true ), array('escape' => false ));
            ?>
       </li>
       <li class="dropdown <?php echo $this->fetch('SAE') ?> <?php echo $this->fetch('SI') ?> <?php echo $this->fetch('PF') ?> <?php echo $this->fetch('CIOM') ?>">
         <a data-toggle="dropdown" class="dropdown-toggle" role="button" id="drop7" href="#">
            <i class="icon-paper-clip"></i> Application data <b class="caret"></b></a>
          <ul aria-labelledby="drop7" role="menu" class="dropdown-menu">
             <li>
             <?php
              echo $this->Html->link('<i class="icon-list-alt"></i> SAE',
                  array('controller' => 'saes', 'action'=>'index', 'manager' => true ), array('escape' => false ));
              ?>
            </li>
          <li class="divider"></li>
             <li>
              <?php
              echo $this->Html->link('<i class="icon-skype"></i> Site Inspections',
                  array('controller' => 'site_inspections', 'action'=>'index', 'manager' => true ), array('escape' => false ));
              ?>
            </li>
          <li class="divider"></li>
            <li>
              <?php
              echo $this->Html->link('<i class="icon-sitemap"></i> Participants',
                  array('controller' => 'participant_flows', 'action'=>'index', 'manager' => true ), array('escape' => false ));
              ?>
            </li>
          <li class="divider"></li>
            <li>
              <?php
                    echo $this->Html->link('<i class="icon-upload-alt"></i> CIOMS E2B',
                        array('controller' => 'cioms', 'action'=>'index', 'manager' => true ), array('escape' => false ));
                    ?>
            </li>
        </ul>
       </li>

       <li class="dropdown <?php echo $this->fetch('Reports') ?>">
         <a data-toggle="dropdown" class="dropdown-toggle" role="button" id="drop4" href="#">
            <i class="icon-bar-chart"></i> Reports <b class="caret"></b></a>
          <ul aria-labelledby="drop4" role="menu" class="dropdown-menu">
             <li><?php
                        echo $this->Html->link('<i class="icon-signal"></i> Monthly Site Inspections',  array('controller' => 'reports', 'action'=>'si_per_month', 'manager' => true ),
                                  array('escape' => false, 'tabindex' => '-1'));
                    ?>
            </li>
          <li class="divider"></li>
             <li><?php
                        echo $this->Html->link('<i class="icon-signal"></i> Monthly SAE/SUSAR',  array('controller' => 'reports', 'action'=>'sae_per_month', 'manager' => true ),
                                  array('escape' => false, 'tabindex' => '-1'));
                    ?>
            </li>
            <li><?php  
            echo $this->Html->link('<i class="icon-arrow-right"></i> SAE by Type by Study',  
                 array('controller' => 'reports', 'action'=>'sae_by_type', 'manager' => true ), array('escape' => false, 'tabindex' => '-1'));?>
            </li>
          <li class="divider"></li>
             <li><?php
                        echo $this->Html->link('<i class="icon-bar-chart"></i> Protocols by status',  array('controller' => 'reports', 'action'=>'protocols_by_status', 'manager' => true ),
                                  array('escape' => false, 'tabindex' => '-1'));
                    ?>
            </li>
             <li><?php
                        echo $this->Html->link('<i class="icon-bar-chart"></i> Protocols by phase',  array('controller' => 'reports', 'action'=>'protocols_by_phase', 'manager' => true ),
                                  array('escape' => false, 'tabindex' => '-1'));
                    ?>
            </li>
        </ul>
       </li>
       <li class="<?php echo $this->fetch('Notifications') ?>">
        <?php
          echo $this->Html->link('<i class="icon-exclamation-sign"></i> Notifications',
            array('controller' => 'notifications', 'action'=>'index', 'manager' => true ), array('escape' => false ));
            ?>
       </li>
       <li class="<?php echo $this->fetch('Profile') ?>">
        <?php
          echo $this->Html->link('<i class="icon-user"></i> My Profile',
            array('controller' => 'users', 'action'=>'profile', 'admin' => false ), array('escape' => false ));
            ?>
       </li>
    </ul>

</div>

<hr>