<div class="navbar navbar-inverse">
  <div class="navbar-inner">
  <div class="container">
    <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </a>
    <a href="#" class="brand">Manager Menu ::</a>
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
          array('controller' => 'users', 'action'=>'dashboard', 'manager' => true ), array('escape' => false ));
            ?>
       </li>
       <li class="<?php echo $this->fetch('Applications') ?>">
        <?php
          echo $this->Html->link('<i class="icon-file-text"></i> Applications',
            array('controller' => 'applications', 'action'=>'index', 'manager' => true ), array('escape' => false ));
            ?>
       </li>
       <li class="<?php echo $this->fetch('SAE') ?>">
          <?php
              echo $this->Html->link('<i class="icon-list-alt"></i> SAE',
                  array('controller' => 'saes', 'action'=>'index', 'manager' => true ), array('escape' => false ));
              ?>
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
        </ul>
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
