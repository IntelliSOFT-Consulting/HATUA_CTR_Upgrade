<div class="siteDetails view">
<h2><?php  echo __('Site Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($siteDetail['Application']['id'], array('controller' => 'applications', 'action' => 'view', $siteDetail['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Site Name'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['site_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Physical Address'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['physical_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Details'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['contact_details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Person'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['contact_person']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Site Capacity'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['site_capacity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Misc'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['misc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($siteDetail['SiteDetail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Site Detail'), array('action' => 'edit', $siteDetail['SiteDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Site Detail'), array('action' => 'delete', $siteDetail['SiteDetail']['id']), null, __('Are you sure you want to delete # %s?', $siteDetail['SiteDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
