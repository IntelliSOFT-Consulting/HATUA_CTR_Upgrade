<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Pharmacy and Poisons Board');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('jquery-ui-1.9.2.custom');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('docs');
		echo $this->Html->css('prettify');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('font-awesome-ie7');
		echo $this->Html->css('ctr-fix');

            // echo $this->Html->script('jquery-1.8.3');
		echo $this->Html->script('jquery-1.9.1');
		echo $this->Html->script('jquery-ui-1.9.2.custom');
		echo $this->Html->script('jquery.cookie');
             echo $this->Html->script('jquery.expander');

		echo $this->Html->script('bootstrap');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

             echo $this->element('google-analytics');
	?>
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="/ctr/js/html5.js"></script>
		<![endif]-->
</head>

<body>
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
		<div class="condender">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <ul class="nav pull-right">
			<li class="<?php echo $this->fetch('Login') ?>">
				<?php
					if($this->Session->read('Auth.User')) {
						echo $this->Html->link('<i class="icon-user"></i> '.$this->Session->read('Auth.User.username'),
							array('controller' => 'users', 'action' => 'profile', 'admin' => false,) , array('escape' => false));
					} else {
						echo $this->Html->link('<i class="icon-signin"></i> Login',
							array('controller' => 'users', 'action' =>  'login', 'admin' => false) , array('escape' => false));
					}
				?>
			</li>
			<?php if($this->Session->read('Auth.User')) { ?>
				<li>
				<?php
						echo $this->Html->link('<i class="icon-signout"></i> Logout',
						array('controller' => 'users', 'action' => 'logout',  'admin' => false) , array('escape' => false));
				?>
				</li>
			<?php } else { ?>
				<li class="<?php echo $this->fetch('Register') ?>">
				<?php
						echo $this->Html->link('<i class="icon-edit"></i> Register',
						array('controller' => 'users', 'action' => 'register', 'admin' => false) , array('escape' => false));
				?>
				</li>
			<?php } ?>
		  </ul>
		  <?php
			// echo $this->Html->link(
			// 		$this->Html->image('cake.power.png', array('alt' => $cakeDescription, 'border' => '0')),
			// 			array('controller' => 'pages', 'action' => 'home', 'admin' => false),
			// 			array('escape' => false, 'class' => 'bootsnippbrand')
			// 		);
		  ?>
 	   <a href="/" class="bootsnippbrand btn btn-success">Clinical Trials</a>
         <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php echo $this->fetch('Home') ?>">
				<?php echo $this->Html->link('<i class="icon-home"></i> Home', array('controller' => 'pages', 'action' => 'home', 'admin' => false) , array('escape' => false)); ?>
              </li>
              <li class="<?php echo $this->fetch('Applications') ?>">
				<?php echo $this->Html->link('<i class="icon-th-list"></i> Approved Trials', array('controller' => 'applications', 'action'=>'index' ,
							'admin' => false,) , array('escape' => false)); ?>
              </li>
              <li class="<?php echo $this->fetch('News') ?>">
        <?php echo $this->Html->link('<i class="icon-bullhorn"></i> News', array('controller' => 'pages', 'action'=>'news',
              'admin' => false,) , array('escape' => false)); ?>
              </li>
              <li class="<?php echo $this->fetch('FAQ') ?>">
				<?php echo $this->Html->link('<i class="icon-question-sign"></i> FAQs', array('controller' => 'pages', 'action'=>'faqs',
							'admin' => false,) , array('escape' => false)); ?>
              </li>
              <li class="<?php echo $this->fetch('ContactUs') ?>">
			<?php
                    echo $this->Html->link('<i class="icon-envelope"></i> Contact us', array('controller' => 'feedbacks', 'action'=>'add' ,
							'admin' => false,) , array('escape' => false)); ?>
              </li>
            </ul>
          </div>

        </div>
        </div>
      </div>
    </div>

	<!-- Masthead
	================================================== -->
    <?php
        // if(!$this->session->read('Auth.User.group_id')) echo $this->element('header');
        // elseif ($this->request->params['controller'] == 'pages') echo $this->element('header');
        // elseif ($this->request->params['controller'] == 'applications' && $this->request->params['action'] == 'index') echo $this->element('header');
        echo $this->element('header');
    ?>

	  <div class="container">
		<div class="condend"><!-- original condend. Find alternative -->

      <div class="alert alert-error alertbrowser" style="display: none;">
          <button type="button" class="close"data-dismiss="alert">&times;</button>
          <strong>NOTE TO APPLICANT!</strong> Please use the latest versions of Firefox or Google Chrome for the best experience on this site.
      </div>
                  	<?php

				if($this->Session->read('Auth.User.group_id')) {
					if($this->Session->read('Auth.User.group_id') == '1') echo $this->element('menus/admin_menu') ;
					if($this->Session->read('Auth.User.group_id') == '2') echo $this->element('menus/manager_menu');
					if($this->Session->read('Auth.User.group_id') == '3') echo $this->element('menus/reviewer_menu');
					if($this->Session->read('Auth.User.group_id') == '4') echo $this->element('menus/partner_menu');
					if($this->Session->read('Auth.User.group_id') == '5') echo $this->element('menus/applicant_menu');
					if($this->Session->read('Auth.User.group_id') == '6') echo $this->element('menus/inspector_menu');
				}
				echo $this->Session->flash();
				echo $this->Session->flash('auth');
				echo $this->fetch('content'); ?>
		</div>
	  </div>


    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
		<?php
			echo $this->Html->link(
					$this->Html->image('cake.power.png', array('alt' => $cakeDescription, 'border' => '0')),
					array('controller' => 'pages', 'action' => 'home',
							'admin' => false,),	array('target' => '_blank', 'escape' => false)
				);
		?>
        <p class="pull-right"><a href="#">Back to top</a></p>
		<p>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</p>
        <p><a href="http://www.pharmacyboardkenya.org" target="_blank">Pharmacy and Poisons Board Kenya</a>.</p>
        <p>Kenya's Drug Regulatory Authority</p>
        <ul class="footer-links">
          <li><a href="/">Ministry of Health</a></li>
          <li><a href="/">Contact Us</a></li>
          <li><a href="http://clinicaltrials.org">Clinical Trials</a></li>
        </ul>
      </div>
    </footer>


	<?php // echo $this->element('sql_dump');// Removed ths for the sake of DebugKit ?>
    <script>
    $(function() {
        $('.mapop').popover();

        $('.tiptip').tooltip();

        $.browser = {};
        $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
        if ($.browser.msie) {
              $('.alertbrowser').show();
        }
        /* Get browser */
        $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());

        /* Detect Chrome */
        if($.browser.chrome){
            /* Do something for Chrome at this point */
            /* Finally, if it is Chrome then jQuery thinks it's
               Safari so we have to tell it isn't */
            $.browser.safari = false;
        }

        /* Detect Safari */
        if($.browser.safari){
            /* Do something for Safari */
            $('.alertbrowser').show();
        }

      });

    </script>
  </body>
</html>
