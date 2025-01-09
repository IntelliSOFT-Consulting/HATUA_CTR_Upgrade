<div class="row-fluid">
	<?php
	$this->assign('Reports', 'active');
	?>
	<h2><?php echo __('MultiCenter Requests'); ?></h2>
	<?php
	echo $this->Form->create('MultiCenter', array(
		'url' => array_merge(array('action' => 'index'), $this->params['pass']),
		'class' => 'ctr-groups',
		'style' => array('padding:9px;', 'background-color: #F5F5F5'),
	));
	?>
	<div class="row-fluid">
		<div class="span4">
			<?php
			echo $this->Form->input('filter', array(
				'div' => false,
				'class' => 'span12 unauthorized_index',
				'label' => array('class' => 'required', 'text' => 'Email / Name / Username'),
				'type' => 'text',
			));
			?>
		</div>
		<div class="span4">
			<?php
			echo $this->Form->input(
				'start_date',
				array(
					'div' => false,
					'type' => 'text',
					'class' => 'input-small unauthorized_index',
					'after' => '-to-',
					'label' => array('class' => 'required', 'text' => 'Request Dates'),
					'placeHolder' => 'Start Date'
				)
			);
			echo $this->Form->input(
				'end_date',
				array(
					'div' => false,
					'type' => 'text',
					'class' => 'input-small unauthorized_index',
					'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                        <em class="accordion-toggle">clear!</em></a>',
					'label' => false,
					'placeHolder' => 'End Date'
				)
			);
			?>
		</div>
		<div class="span2">
			<?php
			echo $this->Form->input('pages', array(
				'type' => 'select',
				'div' => false,
				'class' => 'span12',
				'selected' => $this->request->params['paging']['MultiCenter']['limit'],
				'empty' => true,
				'options' => $page_options,
				'label' => array('class' => 'required', 'text' => 'Pages'),
			));
			?>
		</div>
		<div class="span2">
			<?php
			echo $this->Form->button('<i class="icon-search icon-white"></i> Search', array(
				'class' => 'btn btn-inverse',
				'div' => 'control-group',
				'div' => false,
				'style' => array('margin-bottom: 5px')
			));

			echo $this->Html->link('<i class="icon-remove"></i> Clear', array('action' => 'index'), array('class' => 'btn', 'escape' => false));

			echo "<br>";
			?>
		</div>
	</div>
	<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> MultiCenters out of
                    <span class="badge badge-inverse">{:count}</span> total, starting on record <span class="badge">{:start}</span>,
                    ending on <span class="badge">{:end}</span>')
		));
		?>
	</p>
	<?php echo $this->Form->end(); ?>
	<div class="pagination">
		<ul>
			<?php
			echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
			echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active'));
			echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
			?>
		</ul>
	</div>
	<table class="table  table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('CoPI'); ?></th>
				<th><?php echo $this->Paginator->sort('Protocol'); ?></th>
				<th><?php echo $this->Paginator->sort('site_name'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($multicenters as $dt) : 
			// debug($dt);
			?>
				<tr class="">
					<td><?php echo h($dt['MultiCenter']['id']); ?>&nbsp;</td>
					<td><?php echo h($dt['CoPI']['name']); ?>&nbsp;</td>
					<td><?php echo h($dt['Application']['protocol_no']); ?>&nbsp;</td>
					<td><?php echo h($dt['MultiCenter']['site_name']); ?>&nbsp;</td>
					<td><?php echo h($dt['MultiCenter']['status']); ?>&nbsp;</td>
					<td><?php echo h($dt['MultiCenter']['created']); ?>&nbsp;</td>
					<td class="actions"> 

						  <!-- show confirmation action to assign site study --> 
						   <!-- Ensure there is a confirmation dilaog before real action  --> 
						  <?php echo $this->Html->link(__('Assign Site Study'), array('action' => 'assign_site_study', $dt['MultiCenter']['id']), array('class' => 'btn btn-mini btn-success', 'confirm' => 'Are you sure you want to assign this site study?')); ?>


					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>