<?php
    $this->assign('SAE', 'active');
?>

<div class="row-fluid">
    <h2><?php echo __('SAE/SUSARs'); ?></h2>
   
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
        <th><?php echo $this->Paginator->sort('application_id'); ?></th>
        <th><?php echo $this->Paginator->sort('patient_initials'); ?></th>
        <th><?php echo $this->Paginator->sort('country_id'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
          </tr>
       </thead>
      <tbody>
    <?php
    foreach ($saes as $sae): ?>
    <tr class="">
        <td><?php echo h($sae['Sae']['id']); ?>&nbsp;</td>
        <td><?php echo h($sae['Application']['protocol_no']); ?>&nbsp;</td>
        <td><?php echo h($sae['Sae']['patient_initials']); ?>&nbsp;</td>
        <td><?php echo h($sae['Country']['name']); ?>&nbsp;</td>
        <td><?php echo h($sae['Sae']['created']); ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__('<label class="label label-info">View</label>'), array('action' => 'view', $sae['Sae']['id']), array('escape' => false)); ?>
            <?php echo $this->Html->link(__('<label class="label label-success">Edit</label>'), array('action' => 'edit', $sae['Sae']['id']), array('escape' => false)); ?>
            <?php
               if($sae['Sae']['approved'] < 1) {
                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('action' => 'delete', $sae['Sae']['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $sae['Sae']['id']));
               } 
            ?>
        </td>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>
