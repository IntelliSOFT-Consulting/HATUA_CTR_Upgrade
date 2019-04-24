<?php
  $this->assign('Content', 'active');
?>

<div class="row-fluid">
	<h2><?php echo __('User Feedback'); ?></h2>
  <p>
          <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Comments out of
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
  <table  class="table  table-bordered table-striped">
    <thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('feedback'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php
	foreach ($feedbacks as $feedback): ?>
	<tr>
		<td><?php echo h($feedback['Feedback']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($feedback['User']['name'], array('controller' => 'users', 'action' => 'view', $feedback['User']['id'])); ?>
		</td>
		<td><?php echo h($feedback['Feedback']['email']); ?>&nbsp;</td>
		<td><?php echo h($feedback['Feedback']['subject']); ?>&nbsp;</td>
		<td><?php echo h($feedback['Feedback']['feedback']); ?>&nbsp;</td>
		<td><?php echo h($feedback['Feedback']['created']); ?>&nbsp;</td>
		<td><?php echo h($feedback['Feedback']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $feedback['Feedback']['id']), null, __('Are you sure you want to delete # %s?', $feedback['Feedback']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
</div>

