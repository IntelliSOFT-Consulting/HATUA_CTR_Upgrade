<?php
	$this->assign('Content', 'active');
?>

<div class="row-fluid">
	<h2><?php echo __('Declarations'); ?></h2>
	<table  class="table  table-bordered table-striped">
		<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('file'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($declarations as $dt): ?>
	<tr>
		<td><?php echo h($dt['Attachment']['id']); ?>&nbsp;</td>
		<td><?php 
         echo $this->Html->link(
            __($dt['Attachment']['basename']),
            array('controller' => 'attachments',   'action' => 'download', $dt['Attachment']['id']),
            array('class' => 'btn btn-info')
        );
        ?>&nbsp;</td>
		<td><?php echo h($dt['Attachment']['description']); ?>&nbsp;</td>
		<td><?php echo h($dt['Attachment']['created']); ?>&nbsp;</td>
		<td><?php echo h($dt['Attachment']['modified']); ?>&nbsp;</td>
		<td class="actions"> 
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dt['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $dt['Attachment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
	</table>
	<p>
          <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Declarations out of
                    <span class="badge badge-inverse">{:count}</span> total, starting on record <span class="badge">{:start}</span>,
                    ending on <span class="badge">{:end}</span>')
            ));
          ?>
          </p>
	   <div class="pagination">
            <ul>
            <?php
              echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
              echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active'));
              echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false ));
            ?>
            </ul>
          </div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Declaration'), array('action' => 'declarations_add')); ?></li>
	</ul>
</div>
