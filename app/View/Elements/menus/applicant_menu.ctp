
    <!-- <ul class="nav nav-pills">
      <li class="active">
        <a href="#">Home</a>
      </li>
      <li><a href="#">...</a></li>
      <li><a href="#">...</a></li>
    </ul> -->


    <div class="menu text-center">

        <ul class="nav nav-pills center-pills">
            <li class="<?php echo $this->fetch('Dashboard') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-dashboard"></i> Dashboard',
                    array('controller' => 'users', 'action'=>'dashboard', 'applicant' => true ), array('escape' => false ));
                    ?>
             </li>
             <li class="<?php echo $this->fetch('MEETINGS') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-calendar"></i> Meetings',
                        array('controller' => 'meeting_dates', 'action'=>'index', 'applicant' => true ), array('escape' => false ));
                    ?>
             </li>
             <li class="<?php echo $this->fetch('MyApplications') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-file-text"></i> My Applications',
                        array('controller' => 'applications', 'action'=>'index', 'applicant' => true ), array('escape' => false ));
                    ?>
             </li>
             <li class="<?php echo $this->fetch('SAE') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-list-alt"></i> SAE',
                        array('controller' => 'saes', 'action'=>'index', 'applicant' => true ), array('escape' => false ));
                    ?>
             </li>
             <li class="<?php echo $this->fetch('SI') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-skype"></i> Site Inspections',
                        array('controller' => 'site_inspections', 'action'=>'index', 'applicant' => true ), array('escape' => false ));
                    ?>
             </li>
             <li class="<?php echo $this->fetch('CIOM') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-upload-alt"></i> CIOMS E2B',
                        array('controller' => 'cioms', 'action'=>'index', 'applicant' => true ), array('escape' => false ));
                    ?>
             </li>
             <li class="<?php echo $this->fetch('ContactUs') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-comment-alt"></i> My Messages',
                        array('controller' => 'feedbacks', 'action'=>'add', 'applicant' => false ), array('escape' => false ));
                    ?>
             </li>
             <li class="dropdown <?php echo $this->fetch('Profile') ?>">
                 <a data-toggle="dropdown" class="dropdown-toggle" role="button" id="drop7" href="#">
                    <i class="icon-group"></i> My Profile &amp; Monitors <b class="caret"></b></a>
                  <ul aria-labelledby="drop7" role="menu" class="dropdown-menu">
                     <li>
                     <?php
                      echo $this->Html->link('<i class="icon-user"></i> My Profile',
                        array('controller' => 'users', 'action'=>'profile', 'admin' => false ), array('escape' => false ));
                      ?>
                    </li>
                  <li class="divider"></li>
                     <li>
                      <?php
                      echo $this->Html->link('<i class="icon-user-md"></i> Add Monitor',
                        array('controller' => 'users', 'action'=>'add', 'applicant' => true ), array('escape' => false ));
                      ?>
                    </li>
                  <li class="divider"></li>
                     <li>
                      <?php
                      echo $this->Html->link('<i class="icon-list-alt"></i> List Study Monitors',
                        array('controller' => 'users', 'action'=>'index', 'applicant' => true ), array('escape' => false ));
                      ?>
                    </li>
                </ul>
             </li>
        </ul>
        
    </div>

<hr class="soften">