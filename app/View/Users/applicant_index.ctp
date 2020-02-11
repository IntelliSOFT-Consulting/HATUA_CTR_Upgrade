<div class="row-fluid">
  <?php
  $this->assign('Users', 'active');
?>
  <h2><?php echo __('Study Monitors'); ?></h2>
    
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
        <th><?php echo $this->Paginator->sort('phone_no'); ?></th>
        <th><?php echo $this->Paginator->sort('email'); ?></th>
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
        <td><?php echo h($user['User']['phone_no']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
        <td class="actions">
          <?php echo $this->Html->link(__('<label class="label label-success">Edit</label>'), array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
          <?php
             if(!$user['User']['deactivated']) {
            echo $this->Form->postLink(__('<label class="label label-inverse">Deactivate</label>'), array('action' => 'delete', $user['User']['id'], 1), array('escape' => false), __('Are you sure you want to deactivate # %s?', $user['User']['id']));
             } else {
              echo $this->Form->postLink(__('<label class="label">Activate</label>'), array('action' => 'delete', $user['User']['id'], 0), array('escape' => false), __('Are you sure you want to Reactivate # %s?', $user['User']['id']));
             }

          ?>
        </td>
      </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
