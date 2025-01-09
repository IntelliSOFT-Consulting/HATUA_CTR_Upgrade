<?php
echo $this->Session->flash();

$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
?>

<br>
<div class="row-fluid">
    <div class="span12">

        <ul class="nav nav-tabs" id="myTabs">
            <li class="active"><a href="#tabs-susar" data-toggle="tab">SAE/SUSAR</a></li>
            <li><a href="#tabs-generalized" data-toggle="tab">Generalized safety report</a></li>
            <li><a href="#tabs-line" data-toggle="tab">Line Listings</a></li>
            <li><a href="#tabs-dsurs" data-toggle="tab">DSURs</a></li>
            <li><a href="#tabs-dsmbs" data-toggle="tab">DSMB</a></li>
        </ul>


        <div class="tab-content">
            <div class="tab-pane active" id="tabs-susar">
                <div class="row-fluid">

                    <div class="span12">
                        <?php
                        if ($this->fetch('is-applicant') == 'true') {
                            if ($application['Application']['submitted']) {
                                if ($application['Application']['submitted']) {
                                    echo "<br>";
                                    echo $this->Html->link(
                                        '<i class="icon-list-alt"></i> Create SAE',
                                        array('controller' => 'saes', 'action' => 'add', $application['Application']['id'], 'sae'),
                                        array('escape' => false, 'class' => 'btn btn-success btn-mini')
                                    );
                                    echo "&nbsp;";
                                    echo $this->Html->link(
                                        '<i class="icon-credit-card"></i> Create SUSAR',
                                        array('controller' => 'saes', 'action' => 'add', $application['Application']['id'], 'susar'),
                                        array('escape' => false, 'class' => 'btn btn-primary btn-mini')
                                    );
                                    echo "<br>";
                                    echo "<br>";
                                }
                            }
                        }
                        ?>
                        <table class="table  table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Reference No.</th>
                                    <th>Report Type</th>
                                    <th>Patient Initials</th>
                                    <th>Created</th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($application['Sae'] as $sae) : ?>
                                    <tr class="">
                                        <td><?php echo h($sae['id']); ?>&nbsp;</td>
                                        <td><?php echo h($sae['reference_no']); ?>&nbsp;</td>
                                        <td><?php echo h($sae['report_type']);
                                            if ($sae['report_type'] == 'Followup') {
                                                echo "<br> Initial: ";
                                                echo $this->Html->link(
                                                    '<label class="label label-info">' . substr($sae['reference_no'], 0, strpos($sae['reference_no'], '-')) . '</label>',
                                                    array('controller' => 'saes', 'action' => 'view', $sae['sae_id']),
                                                    array('escape' => false)
                                                );
                                            }
                                            ?>&nbsp;
                                        </td>
                                        <td><?php echo h($sae['patient_initials']); ?>&nbsp;</td>
                                        <td><?php echo h($sae['created']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php



                                            if ($sae['approved'] > 0) echo $this->Html->link(
                                                __('<label class="label label-info">View</label>'),
                                                array('controller' => 'saes', 'action' => 'view', $sae['id']),
                                                array('target' => '_blank', 'escape' => false)
                                            ); ?>
                                            <?php if ($redir === 'applicant' && $sae['approved'] < 1) echo $this->Html->link(__('<label class="label label-success">Edit</label>'), array('controller' => 'saes', 'action' => 'edit', $sae['id']), array('target' => '_blank', 'escape' => false)); ?>
                                            <?php
                                            if ($sae['approved'] < 1) {

                                                //ensure they own 
                                                if ($sae['user_id'] == $this->Session->read('Auth.User.id')) {
                                                    echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('controller' => 'saes', 'action' => 'delete', $sae['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $sae['id']));
                                                }
                                            }
                                            if ($redir === 'applicant' && $sae['approved'] > 0) echo $this->Form->postLink('<i class="icon-facebook"></i> Follow Up', array('controller' => 'saes', 'action' => 'followup', $sae['id']), array('class' => 'btn btn-mini btn-warning', 'escape' => false), __('Create followup for %s?', $sae['reference_no']));
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tabs-generalized">
                <div class="row-fluid">
                    <div class="span12">
                        <?php
                        if ($application['Application']['submitted']) {
                            if ($application['Application']['submitted']) {
                                echo "<br>";
                        ?>
                                <a class="btn btn-success btn-mini" role="button" data-toggle="collapse" href="#gTab" aria-controls="gTab"><i class="icon-plus"></i> Create Generalized Report</a>

                                <div id="gTab" class="collapse show">
                                    <?php

                                    echo $this->Form->create('SafetyReport', array(
                                        'url' => array('controller' => 'applications', 'action' => 'generate_safety_report', $application['Application']['id']),
                                        'type' => 'file',
                                        'class' => 'form-vertical',
                                        'inputDefaults' => array(
                                            'div' => array('class' => 'control-group'),
                                            'label' => array('class' => 'control-label'),
                                            'between' => '<div class="controls">',
                                            'after' => '</div>',
                                            'class' => '',
                                            'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                            'error' => array('attributes' => array('class' => 'controls')),
                                        ),
                                    ));
                                    echo $this->Form->input('id');
                                    echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                                    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                    echo $this->Form->input('safety_type', array('type' => 'hidden', 'value' => 'GEN'));

                                    ?>
                                    <div class="row-fluid">
                                        <div class="span10">
                                            <?php

                                            echo $this->Form->input('title', array(
                                                'label' => array('class' => 'control-nolabel required', 'text' => 'Summary <span class="sterix">*</span>'),
                                                'between' => '<div class="nocontrols">',
                                                'placeholder' => 'summary',
                                                'class' => 'input-large span10',
                                            ));
                                            echo $this->element('multi/generalized');
                                            ?>

                                        </div>
                                    </div>
                                    <?php
                                    echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                        'name' => 'submitReport',
                                        'formnovalidate' => 'formnovalidate',
                                        'onclick' => "return confirm('Are you sure you wish to submit this report?.');",
                                        'class' => 'btn btn-info mapop',
                                        'id' => 'ApplicationSubmitReport',
                                        'title' => 'Save and Submit Report',
                                        'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                        'div' => false,
                                    ));

                                    ?>
                                    <hr>


                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                </div>
                        <?php
                                echo "&nbsp;";
                                echo "<br>";
                                echo "<br>";
                            }
                        }
                        ?>
                        <table class="table  table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Reference</th>
                                    <th>Title</th>
                                    <th>File(s)</th>
                                    <th>Created</th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($application['SafetyReportGen'] as $data) : ?>
                                    <tr class="">
                                        <td><?php echo h($data['id']); ?>&nbsp;</td>
                                        <td><?php echo h($data['reference_no']); ?>&nbsp;</td>
                                        <td><?php echo h($data['title']); ?>&nbsp; </td>
                                        <td><?php
                                            $cc = 0;
                                            foreach ($data['Attachment'] as $i => $file) {
                                                $cc++;
                                                echo $cc . ". " . $this->Html->link(
                                                    __($file['basename']),
                                                    array('controller' => 'attachments', 'action' => 'download', $file['id'], 'full_base' => true),
                                                    array('class' => '')
                                                ) . "<br>";
                                            } ?>
                                            &nbsp;</td>
                                        <td><?php echo h($data['created']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php

                                            //ensure they own 
                                            if ($data['user_id'] == $this->Session->read('Auth.User.id')) {
                                                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('controller' => 'applications', 'action' => 'safety_delete', $data['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $data['id']));
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-line">
                <div class="row-fluid">
                    <div class="span12">
                        <?php
                        if ($application['Application']['submitted']) {
                            if ($application['Application']['submitted']) {
                                echo "<br>";
                        ?>
                                <a class="btn btn-success btn-mini" role="button" data-toggle="collapse" href="#lineTab" aria-controls="lineTab"><i class="icon-plus"></i> Create Line Report</a>

                                <div id="lineTab" class="collapse show">
                                    <?php

                                    echo $this->Form->create('SafetyReport', array(
                                        'url' => array('controller' => 'applications', 'action' => 'generate_safety_report', $application['Application']['id']),
                                        'type' => 'file',
                                        'class' => 'form-vertical',
                                        'inputDefaults' => array(
                                            'div' => array('class' => 'control-group'),
                                            'label' => array('class' => 'control-label'),
                                            'between' => '<div class="controls">',
                                            'after' => '</div>',
                                            'class' => '',
                                            'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                            'error' => array('attributes' => array('class' => 'controls')),
                                        ),
                                    ));
                                    echo $this->Form->input('id');
                                    echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                                    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                    echo $this->Form->input('safety_type', array('type' => 'hidden', 'value' => 'LINE'));

                                    ?>
                                    <div class="row-fluid">
                                        <div class="span10">
                                            <?php

                                            echo $this->Form->input('title', array(
                                                'label' => array('class' => 'control-nolabel required', 'text' => 'Summary <span class="sterix">*</span>'),
                                                'between' => '<div class="nocontrols">',
                                                'placeholder' => 'summary',
                                                'class' => 'input-large span10',
                                            ));
                                            echo $this->element('multi/safety_line');
                                            ?>

                                        </div>
                                    </div>
                                    <?php
                                    echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                        'name' => 'submitReport',
                                        'formnovalidate' => 'formnovalidate',
                                        'onclick' => "return confirm('Are you sure you wish to submit this report?.');",
                                        'class' => 'btn btn-info mapop',
                                        'id' => 'ApplicationSubmitReport',
                                        'title' => 'Save and Submit Report',
                                        'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                        'div' => false,
                                    ));

                                    ?>
                                    <hr>


                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                </div>
                        <?php
                                echo "&nbsp;";
                                echo "<br>";
                                echo "<br>";
                            }
                        }
                        ?>
                        <table class="table  table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Reference</th>
                                    <th>Title</th>
                                    <th>File(s)</th>
                                    <th>Created</th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($application['SafetyReportLINE'] as $data) : ?>
                                    <tr class="">
                                        <td><?php echo h($data['id']); ?>&nbsp;</td>
                                        <td><?php echo h($data['reference_no']); ?>&nbsp;</td>
                                        <td><?php echo h($data['title']); ?>&nbsp; </td>
                                        <td><?php
                                            $k = 0;
                                            foreach ($data['Attachment'] as $i => $file) {
                                                $k++;
                                                echo $k . ". " . $this->Html->link(
                                                    __($file['basename']),
                                                    array('controller' => 'attachments', 'action' => 'download', $file['id'], 'full_base' => true),
                                                    array('class' => '')
                                                ) . "<br>";
                                            } ?>
                                            &nbsp;</td>
                                        <td><?php echo h($data['created']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php
                                            // echo $this->Html->link(
                                            //     __('<label class="label label-info">View</label>'),
                                            //     array('controller' => 'datas', 'action' => 'view', $data['id']),
                                            //     array('target' => '_blank', 'escape' => false)
                                            // ); 
                                            ?>
                                            <?php

                                            //ensure they own 
                                            if ($data['user_id'] == $this->Session->read('Auth.User.id')) {
                                                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('controller' => 'applications', 'action' => 'safety_delete', $data['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $data['id']));
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-dsurs">
                <div class="row-fluid">
                    <div class="span12">
                        <?php
                        if ($application['Application']['submitted']) {
                            if ($application['Application']['submitted']) {
                                echo "<br>";
                        ?>
                                <a class="btn btn-success btn-mini" role="button" data-toggle="collapse" href="#dsurTab" aria-controls="dsurTab"><i class="icon-plus"></i> Create DSUR Report</a>

                                <div id="dsurTab" class="collapse show">
                                    <?php

                                    echo $this->Form->create('SafetyReport', array(
                                        'url' => array('controller' => 'applications', 'action' => 'generate_safety_report', $application['Application']['id']),
                                        'type' => 'file',
                                        'class' => 'form-vertical',
                                        'inputDefaults' => array(
                                            'div' => array('class' => 'control-group'),
                                            'label' => array('class' => 'control-label'),
                                            'between' => '<div class="controls">',
                                            'after' => '</div>',
                                            'class' => '',
                                            'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                            'error' => array('attributes' => array('class' => 'controls')),
                                        ),
                                    ));
                                    echo $this->Form->input('id');
                                    echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                                    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                    echo $this->Form->input('safety_type', array('type' => 'hidden', 'value' => 'DSUR'));

                                    ?>
                                    <div class="row-fluid">
                                        <div class="span10">
                                            <?php

                                            echo $this->Form->input('title', array(
                                                'label' => array('class' => 'control-nolabel required', 'text' => 'Summary <span class="sterix">*</span>'),
                                                'between' => '<div class="nocontrols">',
                                                'placeholder' => 'summary',
                                                'class' => 'input-large span10',
                                            ));
                                            echo $this->element('multi/safety_dsurs');
                                            ?>

                                        </div>
                                    </div>
                                    <?php
                                    echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                        'name' => 'submitReport',
                                        'formnovalidate' => 'formnovalidate',
                                        'onclick' => "return confirm('Are you sure you wish to submit this report?.');",
                                        'class' => 'btn btn-info mapop',
                                        'id' => 'ApplicationSubmitReport',
                                        'title' => 'Save and Submit Report',
                                        'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                        'div' => false,
                                    ));

                                    ?>
                                    <hr>


                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                </div>
                        <?php
                                echo "&nbsp;";
                                echo "<br>";
                                echo "<br>";
                            }
                        }
                        ?>
                        <table class="table  table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Reference</th>
                                    <th>Title</th>
                                    <th>File(s)</th>
                                    <th>Created</th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($application['SafetyReportDSUR'] as $data) : ?>
                                    <tr class="">
                                        <td><?php echo h($data['id']); ?>&nbsp;</td>
                                        <td><?php echo h($data['reference_no']); ?>&nbsp;</td>
                                        <td><?php echo h($data['title']); ?>&nbsp; </td>
                                        <td><?php
                                            $d = 0;
                                            foreach ($data['Attachment'] as $i => $file) {
                                                $d++;
                                                echo $d . ". " . $this->Html->link(
                                                    __($file['basename']),
                                                    array('controller' => 'attachments', 'action' => 'download', $file['id'], 'full_base' => true),
                                                    array('class' => '')
                                                ) . "<br>";
                                            } ?>
                                            &nbsp;</td>
                                        <td><?php echo h($data['created']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php
                                            // echo $this->Html->link(
                                            //     __('<label class="label label-info">View</label>'),
                                            //     array('controller' => 'datas', 'action' => 'view', $data['id']),
                                            //     array('target' => '_blank', 'escape' => false)
                                            // ); 
                                            ?>
                                            <?php

                                            //ensure they own 
                                            if ($data['user_id'] == $this->Session->read('Auth.User.id')) {
                                                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('controller' => 'applications', 'action' => 'safety_delete', $data['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $data['id']));
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tabs-dsmbs">
                <div class="row-fluid">
                    <div class="span12">
                        <?php
                        if ($application['Application']['submitted']) {
                            if ($application['Application']['submitted']) {
                                echo "<br>";
                        ?>
                                <a class="btn btn-success btn-mini" role="button" data-toggle="collapse" href="#dsmbTab" aria-controls="dsmbTab"><i class="icon-plus"></i> Create DSMB Report</a>

                                <div id="dsmbTab" class="collapse show">
                                    <?php

                                    echo $this->Form->create('SafetyReport', array(
                                        'url' => array('controller' => 'applications', 'action' => 'generate_safety_report', $application['Application']['id']),
                                        'type' => 'file',
                                        'class' => 'form-vertical',
                                        'inputDefaults' => array(
                                            'div' => array('class' => 'control-group'),
                                            'label' => array('class' => 'control-label'),
                                            'between' => '<div class="controls">',
                                            'after' => '</div>',
                                            'class' => '',
                                            'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                            'error' => array('attributes' => array('class' => 'controls')),
                                        ),
                                    ));
                                    echo $this->Form->input('id');
                                    echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                                    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
                                    echo $this->Form->input('safety_type', array('type' => 'hidden', 'value' => 'DSMB'));

                                    ?>
                                    <div class="row-fluid">
                                        <div class="span10">
                                            <?php

                                            echo $this->Form->input('title', array(
                                                'label' => array('class' => 'control-nolabel required', 'text' => 'Summary <span class="sterix">*</span>'),
                                                'between' => '<div class="nocontrols">',
                                                'placeholder' => 'summary',
                                                'class' => 'input-large span10',
                                            ));
                                            echo $this->element('multi/safety');
                                            ?>

                                        </div>
                                    </div>
                                    <?php
                                    echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                        'name' => 'submitReport',
                                        'formnovalidate' => 'formnovalidate',
                                        'onclick' => "return confirm('Are you sure you wish to submit this report?.');",
                                        'class' => 'btn btn-info mapop',
                                        'id' => 'ApplicationSubmitReport',
                                        'title' => 'Save and Submit Report',
                                        'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                        'div' => false,
                                    ));

                                    ?>
                                    <hr>


                                    <?php
                                    echo $this->Form->end();
                                    ?>
                                </div>
                        <?php
                                echo "&nbsp;";
                                echo "<br>";
                                echo "<br>";
                            }
                        }
                        ?>
                        <table class="table  table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Reference</th>
                                    <th>Title</th>
                                    <th>File(s)</th>
                                    <th>Created</th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($application['SafetyReportDSMB'] as $data) : ?>
                                    <tr class="">
                                        <td><?php echo h($data['id']); ?>&nbsp;</td>
                                        <td><?php echo h($data['reference_no']); ?>&nbsp;</td>
                                        <td><?php echo h($data['title']); ?>&nbsp; </td>
                                        <td><?php
                                            $ck = 0;
                                            foreach ($data['Attachment'] as $i => $file) {
                                                $ck++;
                                                echo $ck . ". " . $this->Html->link(
                                                    __($file['basename']),
                                                    array('controller' => 'attachments', 'action' => 'download', $file['id'], 'full_base' => true),
                                                    array('class' => '')
                                                ) . "<br>";
                                            } ?>
                                            &nbsp;</td>
                                        <td><?php echo h($data['created']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php
                                            // echo $this->Html->link(
                                            //     __('<label class="label label-info">View</label>'),
                                            //     array('controller' => 'datas', 'action' => 'view', $data['id']),
                                            //     array('target' => '_blank', 'escape' => false)
                                            // ); 
                                            ?>
                                            <?php

                                            //ensure they own 
                                            if ($data['user_id'] == $this->Session->read('Auth.User.id')) {
                                                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('controller' => 'applications', 'action' => 'safety_delete', $data['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $data['id']));
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<hr>