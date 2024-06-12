<div class="row-fluid">
    <div class="span12">
        <?php
        echo $this->Session->flash();
        ?>
        <div class="page-header">

            <div class="row-fluid">
                <div class="span11">
                    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#outsourcingModal" aria-controls="outsourcingModal"><i class="icon-user"></i> Outsource Protocol</a>

                    <div id="outsourcingModal" class="collapse show">

                        <?php
                        echo $this->Form->create('Outsource', array(
                            'url' => array('controller' => 'applications', 'action' => 'assign_protocol', $application['Application']['id']),
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
                        // echo $this->Form->input('model', array('type' => 'hidden', 'value' => 'Outsource'));
                        ?>
                        <hr>


                        <div class="row-fluid">
                            <div class="span6">
                                <?php
                                echo $this->Form->input(
                                    'username',
                                    array('label' => array('class' => 'control-label required', 'text' => 'Username <span class="sterix">*</span>'),)
                                );
                                echo $this->Form->input('name', array('label' => array('class' => 'control-label', 'text' => 'Name'),));
                                echo $this->Form->input('email', array(
                                    'type' => 'email',
                                    'div' => array('class' => 'control-group required'),
                                    'label' => array('class' => 'control-label required', 'text' => 'E-MAIL ADDRESS <span class="sterix">*</span>')
                                ));
                                echo $this->Form->input(
                                    'phone_no',
                                    array('label' => array('class' => 'control-label required', 'text' => 'Phone Number <span class="sterix">*</span>'),)
                                );

                                echo $this->Form->input('country_id', array(
                                    'empty' => true,
                                    'label' => array('class' => 'control-label required', 'text' => 'Country <span class="sterix">*</span>')
                                ));
                                echo $this->Form->input('model', array(
                                    'empty' => true,
                                    'label' => array('class' => 'control-label required', 'text' => 'Category <span class="sterix">*</span>'),
                                    'type'=>'select',
                                    'options'=>array(
                                        'SAE/SUSAR'=>'SAE/SUSAR',
                                        'CIOMS'=>'CIOMS',
                                        'Deviations'=>'Deviations'
                                    )
                                ));
                                ?>
                            </div>
                            <div class="span6">
                                <?php
                                echo $this->Form->input('name_of_institution', array(
                                    'label' => array('class' => 'control-label', 'text' => 'Name of Institution'),
                                ));
                                echo $this->Form->input('institution_physical', array(
                                    'label' => array('class' => 'control-label', 'text' => 'Physical Address'),
                                    'after' => '<p class="help-block"> Road, street.. </p></div>',
                                ));
                                echo $this->Form->input('institution_address', array('label' => array('class' => 'control-label', 'text' => 'Institution Address'),));
                                echo $this->Form->input('institution_contact', array('label' => array('class' => 'control-label', 'text' => 'Institution Contacts'),));
                                echo $this->Form->input('county_id', array(
                                    'label' => array('class' => 'control-label required', 'text' => 'County'),
                                    'empty' => true, 'between' => '<div class="controls ui-widget">',
                                ));

                                ?>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span10">
                                <?php
                                 echo $this->element('multi/outsource');
                                ?>

                            </div>
                        </div>

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
                        <h5>Outsourced Investigators</h5>

                    </div>
                    <ol>
                        <?php

                        foreach ($application['Outsource'] as $key => $auc) { ?>
                            <li>
                                <?php
                                echo '<p class="text-success"><i class="icon-check"> </i> ' . $auc['name'] .' : ' .$auc['model'] . '<small class="muted">
            ' . $this->Html->link(__('<small class="muted primary">Revoke</small>'), array('controller' => 'applications', 'action' => 'revoke_assignment', $auc['id'], $application['Application']['id']), array('escape' => false)) . '
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