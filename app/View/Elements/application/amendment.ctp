<?php
$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
$this->Html->script('jUpload/vendor/jquery.ui.widget.js', array('inline' => false));
$this->Html->script('jUpload/jquery.iframe-transport.js', array('inline' => false));
$this->Html->script('jUpload/jquery.fileupload.js', array('inline' => false));
$this->Html->script('jquery.blockUI.js', array('inline' => false));
$this->Html->script('bootstrap-editable', array('inline' => false));
$this->Html->css('bootstrap-editable', null, array('inline' => false));
//Only meant for applicant
// $this->Html->script('multi/amendment_checklist', array('inline' => false));
$this->Html->script('multi/approval_year', array('inline' => false));
$this->Html->script('multi/documents', array('inline' => false));
$this->Html->script('multi/afro_attachments', array('inline' => false));
?>


<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
            </div>
            <div class="box-content">
                <div class="span12">
                    <?php

                    echo $this->Form->create('Amend', array(
                        'type' => 'file',
                        // 'url' => array('controller' => 'amendments', 'action' => 'basic_add', $current, $application['Application']['id']),
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
                    echo $this->Form->input('cover_letter', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '1. Cover letter <span class="sterix">*</span>'),
                        'between' => '<div class="nocontrols">',
                        'placeholder' => '',
                        'class' => 'input-xxlarge',
                    ));

                    echo $this->Form->input('summary', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '2. Summary of the proposed amendments <span class="sterix">*</span>'),
                        'between' => '<div class="nocontrols">',
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('reason', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '3. Reason for the amendment <span class="sterix">*</span>'),
                        'between' => '<div class="nocontrols">',
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('objectives_impacts', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '4. Impact of the amendment on the original study objectives <span class="sterix">*</span>'),
                        'between' => '<div class="nocontrols">',
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('endpoints_impacts', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '5. Impact of the amendments on the study endpoints and data generated <span class="sterix">*</span>'),
                        'between' => '<div class="nocontrols">',
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('safety_impacts', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '6. Impact of the proposed amendments on the safety and wellbeing of study participants <span class="sterix">*</span>'),
                        'between' => '<div class="nocontrols">',
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                    ));


                    ?>
 

                    <div class="form-actions" style="margin-top: 0px; padding-left: 10px;">
                        <?php
                        echo $this->Form->button('Save Changes', array(
                            'name' => 'saveChanges',
                            'class' => 'btn btn-success',
                            'style' => 'margin-right: 10px;',
                            'id' => 'SadrSaveChanges',
                            'title' => 'Save & continue editing',
                            'data-content' => 'Save changes to form without submitting it.
																		The form will still be available for further editing.',
                            'div' => false,
                        ));

                        echo $this->Form->button('Submit', array(
                            'name' => 'submitReport',
                            'onclick' => "return confirm('Are you sure you wish to submit the amendment to PPB? You will not be able to edit it later.');",
                            'class' => 'btn btn-primary',
                            'style' => 'margin-right: 10px;',
                            'id' => 'ApplicationSubmitReport',
                            'title' => 'Save and Submit Report',
                            'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                            'div' => false,
                        ));


                        ?>
                    </div>
                    <hr>

                    <?php
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script text="type/javascript">
    $.expander.defaults.slicePoint = 170;
    $.fn.editable.defaults.mode = 'popup';
    $(function() {
        CKEDITOR.replace('data[Amend][cover_letter]');
        CKEDITOR.replace('data[Amend][summary]');
        CKEDITOR.replace('data[Amend][reason]');
        CKEDITOR.replace('data[Amend][objectives_impacts]');
        CKEDITOR.replace('data[Amend][endpoints_impacts]');
        CKEDITOR.replace('data[Amend][safety_impacts]');
    });
</script>