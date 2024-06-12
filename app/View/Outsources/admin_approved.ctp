<div class="row-fluid">
    <?php
    $this->assign('Reports', 'active');
    ?>
    <h2><?php echo __('Outsource Requests'); ?></h2>
    <?php
    echo $this->Form->create('Outsource', array(
        'url' => array_merge(array('action' => 'approved'), $this->params['pass']),
        'class' => 'ctr-groups', 'style' => array('padding:9px;', 'background-color: #F5F5F5'),
    ));
    ?>
    <div class="row-fluid">
        <div class="span4">
            <?php
            echo $this->Form->input('filter', array(
                'div' => false, 'class' => 'span12 unauthorized_index',
                'label' => array('class' => 'required', 'text' => 'Email / Name / Username'),
                'type' => 'text',
            ));
            ?>
        </div>
        <div class="span4">
            <?php
            echo $this->Form->input(
                'start_date',
                array(
                    'div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index', 'after' => '-to-',
                    'label' => array('class' => 'required', 'text' => 'Request Dates'), 'placeHolder' => 'Start Date'
                )
            );
            echo $this->Form->input(
                'end_date',
                array(
                    'div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index',
                    'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                        <em class="accordion-toggle">clear!</em></a>',
                    'label' => false, 'placeHolder' => 'End Date'
                )
            );
            ?>
        </div>
        <div class="span2">
            <?php
            echo $this->Form->input('pages', array(
                'type' => 'select', 'div' => false, 'class' => 'span12', 'selected' => $this->request->params['paging']['Outsource']['limit'],
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
            ?>
        </div>
    </div>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Outsources out of
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
            echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
            ?>
        </ul>
    </div>
    <table class="table  table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('username'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('email'); ?></th>
                <th><?php echo $this->Paginator->sort('Protocol'); ?></th>
                <th><?php echo $this->Paginator->sort('tasks'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) : ?>
                <tr class="">
                    <td><?php echo h($user['Outsource']['id']); ?>&nbsp;</td>
                    <td><?php echo h($user['Outsource']['username']); ?>&nbsp;</td>
                    <td><?php echo h($user['Outsource']['name']); ?>&nbsp;</td>
                    <td><?php echo h($user['Outsource']['email']); ?>&nbsp;</td>
                    <td><?php echo h($user['Application']['protocol_no']); ?>&nbsp;</td>
                    <td>                    
                        <input type="checkbox" name="selected_protocols[]" value="<?php echo h($user['Outsource']['model_sae']); ?>" <?php echo ($user['Outsource']['model_sae'] == 1) ? 'checked' : ''; ?> disabled> SAE/SUSAR <br>
                        <input type="checkbox" name="selected_protocols[]" value="<?php echo h($user['Outsource']['model_ciom']); ?>" <?php echo ($user['Outsource']['model_ciom'] == 1) ? 'checked' : ''; ?> disabled> CIOMS <br>
                        <input type="checkbox" name="selected_protocols[]" value="<?php echo h($user['Outsource']['model_dev']); ?>" <?php echo ($user['Outsource']['model_dev'] == 1) ? 'checked' : ''; ?> disabled> Deviations <br>


                    </td>
                    <td><?php echo h($user['Outsource']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('<label class="label label-info">Assign Study</label>'), array('controller'=>'protocol_outsources','action' => 'view', $user['User']['id']), array('escape' => false)); ?>


                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>