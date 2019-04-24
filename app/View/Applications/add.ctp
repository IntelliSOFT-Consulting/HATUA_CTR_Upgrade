<?php
	$this->assign('Applications', 'active');
?>
<div class="row">	  
	<div class="span12">
		<p>Thank you for your interest in registering your application to conduct a clinical trial.</p>
		<p>Your trial will go through various stages until its approved.</p>
		<p>Once your create an application, you are allowed to update it as much as you want before submitting. Please ensure you meet all the requirements of 
		   the Pharmacy and Poisons Board checklist available here (http://www.pharmacyboardkenya.org/index.php?id=15) before you submit the application.</p>
		<p>Once you submit an application, you will not be able to make further changes to it.</p>
		<?php echo $this->Form->create('Application'); ?>
		<fieldset>
			<legend><?php echo __('New Application'); ?></legend>
		<?php
			// echo $this->Form->input('user_id');
			echo $this->Form->input('email_address');		
		?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>

	</div>
</div>

