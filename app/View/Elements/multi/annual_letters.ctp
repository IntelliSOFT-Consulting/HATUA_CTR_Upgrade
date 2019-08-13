<h3>Annual Approval Letters</h3>

    <table  class="table  table-bordered table-striped">
         <thead>
            <tr>
                <th>Id</th>
                <th>Approval No.</th>
                <th>Content</th>
                <th>Approval date</th>
                <th>Created</th>
                <th class="actions"><?php echo __('Actions'); ?></th>
             </tr>
           </thead>
          <tbody>
        <?php
        foreach ($application['AnnualLetter'] as $anl): ?>
        <tr class="">
            <td><?php echo h($anl['id']); ?>&nbsp;</td>
            <td><?php echo h($anl['approval_no']); ?>&nbsp;</td>
            <td><?php   echo strip_tags(str_replace("\\n", "&nbsp;", $anl["content"])); ?> &nbsp;  </td>
            <td><?php echo h($anl['approval_date']); ?>&nbsp;</td>
            <td><?php echo h($anl['created']); ?>&nbsp;</td>
            <td class="actions">
                <?php 
                    echo $this->Html->link('<span class="label label-success"> View </span>',
                     array('action' => 'view', $application['Application']['id'], 'anl' => $anl['id']), array('escape'=>false));
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <hr>

    <?php
    if(isset($this->params['named']['anl'])) {
        foreach ($application['AnnualLetter'] as $akey => $annual_letter) {
            if ($annual_letter['id'] == $this->params['named']['anl']) {               
    ?>
    <div class="ctr-groups">
        <?php   echo $anl["content"]; ?> &nbsp;
    </div>
    <?php
          }
        }
      }
    ?>