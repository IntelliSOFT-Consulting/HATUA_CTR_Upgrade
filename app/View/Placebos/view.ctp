<div class="placebos view">
<h2><?php  echo __('Placebo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($placebo['Application']['id'], array('controller' => 'applications', 'action' => 'view', $placebo['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Placebo Present'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['placebo_present']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pharmaceutical Form'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['pharmaceutical_form']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Route Of Administration'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['route_of_administration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Composition'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['composition']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Identical Indp'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['identical_indp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Major Ingredients'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['major_ingredients']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($placebo['Placebo']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Placebo'), array('action' => 'edit', $placebo['Placebo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Placebo'), array('action' => 'delete', $placebo['Placebo']['id']), null, __('Are you sure you want to delete # %s?', $placebo['Placebo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Placebos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Placebo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
