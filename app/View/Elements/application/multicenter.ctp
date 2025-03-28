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

                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Protocol No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Center Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($application['MultiCenter'] as $center) {
                                            $i++;

                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <!-- here  -->
                                                    <?php

                                                    if (!empty($center['NewApplication']) && isset($center['NewApplication']['protocol_no'], $center['NewApplication']['id'])) {
                                                        $reference = $center['NewApplication']['protocol_no'];
                                                        $action = !empty($center['NewApplication']['submitted']) ? 'view' : 'edit';

                                                        echo $this->Html->link(
                                                            __($reference),
                                                            array('controller' => 'applications', 'action' => $action, $center['NewApplication']['id']),
                                                            array('class' => '', 'confirm' => 'Are you sure you want to navigate to the site protocol?', 'target' => '_blank')
                                                        );
                                                    } ?>

                                                </td>
                                                <td><?php echo $center['CoPI']['name']; ?></td>
                                                <td><?php echo $center['CoPI']['email']; ?></td>
                                                <td><?php echo $center['site_name']; ?></td>

                                                <td><?php echo $center['status']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($center['status'] === 'Approved') {

                                                        if (!empty($center['NewApplication']) && isset($center['NewApplication']['protocol_no'], $center['NewApplication']['id'])) {
                                                            $reference = $center['NewApplication']['protocol_no'];
                                                            if ($this->fetch('is-applicant') == 'true') {
                                                                $action = !empty($center['NewApplication']['submitted']) ? 'view' : 'edit';
                                                            } else {
                                                                $action = 'view';
                                                            }

                                                            echo $this->Html->link(
                                                                __('View'),
                                                                array('controller' => 'applications', 'action' => $action, $center['NewApplication']['id']),
                                                                array('class' => 'btn btn-mini btn-primary', 'confirm' => 'Are you sure you want to navigate to the site protocol?', 'target' => '_blank')
                                                            );
                                                        }
                                                    } else { ?>
                                                        <?php
                                                        echo $this->Html->link(
                                                            '<i class="icon-edit"></i>Edit</label>',
                                                            array('action' => 'view', $application['Application']['id'], 'center_edit' => $center['id']),
                                                            array('escape' => false, 'class' => 'btn btn-mini btn-success')
                                                        );
                                                        ?> &nbsp; <?php
                                                                    echo $this->Form->postLink(
                                                                        __('<i class="icon-trash"></i> Delete'),
                                                                        array('action' => 'delete_center', $center['id'], $application['Application']['id']),
                                                                        array('escape' => false, 'class' => 'btn btn-danger btn-mini'),
                                                                        __('Are you sure you want to delete this multi site # %s? You will not be able to recover it later.', $center['id'])
                                                                    );
                                                                } ?>
                                                </td>
                                            </tr>


                                    </tbody>
                                <?php
                                        }
                                ?>
                                </table>


                            </div>

                            <!-- Start -->

                            <?php
                            if (isset($this->params['named']['center_edit']))  $cid = $this->params['named']['center_edit'];

                            if (isset($this->params['named']['center_edit'])) {
                                foreach ($application['MultiCenter'] as $akey => $aucdata) {
                                    if ($aucdata['id'] == $cid) {  ?>

                                        <div class="row-fluid">
                                            <div class="span10">
                                                <hr>
                                                <h5>Modify Multi Center Request</h5>

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

                                                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $aucdata['id']));
                                                echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
                                                ?>
                                                <?php

                                                echo $this->Form->input('site_name', array(
                                                    'label' => array('class' => 'control-label', 'text' => 'Site Name'),
                                                    'value' => $aucdata['site_name'],

                                                ));
                                                echo $this->Form->input('name', array(
                                                    'label' => array('class' => 'control-label', 'text' => 'Name'),
                                                    'id' => 'name',
                                                    'value' => $aucdata['CoPI']['name'],
                                                ));
                                                echo $this->Form->input('owner_id', array(
                                                    'type' => 'hidden',
                                                    'label' => array('class' => 'control-label', 'text' => 'User Id'),
                                                    'value' => $this->Session->read('Auth.User.id'),
                                                ));
                                                echo $this->Form->input('user_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $aucdata['CoPI']['id'],
                                                    'label' => array('class' => 'control-label', 'text' => 'User Id'),
                                                    'id' => 'user_id',
                                                ));
                                                echo $this->Form->input('email', array(
                                                    'type' => 'email',
                                                    'value' => $aucdata['CoPI']['email'],
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
                                                    'onclick' => "return confirm('Are you sure you wish to edit the report?.');",
                                                    'class' => 'btn btn-info mapop',
                                                    'id' => 'ApplicationSubmitReport',
                                                    'title' => 'Save and Submit Report',
                                                    'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                                    'div' => false,
                                                ));

                                                echo $this->Form->end();
                                                ?>
                                            </div>
                                        </div>
                            <?php }
                                }
                            } ?>

                            <!-- End -->
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

                                echo $this->Form->input('site_name', array(
                                    'label' => array('class' => 'control-label', 'text' => 'Site Name'),

                                ));
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