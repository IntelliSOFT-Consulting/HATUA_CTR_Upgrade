<div class="ercs view">
<h2><?php  echo __('Erc'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accrediation Date'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['accrediation_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Chairperson'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['chairperson']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Host Institution'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['host_institution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Physical Address'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['physical_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institution Email'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['institution_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area Accredited'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['area_accredited']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Contacts'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['email_contacts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($erc['Erc']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Erc'), array('action' => 'edit', $erc['Erc']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Erc'), array('action' => 'delete', $erc['Erc']['id']), null, __('Are you sure you want to delete # %s?', $erc['Erc']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ercs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Erc'), array('action' => 'add')); ?> </li>
	</ul>
</div>
