<div class="siteAnswers view">
<h2><?php  echo __('Site Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Site Inspection'); ?></dt>
		<dd>
			<?php echo $this->Html->link($siteAnswer['SiteInspection']['id'], array('controller' => 'site_inspections', 'action' => 'view', $siteAnswer['SiteInspection']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Type'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['question_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Number'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['question_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($siteAnswer['SiteAnswer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Site Answer'), array('action' => 'edit', $siteAnswer['SiteAnswer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Site Answer'), array('action' => 'delete', $siteAnswer['SiteAnswer']['id']), null, __('Are you sure you want to delete # %s?', $siteAnswer['SiteAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Inspections'), array('controller' => 'site_inspections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Inspection'), array('controller' => 'site_inspections', 'action' => 'add')); ?> </li>
	</ul>
</div>
