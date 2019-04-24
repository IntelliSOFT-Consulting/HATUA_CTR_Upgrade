<div class="siteQuestions view">
<h2><?php  echo __('Site Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($siteQuestion['SiteQuestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Number'); ?></dt>
		<dd>
			<?php echo h($siteQuestion['SiteQuestion']['question_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($siteQuestion['SiteQuestion']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Type'); ?></dt>
		<dd>
			<?php echo h($siteQuestion['SiteQuestion']['question_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($siteQuestion['SiteQuestion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($siteQuestion['SiteQuestion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Site Question'), array('action' => 'edit', $siteQuestion['SiteQuestion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Site Question'), array('action' => 'delete', $siteQuestion['SiteQuestion']['id']), null, __('Are you sure you want to delete # %s?', $siteQuestion['SiteQuestion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Question'), array('action' => 'add')); ?> </li>
	</ul>
</div>
