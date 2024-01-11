<?php
	$this->assign('NT', 'active');
?>

<div class="row-fluid">
  <div class="span-12">


    <?php
        echo $this->Form->create('Feedback', array(
          'url' => array_merge(array('action' => 'index'), $this->params['pass']),
          'class' => 'ctr-groups', 'style'=>array('padding:9px;', 'background-color: #F5F5F5'),
        ));
      ?>
      <table class="table table-condensed table-bordered" style="margin-bottom: 2px;">
        <thead>
          <tr>
            <th style="width: 15%;">
              <?php
                echo $this->Form->input('name',
                    array('div' => false, 'class' => 'span12 unauthorized_index', 'label' => array('class' => 'required', 'text' => 'Name/Email')));
              ?>
              </th>
              <th>
              <?php
                echo $this->Form->input('subject', array('div' => false, 'class' => 'span12 unauthorized_index',
                  'label' => array('class' => 'required', 'text' => 'Subject'),
                  'type' => 'text',
                  ));
              ?>
              </th>
              <th>
              <?php
                echo $this->Form->input('feedback', array('div' => false, 'class' => 'span12 unauthorized_index',
                  'label' => array('class' => 'required', 'text' => 'Feedback'),
                  'type' => 'text',
                  ));
              ?>
              </th>
              <th>
                <?php
                  echo $this->Form->input('pages', array(
                    'type' => 'select', 'div' => false, 'class' => 'span12', 'selected' => $this->request->params['paging']['Feedback']['limit'],
                    'empty' => true,
                    'options' => $page_options,
                    'label' => array('class' => 'required', 'text' => 'Pages'),
                  ));
                ?>
              </th>
              <th rowspan="2" style="width: 14%;">
                <?php
                  echo $this->Form->button('<i class="icon-search icon-white"></i> Search', array(
                      'class' => 'btn btn-inverse', 'div' => 'control-group', 'div' => false,
                      'style' => array('margin-bottom: 5px')
                  ));

                  echo $this->Html->link('<i class="icon-remove"></i> Clear', array('action' => 'index'), array('class' => 'btn', 'escape' => false, 'style' => array('margin-bottom: 5px')));echo "<br>";
                  echo $this->Html->link('<i class="icon-file-alt"></i> Excel', array('action' => 'index', 'ext' => 'csv'), array('class' => 'btn btn-success', 'escape' => false));
                ?>
              </th>
          </tr>
        </thead>
      </table>
    <p>
      <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                showing <span class="badge">{:current}</span> SAEs out of
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


  <div class="row-index">
  	<h2><?php echo __('Feedbacks'); ?></h2>
  	<table  class="table  table-bordered table-striped">
  	<tr>
  	    <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th>Name</th>
  	    <th><?php echo $this->Paginator->sort('subject'); ?></th>
         <th><?php echo $this->Paginator->sort('feedback'); ?></th>
         <th><?php echo $this->Paginator->sort('created'); ?></th>
  	     <th class="actions"><?php echo __('Actions'); ?></th>
  	</tr>
  	<?php
  	foreach ($feedbacks as $feedback): ?>
  	<tr>
  		<td><?php echo h($feedback['Feedback']['id']); ?>&nbsp;</td>
      <td><?php echo h($feedback['User']['name']); ?>&nbsp;</td>
  		<td><?php echo h($feedback['Feedback']['subject']); ?>&nbsp;</td>
                <td><?php echo $feedback['Feedback']['feedback']; ?>&nbsp;</td>
                <td><?php echo $feedback['Feedback']['created']; ?>&nbsp;</td>
  		<td class="actions">
  			<?php echo $this->Html->link(__('Reply'), array('controller' => 'feedbacks', 'action' => 'reply', $feedback['Feedback']['id'], 'manager' => true), array('class' => 'btn btn-success')); ?>
  		</td>
  	</tr>

      <?php foreach ($feedback['Reply'] as $reply) { ?>
        <tr class="warning">
          <td><?php echo h($reply['id']); ?>&nbsp;</td>
          <td><?php echo h($reply['user_id']); ?>&nbsp;</td>
          <td><?php echo h($reply['subject']); ?>&nbsp;</td>
          <td><?php echo $reply['feedback']; ?>&nbsp;</td>
          <td class="actions">
              <a href="#" class="btn btn-mini disabled">PPB Response</a>
          </td>
        </tr>
      <?php } ?>
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

  </div>
</div>