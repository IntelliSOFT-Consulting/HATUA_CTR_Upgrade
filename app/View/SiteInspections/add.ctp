<div class="siteInspections form">
<?php echo $this->Form->create('SiteInspection'); ?>
	<fieldset>
		<legend><?php echo __('Add Site Inspection'); ?></legend>
	<?php
		echo $this->Form->input('study_title');
		echo $this->Form->input('protocol_no');
		echo $this->Form->input('version_no');
		echo $this->Form->input('trial_phase');
		echo $this->Form->input('investigators');
		echo $this->Form->input('co_investigators');
		echo $this->Form->input('study_stage');
		echo $this->Form->input('inspection_country');
		echo $this->Form->input('inspector_names');
		echo $this->Form->input('inspection_date');
		echo $this->Form->input('site_address');
		echo $this->Form->input('lab_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Site Inspections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Site Answers'), array('controller' => 'site_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Answer'), array('controller' => 'site_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
