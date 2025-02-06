<?php
$this->assign('Applications', 'active');
?>

<div class="row-fluid">
    <?php echo $this->fetch('header'); ?>
    <?php echo $this->Session->flash(); ?>
</div>
<div class="row-fluid">
    <div class="span12">
        <p>Thank you for your interest in registering your application to conduct a clinical trial.</p>
        <p>Your trial will go through various stages until its approved.</p>
        <p>Once your create an application, you are allowed to update it as much as you want before submitting. Please ensure you meet all the requirements of
            the Pharmacy and Poisons Board checklist available here (http://www.pharmacyboardkenya.org/index.php?id=15) before you submit the application.</p>
        <p>Once you submit an application, you will not be able to make further changes to it.</p>

        <hr>
        <div class="row-fluid">
            <div class="thumbnail">
                <?php
                echo $this->Form->create('Application');

                ?>

                <div class="row-fluid">
                    <div class="span4">
                        <?php
                        echo $this->Form->input('email_address', array(
                            'class' => 'input-xlarge',
                            'type' => 'email',
                            'value' => $this->Session->read('Auth.User.email')
                        ));
                        ?>
                    </div>
                    <div class="span4">

                        <?php

                        echo $this->Form->input('total_sites', array(
                            'type' => 'number',
                            'min' => 1,
                            'class' => 'input-xlarge',
                            'label' => array('class' => 'control-label required', 'text' => 'Total Sites <span class="sterix">*</span>'),
                        ));
                        ?>
                    </div>
                    <div class="span4">
                        <?php
                        echo $this->Form->input('short_title', array(
                            'label' => array('class' => 'control-label required', 'text' => 'Short Title <span class="sterix">*</span>'),
                            'maxlength' => 30,
                            'placeholder' => ' ',
                            'class' => 'input-xlarge',
                        ));
                        ?>
                    </div>
                </div>
                <!-- <div id="investigator_primary_contact"> -->

                <h5> PRINCIPAL INVESTIGATOR </h5>

                <?php
                echo $this->Html->tag('hr', '', array('id' => 'InvestigatorContactHr0')); ?>
                <div class="row-fluid">
                    <div class="span4">
                        <?php
                        echo $this->Form->input('InvestigatorContact.0.id');
                        echo $this->Form->input('InvestigatorContact.0.given_name', array(
                            'label' => array('class' => 'control-label required', 'text' => 'Given name <span class="sterix">*</span>'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        ));
                        ?>
                    </div>
                    <div class="span4">
                        <?php
                        echo $this->Form->input('InvestigatorContact.0.middle_name', array(
                            'label' => array('class' => 'control-label', 'text' => 'Middle name, if applicable'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        ));
                        ?>
                    </div>
                    <div class="span4">
                        <?php
                        echo $this->Form->input('InvestigatorContact.0.family_name', array(
                            'label' => array('class' => 'control-label required', 'text' => 'Family name <span class="sterix">*</span>'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        ));
                        ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <?php

                        echo $this->Form->input('InvestigatorContact.0.qualification', array(
                            'label' => array('class' => 'control-label required', 'text' => 'Qualification <span class="sterix">*</span>'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        )); ?></div>
                    <div class="span4">
                        <?php
                        echo $this->Form->input('InvestigatorContact.0.professional_address', array(
                            'label' => array('class' => 'control-label required', 'text' => 'Professional address <span class="sterix">*</span>'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        )); ?></div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <?php
                        echo $this->Form->input('InvestigatorContact.0.telephone', array(
                            'label' => array('class' => 'control-label required', 'text' => 'Telephone number <span class="sterix">*</span>'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        )); ?></div>
                    <div class="span4">
                        <?php
                        echo $this->Form->input('InvestigatorContact.0.email', array(
                            'type' => 'email',
                            'label' => array('class' => 'control-label required', 'text' => 'email address <span class="sterix">*</span>'),
                            'placeholder' => ' ',
                            'class' => 'input-xlarge'
                        )); ?></div>
                </div>
                <?php
                echo $this->Html->tag('hr', '', array('id' => 'InvestigatorContactHr0'));
                ?>
            </div>
        </div>
        <!-- </div> -->
        <?php echo $this->Form->end(array(
            'label' => 'Create',
            'value' => 'Create',
            'class' => 'btn btn-success btn-large',

        ));
        ?>
    </div>
</div>
</div>
</div>