<?php
	$this->assign('Login', 'active');
?>
<div class="row-fluid">
	<div class="span12">

		<ul class="nav nav-tabs">
			<li class="active"><a href="#">Login Area</a></li>
			<li><?php 	echo $this->Html->link('Forgot Password?', array('controller' => 'users', 'action' => 'forgotPassword')); ?></li>
			<?php if ($this->Session->read('Auth.User')) { ?>
				<li><?php 	echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'changePassword')); ?></li>
			<?php } ?>
		</ul>

		<div style="width: 50%; padding-left: 120px;">
			<div class="page-header">
				<div class="styled_title"><h3>Login <?php  echo $this->element('google-recommend');?></h3></div>
			</div>
		</div>
		<?php
			echo $this->Session->flash();
			echo $this->Form->create('User', array(
						'action' => 'login',
						'class' => 'form-horizontal'
					));
		?>
		<div class="control-group">
		  <label for="inputEmail" class="control-label">Username</label>
		  <div class="controls">
			<input type="text" id="UserUsername" maxlength="255" class="span4" name="data[User][username]" placeholder="Username">
		  </div>
		</div>
		<div class="control-group">
		  <label for="inputPassword" class="control-label">Password</label>
		  <div class="controls">
			<input type="password" id="UserPassword" class="span4" name="data[User][password]" placeholder="Password">
		  </div>
		</div>
		<div class="control-group">
		  <div class="controls">
			<label class="checkbox">
			  <input type="checkbox" name="remember" value="1"> Remember me
			</label>
			<button class="btn" type="submit">Sign in</button>
			<br>
			<br>
			<p class="visible-desktop"><?php echo $this->Html->link('Forgot Password? click here to recover', array('controller' => 'users', 'action' => 'forgotPassword')); ?></p>

		  </div>
		</div>
        	<?php
			echo $this->Form->end();
		?>

	</div>
</div>

