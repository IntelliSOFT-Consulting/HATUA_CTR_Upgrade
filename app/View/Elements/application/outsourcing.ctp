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
                        ?>
                        <hr>


                        <div class="row-fluid">
                            <div class="span6">
                                <?php
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
                                ?>

                                <h5>Category <span class="sterix">*</span></h5>

                                <?php
                                echo $this->Form->input('model', array('type' => 'hidden', 'value' => ''));
                                echo $this->Form->error(
                                    'Outsource.model',
                                    'Please select at least one category below',
                                    array('wrap' => 'span', 'class' => 'controls required error', 'escape' => false)
                                );
                                $categoryError = '';
                                if ($this->Form->isFieldError('model')) $categoryError = 'error';
                                echo $this->Form->input('model_sae', array(
                                    'before' => '<div class="control-group ' . $categoryError . '">',
                                    'label' => false, 'div' => false, 'class' => false, 'hiddenField' => false,

                                    'between' => '<div class="controls"><input type="hidden" value="0" id="OutsourceModelSae_" name="data[Outsource][model_sae]">
                                  <label class="checkbox required">',
                                    'after' => 'SAE/SUSAR </label></div></div>',
                                ));

                                echo $this->Form->input('model_ciom', array(
                                    'before' => '<div class="control-group ' . $categoryError . '">',
                                    'label' => false, 'div' => false, 'class' => false, 'hiddenField' => false,
                                    'between' => '<div class="controls"><input type="hidden" value="0" id="OutsourceModelCiom_" name="data[Outsource][model_ciom]">
                                  <label class="checkbox required">',
                                    'after' => 'CIOMS </label></div></div>',
                                ));

                                echo $this->Form->input('model_dev', array(
                                    'before' => '<div class="control-group ' . $categoryError . '">',
                                    'label' => false, 'div' => false, 'class' => false, 'hiddenField' => false,
                                    'between' => '<div class="controls"><input type="hidden" value="0" id="OutsourceModelDev_" name="data[Outsource][model_dev]">
                                  <label class="checkbox required">',
                                    'after' => 'Deviations </label></div></div>',
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
                                echo '<p class="text-success"><i class="icon-check"> </i> ' . $auc['name'] . '<small class="muted">       <a class="btn btn-sm btn-success" role="button" data-toggle="collapse" href="#editModal" aria-controls="editModal"><i class="icon-edit"></i> Edit</a>
                                </small></p>';
                                ?>

                                <div id="editModal" class="collapse show">
                                    <hr>
                                    <h5>Modify Request</h5>
                                    <?php
                                    echo $this->Form->create('OutsourceRequest', array(
                                        'url' => array('controller' => 'applications', 'action' => 'assign_other_protocol', $application['Application']['id']),
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
                                    echo $this->Form->input('outsource_id', array('type' => 'hidden', 'value' => $auc['id']));
                                    echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $auc['user_id']));
                                    ?>

                                    <h5>Category <span class="sterix">*</span></h5>

                                    <?php

                                    $sae_checked = !empty($auc['model_sae']) && $auc['model_sae'] != 0;
                                    $ciom_checked = !empty($auc['model_ciom']) && $auc['model_ciom'] != 0;
                                    $dev_checked = !empty($auc['model_dev']) && $auc['model_dev'] != 0;

                                    echo $this->Form->input('model', array('type' => 'hidden', 'value' => ''));
                                    echo $this->Form->error(
                                        'OutsourceRequest.model',
                                        'Please select at least one category below',
                                        array('wrap' => 'span', 'class' => 'controls required error', 'escape' => false)
                                    );
                                    $categoryError = '';
                                    if ($this->Form->isFieldError('model')) $categoryError = 'error';
                                    echo $this->Form->input('sae', array(
                                        'before' => '<div class="control-group ' . $categoryError . '">',
                                        'label' => false, 'div' => false, 'class' => false, 'hiddenField' => false,

                                        'between' => '<div class="controls"><input type="hidden" value="0" id="OutsourceRequestSae_" name="data[OutsourceRequest][sae]">
                                  <label class="checkbox required">',
                                        'after' => 'SAE/SUSAR </label></div></div>',
                                        'checked' => $sae_checked
                                    ));

                                    echo $this->Form->input('ciom', array(
                                        'before' => '<div class="control-group ' . $categoryError . '">',
                                        'label' => false, 'div' => false, 'class' => false, 'hiddenField' => false,
                                        'between' => '<div class="controls"><input type="hidden" value="0" id="OutsourceRequestCiom_" name="data[OutsourceRequest][ciom]">
                                  <label class="checkbox required">',
                                        'checked' => $ciom_checked,
                                        'after' => 'CIOMS </label></div></div>',
                                    ));

                                    echo $this->Form->input('dev', array(
                                        'before' => '<div class="control-group ' . $categoryError . '">',
                                        'label' => false, 'div' => false, 'class' => false, 'hiddenField' => false,
                                        'between' => '<div class="controls"><input type="hidden" value="0" id="OutsourceRequestDev_" name="data[OutsourceRequest][dev]">
                                  <label class="checkbox required">',
                                        'checked' => $dev_checked,
                                        'after' => 'Deviations </label></div></div>',
                                    ));
                                    ?>

                                    <div class="row-fluid">
                                        <div class="span10">
                                            <?php
                                            echo $this->element('multi/outsource_other');
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
                            </li>


                        <?php } ?>

                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>