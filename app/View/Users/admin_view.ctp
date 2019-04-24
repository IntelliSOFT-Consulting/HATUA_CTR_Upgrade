<div class="row-fluid">
	<?php
	$this->assign('Users', 'active');
?>
	 <h4>User Registration details</h4>
	 <hr>
	  <dl class="dl-horizontal <?php if($user['User']['deactivated']) echo 'muted';?>">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt>Username</dt>
		<dd><?php echo $user['User']['username'] ;?> &nbsp; </dd>
		<dt>Name</dt>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dd><?php echo $user['User']['name']; ?> &nbsp; </dd>
		<dt>Email</dt>
		<dd><?php echo $user['User']['email']; ?> &nbsp; </dd>
		<dt>Phone No</dt>
		<dd><?php echo $user['User']['phone_no']; ?> &nbsp; </dd>
		<dt>Name of institution</dt>
		<dd><?php echo $user['User']['name_of_institution'];?>&nbsp; </dd>
		<dt>Physical Address</dt>
		<dd><?php echo $user['User']['institution_physical'];?> &nbsp; </dd>
		<dt>Institution Address</dt>
		<dd><?php echo $user['User']['institution_address'];?> &nbsp; </dd>
		<dt>Institution Contact</dt>
		<dd><?php echo $user['User']['institution_contact'];?> &nbsp; </dd>
		<dt>County</dt>
		<dd><?php echo ($user['County']['county_name']) ?> &nbsp; </dd>
		<dt>Country</dt>
		<dd><?php echo ($user['Country']['name']) ?> &nbsp; </dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	  </dl>
    <hr>
	<div class="form-actions">
		<?php
		echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'], 'admin' => true), array('class' => 'btn btn-primary'));
		?>
	<?php
	   if(!$user['User']['deactivated']) {
		echo $this->Form->postLink(__('Deactivate'), array('action' => 'delete', $user['User']['id'], 1), array('escape' => false, 'class' => 'btn btn-inverse'), __('Are you sure you want to deactivate # %s?', $user['User']['id']));
	   } else {
	   	echo $this->Form->postLink(__('Activate'), array('action' => 'delete', $user['User']['id'], 0), array('escape' => false, 'class' => 'btn'), __('Are you sure you want to Reactivate # %s?', $user['User']['id']));
	   }
	?>
	</div>
</div>

