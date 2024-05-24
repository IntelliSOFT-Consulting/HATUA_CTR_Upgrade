<div class="row-fluid">
    <div class="span12">
        <?php
        echo $this->Session->flash();
        ?>
        <div class="page-header">
            <div class="styled_title">

            </div>
            <div class="row-fluid">
                <div class="span10">
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#outsourcingModal" aria-controls="outsourcingModal"><i class="icon-user"></i> Allocate Report</a>

                    <div id="outsourcingModal" class="collapse show">

                        <?php
                        echo $this->Form->create('Outsource', array(
                            'url' => array('controller' => 'applications', 'action' => 'assign_protocol', $application['Application']['id']),
                            'type' => 'file',
                            'class' => 'form-horizontal',
                            'inputDefaults' => array(
                                'div' => array('class' => 'control-group'),
                                'label' => array('class' => 'control-label'),
                                'between' => '<div class="controls">',
                                'after' => '</div>',
                                'class' => '',
                                'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                'error' => array('attributes' => array('class' => 'controls help-block')),
                            ),
                        ));
                        echo $this->Form->input('id');
                        echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                        echo $this->Form->input('model', array('type' => 'hidden', 'value' => 'CIOM'));
                        ?>
                        <hr>
                        <?php

                        echo $this->Form->input('username', array(
                            'label' => array('class' => 'control-nolabel required', 'text' => 'Enter Username/Email'),
                            'placeholder' => ' ', 'class' => 'input-xxlarge', 'between' => '<div class="nocontrols">',
                            'escape' => false,
                        ));
                        ?>
                        <?php
                        echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                            'name' => 'submitReport',
                            'formnovalidate' => 'formnovalidate',
                            'onclick' => "return confirm('Are you sure you wish to allocate the report?.');",
                            'class' => 'btn btn-info mapop',
                            'id' => 'ApplicationSubmitReport', 'title' => 'Save and Submit Report',
                            'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                            'div' => false,
                        ));

                        ?>
                        <hr>
                        <?php
                        echo $this->Form->end();
                        ?>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span10">
                    <div class="styled_title">
                        <h5>Assigned Investigators</h5>

                    </div>
                    <ol>
                        <?php

                        foreach ($application['Outsource'] as $key => $auc) { ?>
                            <li>
                                <?php
                                echo '<p class="text-success"><i class="icon-check"> </i> ' . $auc['User']['name'] . '<small class="muted">
            ' . $this->Html->link(__('<small class="muted primary">Revoke</small>'), array('controller' => 'applications', 'action' => 'revoke_assignment',$auc['id'], $application['Application']['id']), array('escape' => false)) . '
           </small></p>';
                                ?>


                            </li>


                        <?php } ?>

                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>