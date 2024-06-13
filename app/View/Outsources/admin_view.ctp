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
                <hr>

            </div>
            <?php
            echo $this->Session->flash();


            echo $this->Form->create('Outsource', array(
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

            <!-- Test Section -->

            <div class="ctr-groups">
                <div class="row-fluid">

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
                                        ?> <tr>
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
                                                <td> <?php
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
                        <div class="row-fluid">
                            <?php
                            echo $this->Form->input('approved', array(
                                'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                                'class' => 'approved',
                                'before' => '<div class="control-group">   <label class="control-label required">
                        Approve? <span class="sterix">*</span></label>  <div class="controls">
                        <input type="hidden" value="" id="OutsourceApproved_" name="data[Outsource][approved]"> <label class="radio inline">',
                                'after' => '</label>',
                                'options' => array(2 => 'Yes'),
                                'onclick' => 'showDiv()'
                            ));
                            echo $this->Form->input('approved', array(
                                'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'class' => 'approved',
                                'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                                'before' => '<label class="radio inline">',
                                'after' => '</label>
                            <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                            onclick="$(\'.approved\').removeAttr(\'checked disabled\');hideDiv();">
                            <em class="accordion-toggle">clear!</em></a> </span>
                            </div> </div>',
                                'options' => array(1 => 'No'),
                                'onclick' => 'hideDiv()',
                            )); 
                            
                            ?>
                        </div>

                    <?php  } ?>



                    <!-- End of file attachment -->

                </div>
                <hr>

                <div class="row-fluid" id="divToShow" style="display: none;">
                    <div class="span6">
                        <?php
                        echo $this->Form->input('id');

                        echo $this->Form->input('username', array('label' => array('class' => 'control-label', 'text' => 'Username'),));
                        echo $this->Form->input('name', array('label' => array('class' => 'control-label', 'text' => 'Name'),));
                        echo $this->Form->input('email', array(
                            'type' => 'email',
                            'div' => array('class' => 'control-group required'),
                            'label' => array('class' => 'control-label required', 'text' => 'E-MAIL ADDRESS')
                        ));
                        echo $this->Form->input('sponsor_email', array(
                            'type' => 'email',
                            'div' => array('class' => 'control-group required'),
                            'label' => array('class' => 'control-label required', 'text' => 'Sponsor\'s E-MAIL')
                        ));
                        echo $this->Form->input('qualification', array('label' => array('class' => 'control-label', 'text' => 'Qualification'),));
                        echo $this->Form->input('phone_no', array('label' => array('class' => 'control-label', 'text' => 'Phone Number'),));
                        echo $this->Form->input('name_of_institution', array(
                            'label' => array('class' => 'control-label', 'text' => 'Name of Institution'),
                        ));

                       
                        ?> 
                        <?php
                        
                        echo $this->Form->input('model_sae', array(
                            'type' => 'checkbox',
                            'label' => array('class' => 'control-label', 'text' => 'SAE/SUSAR '),
                            'div' => false,
                            'hiddenField' => false,
                            'checked' => ($outsource['Outsource']['model_sae'] == 1) ? true : false,
                            'disabled' => true,
                            'value' => h($outsource['Outsource']['model_sae']),
                        )) . ' <br>';
                        
                        echo $this->Form->input('model_ciom', array(
                            'type' => 'checkbox',
                            'label' => array('class' => 'control-label', 'text' => 'CIOMS '),
                            'div' => false,
                            'hiddenField' => false,
                            'checked' => ($outsource['Outsource']['model_ciom'] == 1) ? true : false,
                            'disabled' => true,
                            'value' => h($outsource['Outsource']['model_ciom']),
                        )) . '  <br>';
                        
                        echo $this->Form->input('model_dev', array(
                            'type' => 'checkbox',
                            'label' => array('class' => 'control-label', 'text' => 'Deviations '),
                            'div' => false,
                            'hiddenField' => false,
                            'checked' => ($outsource['Outsource']['model_dev'] == 1) ? true : false,
                            'disabled' => true,
                            'value' => h($outsource['Outsource']['model_dev']),
                        )) . '  <br>';
                        ?> 
                    </div><!--/span-->
                    <div class="span6">
                        <?php
                        echo $this->Form->input('institution_physical', array(
                            'label' => array('class' => 'control-label', 'text' => 'Physical Address'),
                            'after' => '<p class="help-block"> Road, street.. </p></div>',
                        ));
                        echo $this->Form->input('institution_address', array('label' => array('class' => 'control-label', 'text' => 'Institution Address'),));
                        echo $this->Form->input('institution_contact', array('label' => array('class' => 'control-label', 'text' => 'Institution Contacts'),));
                        echo $this->Form->input('county_id', array(
                            'label' => array('class' => 'control-label required', 'text' => 'County '),
                            'empty' => true, 'between' => '<div class="controls ui-widget">',
                        ));
                        echo $this->Form->input('country_id', array(
                            'empty' => true,
                            'label' => array('class' => 'control-label', 'text' => 'Country'),
                        ));
                        echo $this->Form->input('is_active', array('checked' => true));

                        ?>
                    
                    </div><!--/span-->
                </div><!--/row-->

                <?php
                echo $this->Form->input('bot_stop', array(
                    'div' => array('style' => 'display:none')
                ));
                echo $this->Form->end(array(
                    'label' => 'Submit',
                    'value' => 'Save',
                    'class' => 'btn btn-primary',
                    'id' => 'OutsourceSaveChanges',
                    'div' => array(
                        'class' => 'form-actions',
                    )
                ));
                ?>
            </div>
            <hr>

            <!-- End of Test Section -->


        </div>
    </div>

</div>
<script>
    function showDiv() {
        // Show the div when "Yes" is clicked
        $('#divToShow').show();
    }

    function hideDiv() {
        // Hide the div when "No" is clicked
        $('#divToShow').hide();
    }
</script>