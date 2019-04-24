<?php
	$this->assign('Content', 'active');
?>

<div class="row-index">
	<h2><?php echo __('Messages'); ?></h2>
	<table  class="table  table-bordered table-striped">
	<tr>
	    <th><?php echo $this->Paginator->sort('id'); ?></th>
	    <th><?php echo $this->Paginator->sort('name'); ?></th>
           <th><?php echo $this->Paginator->sort('content'); ?></th>
       <th><?php echo $this->Paginator->sort('type'); ?></th>
	     <th><?php echo $this->Paginator->sort('description'); ?></th>
	     <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($messages as $message): ?>
	<tr>
		<td><?php echo h($message['Message']['id']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['name']); ?>&nbsp;</td>
              <td><?php echo $message['Message']['content']; ?>&nbsp;</td>
              <td><?php echo $message['Message']['type']; ?>&nbsp;</td>
		<td><?php echo $message['Message']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'messages', 'action' => 'edit', $message['Message']['id'], 'admin' => true), array('class' => 'btn btn-success')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
		<p>
          <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Applications out of
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

    <div class="form-actions">
      <?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-primary')); ?>
    </div>
</div>
