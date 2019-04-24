<?php
  $this->assign('Login', 'active');
 ?>

   <!-- FORGOT PASSWORD
================================================== -->
  <div class="row-fluid">
   <div class="span12">

        <ul class="nav nav-tabs">
          <li><?php   echo $this->Html->link('Login Area', array('controller' => 'users', 'action' => 'login')); ?></li>
          <li class="active"><a href="#">Forgot Password?</a></li>
          <?php if ($this->Session->read('Auth.User')) { ?>
            <li><?php   echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'changePassword')); ?></li>
          <?php } ?>
        </ul>

          <div style="width: 50%; padding-left: 120px;">
            <div class="page-header">
              <div class="styled_title"><h3>Lost Password Reset</h3></div>
              <p>If you have forgotten your password, you can reset it here.  Enter the email address you used to register and you will get instructions on how to proceed.</p>
            </div>
          </div>
            <?php
              echo $this->Session->flash();
              echo $this->Form->create('User', array(
                    'action' => 'forgotPassword',
                    'class' => 'form-horizontal'
                  ));
            ?>
            <div class="control-group">
              <label for="email" class="control-label">Email Address</label>
              <div class="controls">
              <input type="email" id="UserEmail" maxlength="255" class="span4" name="data[User][email]" placeholder="Email Address">
              </div>
            </div>

            <div class="control-group">
              <div class="controls">
              <button class="btn" type="submit">Submit</button>
              <br>
              <br>
              <p class="visible-desktop"><?php echo $this->Html->link('Back to login area', array('controller' => 'users', 'action' => 'login')); ?></p>

              </div>
            </div>
                  <?php
              echo $this->Form->end();
            ?>

    </div>
  </div>
