
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
                    echo $this->Html->link('<i class="icon-group"></i> Meetings',
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
             <li class="<?php echo $this->fetch('Profile') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-user"></i> My Profile',
                        array('controller' => 'users', 'action'=>'profile', 'admin' => false ), array('escape' => false ));
                    ?>
             </li>
        </ul>
        
    </div>

<hr class="soften">