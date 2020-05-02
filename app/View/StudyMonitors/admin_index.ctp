<div class="row-fluid">
	<?php
	$this->assign('Users', 'active');
?>
  <?php 
    // echo $this->Html->link(__('<label class="label label-success">Add Study Monitor</label>'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); 
  echo $this->Html->link(__('<i class="icon-plus"></i> Add Study Monitor'),
                  array('controller' => 'users', 'action' => 'add'),
                  array('escape' => false, 'class' => 'btn btn-primary btn-small', 'style'=>'margin-right: 10px;'));
  ?>
	<h2><?php echo __('Study Monitors'); ?></h2>
    <?php
        echo $this->Form->create('StudyMonitor', array(
          'url' => array_merge(array('action' => 'index'), $this->params['pass']),
          'class' => 'ctr-groups', 'style'=>array('padding:9px;', 'background-color: #F5F5F5'),
        ));
      ?>
     <div class="row-fluid">
          <div class="span4">
          <?php
            echo $this->Form->input('filter', array('div' => false, 'class' => 'span12 unauthorized_index',
              'label' => array('class' => 'required', 'text' => 'Email / Name / Username'),
              'type' => 'text',
              ));
          ?>
          </div>
          <div class="span4">
          <?php
            echo $this->Form->input('start_date',
              array('div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index', 'after' => '-to-',
                  'label' => array('class' => 'required', 'text' => 'User Register Dates'), 'placeHolder' => 'Start Date'));
            echo $this->Form->input('end_date',
              array('div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index',
                   'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                        <em class="accordion-toggle">clear!</em></a>',
                  'label' => false, 'placeHolder' => 'End Date'));
          ?>
          </div>
          <div class="span2">
            <?php
              echo $this->Form->input('pages', array(
                'type' => 'select', 'div' => false, 'class' => 'span12', 'selected' => $this->request->params['paging']['User']['limit'],
                'empty' => true,
                'options' => $page_options,
                'label' => array('class' => 'required', 'text' => 'Pages'),
              ));
            ?>
          </div>
          <div class="span2">
            <?php
              echo $this->Form->button('<i class="icon-search icon-white"></i> Search', array(
                  'class' => 'btn btn-inverse', 'div' => 'control-group', 'div' => false,
                  'style' => array('margin-bottom: 5px')
              ));

              echo $this->Html->link('<i class="icon-remove"></i> Clear', array('action' => 'index'), array('class' => 'btn', 'escape' => false));
                 
              echo "<br>";
              echo $this->Html->link('<i class="icon-file-alt"></i> Excel', array('action' => 'index', 'ext' => 'csv'), array('class' => 'btn btn-success', 'escape' => false));
            ?>
          </div>
       </div>
	<p>
          <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Users out of
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
              echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false ));
            ?>
            </ul>
          </div>
	<table  class="table  table-bordered table-striped">
	 <thead>
            <tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('username'); ?></th>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('email'); ?></th>
		<th>Studies</th>
		<th><?php echo $this->Paginator->sort('created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	      </tr>
       </thead>
      <tbody>
	<?php
	foreach ($users as $user): ?>
	<tr class="<?php if($user['User']['deactivated']) echo 'muted';?>">
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td>
			<?php 
        foreach ($user['StudyMonitor'] as $study_monitor) {
          echo $study_monitor['Application']['protocol_no']."<br>"; 
        }        
      ?>
		</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<label class="label label-info">Assign Study</label>'), array('action' => 'view', $user['User']['id']), array('escape' => false)); ?>
			<?php echo $this->Html->link(__('<label class="label label-success">Edit</label>'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>
