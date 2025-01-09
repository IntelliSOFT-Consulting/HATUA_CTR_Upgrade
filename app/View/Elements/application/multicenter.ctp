<?php
$this->Html->script('multicenter', array('inline' => false));
?>

<div class="row-fluid">
    <div class="span12">
        <?php

        echo $this->Session->flash();
        ?>
        <div class="page-header">

            <h3 class="text-info">Multicenters</h3>
            <div class="amend-form">
                <ul class="nav nav-tabs" id="centerTabs">
                    <li class="active"><a href="#ccenters" data-toggle="tab">Current Centers</a></li>
                    <li><a href="#ncenter" data-toggle="tab">New Center</a></li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane active" id="ccenters">
                        <div class="row-fluid">
                            <div class="span12">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="ncenter">
                        <div class="row-fluid">

                            <div class="span12">

                               <!-- start of the form -->

                               <?php
                                echo $this->Form->create('MultiCenter', array(
                                    'url' => array('controller' => 'applications', 'action' => 'create_multi_center', $application['Application']['id']),
                                    'type' => 'file',
                                    'class' => 'form-vertical',
                                    'inputDefaults' => array(
                                        'div' => array('class' => 'control-group'),
                                        'label' => array('class' => 'control-label'),
                                        
                                        'class' => '',
                                        'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                        'error' => array('attributes' => array('class' => 'controls')),
                                    ),
                                ));
                                echo $this->Form->input('id');
                                echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                                ?>
                                <?php
                                echo $this->Form->input('name', array(
                                    'label' => array('class' => 'control-label', 'text' => 'Name'),
                                    'id' => 'name',
                                ));
                                echo $this->Form->input('owner_id', array(
                                    'type' => 'hidden',
                                    'label' => array('class' => 'control-label', 'text' => 'User Id'),
                                    'value' => $this->Session->read('Auth.User.id'),
                                ));
                                echo $this->Form->input('user_id', array(
                                    'type' => 'hidden',
                                    'label' => array('class' => 'control-label', 'text' => 'User Id'),
                                    'id' => 'user_id',
                                ));
                                echo $this->Form->input('email', array(
                                    'type' => 'email',
                                    'div' => array('class' => 'control-group required'),
                                    'label' => array(
                                        'class' => 'control-label required',
                                        'text' => 'E-MAIL ADDRESS <span class="sterix">*</span>'
                                    ),
                                    'id' => 'email',
                                    'autocomplete' => 'off',
                                    'list' => 'email-dropdown',
                                    'after' => '<datalist id="email-dropdown"></datalist>'
                                ));

                                echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                    'name' => 'submitReport',
                                    'formnovalidate' => 'formnovalidate',
                                    'onclick' => "return confirm('Are you sure you wish to allocate the report?.');",
                                    'class' => 'btn btn-info mapop',
                                    'id' => 'ApplicationSubmitReport',
                                    'title' => 'Save and Submit Report',
                                    'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                    'div' => false,
                                ));

                                echo $this->Form->end();
                                ?>

                               <!-- end of the form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 