<?php
	$this->assign('Content', 'active');
?>

<div class="row-fluid">
	<h2><?php echo __('Counties'); ?></h2>
	<table  class="table  table-bordered table-striped">
		<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('county_name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($counties as $county): ?>
	<tr>
		<td><?php echo h($county['County']['id']); ?>&nbsp;</td>
		<td><?php echo h($county['County']['county_name']); ?>&nbsp;</td>
		<td><?php echo h($county['County']['created']); ?>&nbsp;</td>
		<td><?php echo h($county['County']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $county['County']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $county['County']['id']), null, __('Are you sure you want to delete # %s?', $county['County']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
	</table>
	<p>
          <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Counties out of
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
		<li><?php echo $this->Html->link(__('New County'), array('action' => 'add')); ?></li>
	</ul>
</div>
