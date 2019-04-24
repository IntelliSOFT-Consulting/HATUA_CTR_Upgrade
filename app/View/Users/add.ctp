<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>

			<?php
				echo $this->Form->input('username', array('label' => array('class' => 'control-label', 'text' => 'Username'),));
				echo $this->Form->input('password', array('label' => array('class' => 'control-label', 'text' => 'Password'),));
				echo $this->Form->input('confirm_password', array(
						'type' => 'password',
						'label' => array('class' => 'control-label', 'text' => 'Confirm Password'), ));
				echo $this->Form->input('name', array('label' => array('class' => 'control-label', 'text' => 'Name'),));
				echo $this->Form->input('email', array(
					'type' => 'email',
					'div' => array('class' => 'control-group required'),
					'label' => array('class' => 'control-label required', 'text' => 'E-MAIL ADDRESS')
				));
				echo $this->Form->input('phone_no', array('label' => array('class' => 'control-label', 'text' => 'Phone Number'),));


				echo $this->Form->input('name_of_institution', array(
					'label' => array('class' => 'control-label', 'text' => 'Name of Institution'),
				));
				echo $this->Form->input('institution_physical', array(
					'label' => array('class' => 'control-label', 'text' => 'Physical Address'),
					'after'=>'<p class="help-block"> Road, street.. </p></div>',
				));
				echo $this->Form->input('institution_address', array('label' => array('class' => 'control-label', 'text' => 'Institution Address'),));
				echo $this->Form->input('institution_contact', array('label' => array('class' => 'control-label', 'text' => 'Institution Contacts'),));
				echo $this->Form->input('county_id', array(
									'label' => array('class' => 'control-label required', 'text' => 'County '),
									'empty' => true, 'between' => '<div class="controls ui-widget">',
								));
				echo $this->Form->input('country_id', array(
					'empty' => true,
					'label' => array('class' => 'control-label', 'text' => 'Country'), ));
				echo $this->Form->input('group_id');
				?>
		<?php echo $this->Form->end(__('Submit')); ?>
		</fieldset>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
