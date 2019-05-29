<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a href="#" class="brand">Applicant Menu ::</a>
        <?php
            // echo $this->Html->link('Dashboard ::',
            //  array('controller' => 'users', 'action'=>'dashboard', 'applicant' => true )
            //  , array('escape' => false ,'class' => 'brand '.$this->fetch('Dashboard')));
        ?>
      <div class="nav-collapse">
        <ul class="nav">
            <li class="<?php echo $this->fetch('Dashboard') ?>">
                <?php
                    echo $this->Html->link('<i class="icon-dashboard"></i> Dashboard',
                    array('controller' => 'users', 'action'=>'dashboard', 'applicant' => true ), array('escape' => false ));
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

      </div><!-- /.nav-collapse -->
    </div>
  </div><!-- /navbar-inner -->
</div>
