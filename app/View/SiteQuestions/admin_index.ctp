<?php
	$this->assign('Content', 'active');
?>


    <div class="form-actions">
      <?php echo $this->Html->link(__('New Site Question'), array('controller' => 'site_questions', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-primary')); ?>
    </div>

<div class="row-index">
	<h2><?php echo __('Site Questions'); ?></h2>
	<table  class="table  table-bordered table-striped">
	<tr>
	    <th><?php echo $this->Paginator->sort('question_number'); ?></th>
	    <th><?php echo $this->Paginator->sort('question'); ?></th>
           <th><?php echo $this->Paginator->sort('question_type'); ?></th>
	     <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($siteQuestions as $siteQuestion): ?>
	<tr>
		<td><?php echo h($siteQuestion['SiteQuestion']['question_number']); ?>&nbsp;</td>
		<td><?php echo h($siteQuestion['SiteQuestion']['question']); ?>&nbsp;</td>
              <td><?php echo $siteQuestion['SiteQuestion']['question_type']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'site_questions', 'action' => 'edit', $siteQuestion['SiteQuestion']['id'], 'admin' => true), array('class' => 'btn btn-success')); ?>
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

</div>
