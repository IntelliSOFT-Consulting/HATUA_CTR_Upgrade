<div class="row-fluid">
    <?php
    $this->assign('Reports', 'active');
    ?>

    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <div class="styled_title">
                    <h5>Verify and Create User</h5>
                </div>
            </div>
            <?php
            echo $this->Session->flash();

            echo $this->Form->create('User', array(
                // 'url' => array('action' => 'assign_protocol', $outsource['Application']['id']),
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
            ?>


            <div class="ctr-groups">

                <div class="row-fluid">
                    <div class="span6">
                        <?php
                        echo $this->Form->input(
                            'username',
                            array(
                                'label' => array('class' => 'control-label required', 'text' => 'Username <span class="sterix">*</span>'),
                                'value' => $outsource['Outsource']['username']
                            )
                        );
                        echo $this->Form->input('name', array(
                            'label' => array('class' => 'control-label', 'text' => 'Name'),
                            'value' => $outsource['Outsource']['username']
                        ));
                        echo $this->Form->input('email', array(
                            'type' => 'email',
                            'div' => array('class' => 'control-group required'),
                            'label' => array('class' => 'control-label required', 'text' => 'E-MAIL ADDRESS <span class="sterix">*</span>'),
                            'value' => $outsource['Outsource']['email']
                        ));
                        echo $this->Form->input(
                            'phone_no',
                            array(
                                'label' => array('class' => 'control-label required', 'text' => 'Phone Number <span class="sterix">*</span>'),
                                'value' => $outsource['Outsource']['phone_no']
                            )
                        );
                        echo $this->Form->input('county_id', array(
                            'label' => array('class' => 'control-label required', 'text' => 'County'),
                            'empty' => true, 'between' => '<div class="controls ui-widget">',
                        ));

                        echo $this->Form->input('is_active', array('checked' => true));
                        ?>
                    </div><!--/span-->
                    <div class="span6">
                        <?php
                        echo $this->Form->input('name_of_institution', array(
                            'label' => array('class' => 'control-label', 'text' => 'Name of Institution'),
                            'value' => $outsource['Outsource']['name_of_institution']
                        ));
                        echo $this->Form->input('institution_physical', array(
                            'label' => array('class' => 'control-label', 'text' => 'Physical Address'),
                            'value' => $outsource['Outsource']['institution_physical'],
                            'after' => '<p class="help-block"> Road, street.. </p></div>',
                        ));
                        echo $this->Form->input('institution_address', array('label' => array('class' => 'control-label', 'text' => 'Institution Address'), 'value' => $outsource['Outsource']['institution_address']));
                        echo $this->Form->input('institution_contact', array('label' => array('class' => 'control-label', 'text' => 'Institution Contacts'),));

                        echo $this->Form->input('country_id', array(
                            'empty' => true,
                            'label' => array('class' => 'control-label required', 'text' => 'Country <span class="sterix">*</span>')
                        ));
                        ?>
                    </div><!--/span-->
                </div><!--/row-->
                <hr>

                <!-- Show the attached files -->
                <?php
                if (count($outsource['Attachment']) > 0) {
                ?>
                 <div class="row-fluid">
                 <div class="span2">
                 </div>
                    <div class="span8">
                        <h5>Supporting Documents </h5>

                    <table id="buildoutsourceform" class="table table-bordered  table-condensed table-striped">
                        <thead>
                            <tr id="attachmentsTableHeader">
                                <th>#</th>
                                <th width="45%">File</th>
                                <th width="45%">Text Description</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($outsource['Attachment'] as $i => $file) {
                            ?>                                <tr>
                                    <td>
                                        <span class="badge badge-info"><?php echo $i + 1; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        echo $this->Html->link(
                                            __($file['basename']),
                                            array('controller' => 'attachments', 'action' => 'download', $file['id'], 'full_base' => true),
                                            array('class' => '')
                                        );
                                        ?>
                                    </td>
                                    <td></td>
                                    <td>  <?php
                                        echo $this->Html->link(
                                            __('Download'),
                                            array('controller' => 'attachments', 'action' => 'download', $file['id'], 'full_base' => true),
                                            array('class' => 'btn btn-sm btn-info')
                                        );
                                        ?></td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                    </div>
                 </div>

                <?php  } ?>



                <!-- End of file attachment -->

                <?php
                echo $this->Form->input('bot_stop', array(
                    'div' => array('style' => 'display:none')
                ));
                echo $this->Form->end(array(
                    'label' => 'Submit',
                    'value' => 'Save',
                    'class' => 'btn btn-primary',
                    'id' => 'ApplicationSaveChanges',
                    'div' => array(
                        'class' => 'form-actions',
                    )
                ));
                ?>
            </div>
        </div>
    </div>

</div>