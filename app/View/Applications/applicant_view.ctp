<?php
$this->extend('/Elements/application/applicant_view');
?>

<?php $this->start('amendment-lead'); ?>
<?php
$this->assign('MyApplications', 'active');
$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
$this->Html->script('jUpload/vendor/jquery.ui.widget.js', array('inline' => false));
$this->Html->script('jUpload/jquery.iframe-transport.js', array('inline' => false));
$this->Html->script('jUpload/jquery.fileupload.js', array('inline' => false));
$this->Html->script('jquery.blockUI.js', array('inline' => false));
$this->Html->script('bootstrap-editable', array('inline' => false));
$this->Html->css('bootstrap-editable', null, array('inline' => false));
//Only meant for applicant
// $this->Html->script('multi/amendmentchecklist', array('inline' => false));
$this->Html->script('multi/approval_year', array('inline' => false));
$this->Html->script('multi/documents', array('inline' => false));
$this->Html->script('multi/afro_attachments', array('inline' => false));

$reviewers_comments = 0;
foreach ($application['Review'] as $review) {
    if ($review['type'] == 'ppb_comment') {
        $reviewers_comments++;
    }
}
$this->assign('is-applicant', 'true');
?>
<?php
echo $this->Session->flash();
?>
<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Application</a></li>
        <?php if ($application['Application']['is_child'] == 0) { ?>
            <li><a href="#multicenter" data-toggle="tab">Multi Centers (<?php echo count($application['MultiCenter']) ?>)</a></li>
        <?php }
        if ($application['Application']['user_id'] == $this->Session->read('Auth.User.id')) { ?>
            <li><a href="#outsourcing" data-toggle="tab">Grant Access </a></li>
        <?php } ?>
        <li><a href="#tab17" data-toggle="tab">Screening</a></li>
        <li><a href="#amendments" data-toggle="tab">Amendments</a></li>
        <li><a href="#tab2" data-toggle="tab">Reviewers&rsquo; Comments <small></small></a></li>
        <li><a href="#tab6" data-toggle="tab">Site Inspections (<?php echo count($application['SiteInspection']) ?>)</a></li>
        <?php
        //}

        $sae = count($application['Sae']);
        $gen = count($application['SafetyReportGen']);
        $dsmb = count($application['SafetyReportDSMB']);
        $dsur = count($application['SafetyReportDSUR']);
        $line = count($application['SafetyReportLINE']);
        $safety = $sae + $gen + $dsmb + $dsur + $line;

        ?>
        <li><a href="#tab7" data-toggle="tab">Safety Reports (<?php echo $safety ?>)</a></li>
        <li><a href="#tab15" data-toggle="tab">CIOMS E2B (<?php echo count($application['Ciom']) ?>)</a></li>
        <li><a href="#tab13" data-toggle="tab">Protocol Deviations (<?php echo count($application['Deviation']) ?>)</a></li>

        <li><a href="#tab8" data-toggle="tab" style="color: #52A652;">Annual Approval Checklist</a></li>
        <li><a href="#tab10" data-toggle="tab" style="color: #52A652;">Annual Participants Flow</a></li>
        <li><a href="#tab14" data-toggle="tab" style="color: #52A652;">Manufacturing Site(s)</a></li>
        <li><a href="#tab12" data-toggle="tab" style="color: #5e3ed3;">Approval Letters</a></li>
        <?php if ($application['Application']['approved'] == 2) { ?>
            <li><a href="#tab9" data-toggle="tab" style="color: #15189d;">Final Study Report</a></li>
        <?php
        } ?>
        <?php
        $targets = ["3", "4"];
        if (isset($application['Application']['trial_status_id']) && in_array($application['Application']['trial_status_id'], $targets)) {

        ?>
            <li><a href="#termination" data-toggle="tab" style="color: #15189d;">Termination Letter</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content my-tab-content">
        <div class="tab-pane active" id="tab1">
            <!-- content for tab1 comes here -->

            <div class="row-fluid">
                <?php if ($application['Application']['submitted'] == 1) { ?>
                    <h4 class="text-success">
                        Submitted Application : (<?php echo $application['Application']['protocol_no']; ?>)
                        &mdash;
                        <small> Created on:
                            <?php
                            echo date('d-m-Y h:i:s a', strtotime($application['Application']['created']));
                            ?>
                        </small>
                    </h4>
                <?php } else { ?>
                    <h4 class="text-success">
                        UnSubmitted Application : &mdash; <small> Created on:
                            <?php
                            echo date('d-m-Y h:i:s a', strtotime($application['Application']['created']));
                            ?>
                        </small>
                    </h4>
                <?php } ?>
            </div>
            <?php $this->end(); ?>

            <?php $this->start('form-header'); ?>
            <div class="span12">
                <?php
                echo $this->Form->create('Amend', array(
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
                ?>
                <?php $this->end(); ?>

                <?php
                $this->start('form-actions');

                if ($application['Application']['submitted'] == 1) {
                ?>
                    <div class="form-actions" style="margin-top: 0px; padding-left: 10px;">
                        <?php
                        $openAmendment = false;
                        foreach ($application['Amendment'] as $key => $value) {
                            if ($value['submitted'] == 0) {
                                $openAmendment = $value['id'];
                                break;
                            }
                        }
                        if ($openAmendment) {
                            echo $this->Html->link(
                                '<i class="icon-edit"></i> Edit Open Amendment',
                                array('controller' => 'amendments', 'action' => 'edit', $openAmendment),
                                array('escape' => false, 'class' => 'btn btn-success',  'style' => 'margin-right: 10px;')
                            );
                        } else {

                            echo $this->Html->link(
                                'New Amendment',
                                array('controller' => 'amendments', 'action' => 'add', $application['Application']['id']),
                                array('escape' => false, 'class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')
                            );
                        }

                        ?>
                        <?php if ($application['Application']['user_id'] == $this->Session->read('Auth.User.id')) { ?>
                            <!-- <a class="btn btn-primary" role="button" data-toggle="collapse" href="#nModal" aria-controls="nModal">New Amendment</a> -->
                            <?php ?>
                            <div id="nModal" class="collapse show">
                                <?php


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
                                    'label' => array('class' => 'control-nolabel required', 'text' => '3 Reason for the amendment <span class="sterix">*</span>'),
                                    'between' => '<div class="nocontrols">',
                                    'placeholder' => ' ',
                                    'class' => 'input-xxlarge',
                                ));
                                echo $this->Form->input('objectives_impacts', array(
                                    'label' => array('class' => 'control-nolabel required', 'text' => '4 Impact of the amendment on the original study objectives <span class="sterix">*</span>'),
                                    'between' => '<div class="nocontrols">',
                                    'placeholder' => ' ',
                                    'class' => 'input-xxlarge',
                                ));
                                echo $this->Form->input('endpoints_impacts', array(
                                    'label' => array('class' => 'control-nolabel required', 'text' => '5 Impact of the amendments on the study endpoints and data generated <span class="sterix">*</span>'),
                                    'between' => '<div class="nocontrols">',
                                    'placeholder' => ' ',
                                    'class' => 'input-xxlarge',
                                ));
                                echo $this->Form->input('safety_impacts', array(
                                    'label' => array('class' => 'control-nolabel required', 'text' => '6 Impact of the proposed amendments on the safety and wellbeing of study participants <span class="sterix">*</span>'),
                                    'between' => '<div class="nocontrols">',
                                    'placeholder' => ' ',
                                    'class' => 'input-xxlarge',
                                ));
                                ?>

                                <div class="row-fluid">
                                    <div class="span12">
                                        <?php echo $this->element('multi/amendment_new'); ?>
                                    </div>
                                </div>

                                <?php

                                // echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                //     'name' => 'submitReport',
                                //     'formnovalidate' => 'formnovalidate',
                                //     'onclick' => "return confirm('Please ensure you\'ve submitted all the required files.');",
                                //     'class' => 'btn btn-info btn-block mapop',
                                //     'id' => 'ApplicationSubmitReport',
                                //     'title' => 'Save and Submit Report',
                                //     'data-content' => 'Save the report and submit it to the pharmacy and Poisons Board. You will also get a copy of this report.',
                                //     'div' => false,
                                // ));
                                echo $this->Html->link(
                                    'Submit',
                                    array('controller' => 'amendments', 'action' => 'add', $application['Application']['id']),
                                    array(
                                        'escape' => false,
                                        'class' => 'btn btn-primary',
                                        'onclick' => "return confirm('Please ensure you\'ve submitted all the required files.');",
                                        'style' => 'margin-right: 10px;'
                                    )
                                );
                                ?>
                                <hr>

                                <?php
                                echo $this->Form->end();
                                ?>
                            </div>
                    <?php
                        }
                    }
                    /**
                     * Check if the current user is the owner and has a invoice_id
                     * **/
                    if (empty($application['Application']['ecitizen_invoice'])) {
                        echo $this->Html->link(
                            __('<i class="icon-download"></i> Generate Invoice'),
                            array('controller' => 'applications', 'action' => 'invoice', $application['Application']['id']),
                            array('escape' => false, 'class' => 'btn pull-right btn-success save-attachment')
                        );
                    } else {
                        $invoice = base64_encode($application['Application']['ecitizen_invoice']);
                        echo '<button class="btn pull-right btn-success save-attachment"><a href="https://prims.pharmacyboardkenya.org/crunch?type=ecitizen_invoice&id=' . $invoice . '"><i class="icon-download"></i> Download Invoice</a></button>';
                    }
                    echo $this->Html->link(
                        __('<i class="icon-download-alt"></i> Download PDF'),
                        array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
                        array('escape' => false, 'class' => 'btn pull-right', 'style' => 'margin-right: 10px;')
                    );


                    ?>
                    </div>


                    <?php
                    $this->end();
                    ?>

                    <?php $this->start('tabs'); ?>
                    <ul>
                        <li><a href="#tabs-1">1. Abstract</a></li>
                        <li><a href="#tabs-2">2. Investigator</a></li>
                        <li><a href="#tabs-3">3. Sponsor</a></li>
                        <li><a href="#tabs-4">4. Participants</a></li>
                        <li><a href="#tabs-5">5. Sites</a></li>
                        <li><a href="#tabs-6">6. Placebo</a></li>
                        <li><a href="#tabs-7">7. Criteria</a></li>
                        <li><a href="#tabs-8">8. Scope</a></li>
                        <li><a href="#tabs-9">9. Design</a></li>
                        <li><a href="#tabs-15">10. Study Budget</a></li>
                        <li><a href="#tabs-10">11. Organizations</a></li>
                        <li><a href="#tabs-11">12. Other details</a></li>
                        <li><a href="#tabs-12">13. Checklist </a></li>
                        <li><a href="#tabs-13">14. Declaration</a></li>
                        <li><a href="#tabs-14">15. Notifications</a></li>
                    </ul>
                    <?php $this->end(); ?>


                    <?php $this->start('view-rightbar'); ?>
            </div>
            <div class="span2">
                <?php
                if ($application['Application']['submitted'] == 1) {
                ?>

                <?php
                }
                ?>
            </div>
            <?php $this->end();  ?>

            <?php $this->start('endjs'); ?>
        </div> <!-- End or bootstrap tab1 -->
        <div class="tab-pane" id="tab2">
            <div class="marketing">
                <div class="row-fluid">
                    <div class="span12">
                        <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
                        <h3 class="text-info" style="text-decoration: underline;">Reviewer's Comments</h3>
                    </div>
                </div>
                <hr class="soften" style="margin: 10px 0px;">
            </div>
            <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
            <p><strong>2. Protocol title: </strong><?php echo $application['Application']['study_title']; ?></p>
            <div class="row-fluid">
                <div class="span12">
                    <h4 class="text-success">Reviewer's Comments
                        <?php
                        echo $this->Html->link(
                            __('<i class="icon-download-alt"></i> Download Comments <small>(PDF)</small>'),
                            array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
                            array('escape' => false, 'class' => 'btn pull-right', 'style' => 'margin-right: 10px;')
                        );
                        ?>
                    </h4>
                    <?php
                    $counter = 0;
                    foreach ($application['Review'] as $review) {
                        $counter++;
                        echo "<hr><span class=\"badge badge-success\">" . $counter . "</span> <small class='muted'>created on: " . date('d-m-Y H:i:s', strtotime($review['created'])) . "</small>";
                        echo "<div style='padding-left: 29px;' class='morecontent'>" . $review['text'] . "</div>";
                        // echo "<br>";
                        echo "<div style='padding-left: 29px;' class='morecontent'>" . $review['recommendation'] . "</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <br>
                    <div class="amend-form">
                        <h5 class="text-center text-info"><u>FEEDBACK</u></h5>
                        <div class="row-fluid">
                            <div class="span8">
                                <?php
                                //Reviews limited to ppb_comment already
                                $var = Hash::extract($application, 'Review.{n}[type=ppb_comment]');
                                $rid = null;
                                if (!empty($var)) $rid = min($var);
                                // debug($rid);
                                if (!empty($rid)) echo $this->element('comments/list', ['comments' => $rid['ExternalComment'], 'show' => false]);
                                ?>
                            </div>
                            <div class="span4 lefty">
                                <?php
                                if (!empty($rid))  echo $this->element('comments/add', [
                                    'model' => [
                                        'model_id' => $application['Application']['id'],
                                        'foreign_key' => $rid['id'],
                                        'model' => 'Review',
                                        'category' => 'external',
                                        'url' => 'add_review_response'
                                    ]
                                ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane" id="tab3">
            <p style="text-align: center;"><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
            <hr class="soften" style="margin: 10px 0px;">
            <div class="row-fluid">
                <h4 class="text-success">Reviewer Comments (<?php echo $count_comments; ?>)</h4>
                <hr>
                <div class="span12">
                    <?php
                    $counter = 0;
                    foreach ($users as $user_id => $user) {
                        $responded = false;

                        foreach ($application['Review'] as $response) {
                            // pr($response);
                            if ($response['user_id'] == $user_id) {
                                if ($response['type'] == 'request' && $response['accepted'] == 'accepted') {
                                    $responded = true;
                                    echo '<h4 style="text-decoration: underline"><i class="icon-check"> </i> ' . $user . '</h4>';
                                    echo '<p style="padding-left: 29px;"><i class="icon-minus"> </i> ' . $response['recommendation'] . '</p>';
                                }

                                if ($response['type'] == 'reviewer_comment') {
                                    echo "<small  style='padding-left: 29px;' class='muted'>created on: " . date('d-m-Y H:i:s', strtotime($response['created'])) . "</small>";
                                    echo "<div style='padding-left: 29px;' class='morecontent'> <i class='icon-comment-alt'></i>
                                          <strong>Comment</strong><br>" . $response['text'] . "</div>";
                                    echo "<div style='padding-left: 29px;' class='morecontent'> <i class=\"icon-comment-alt\"></i>
                                          <strong>Recommendation</strong><br>" . $response['recommendation'] . "</div><hr>";
                                }
                            }
                        }
                        $counter++;
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab4">
            <div class="marketing">
                <div class="row-fluid">
                    <div class="span12">
                        <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
                        <h3 class="text-info" style="text-decoration: underline;">PPB Manager's Comments Form</h3>
                    </div>
                </div>
                <hr class="soften" style="margin: 10px 0px;">
            </div>
            <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
            <p><strong>2. Protocol title: </strong><?php echo $application['Application']['study_title']; ?></p>
            <div class="row-fluid">
                <div class="span12">
                    <p><strong>3. Manager's Comments <small>(<?php echo $my_reviews; ?>)</small></strong></p>
                    <?php
                    $counter = 0;
                    // pr($this->Session->read('Auth.User.id'));
                    foreach ($application['Review'] as $review) {
                        // PPB Manager should be able to see all manager's comments
                        if ($review['type'] == 'ppb_comment') {
                            $counter++;
                            echo "<hr><span class=\"badge badge-success\">" . $counter . "</span> <small class='muted'>
                                created on: " . date('d-m-Y H:i:s', strtotime($review['created'])) . "</small>";
                            echo "<div style='padding-left: 29px;' class='morecontent'>" . $review['text'] . "</div>";
                            echo "<div style='padding-left: 29px;' class='morecontent'>" . $review['recommendation'] . "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab17">
            <div class="marketing">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="text-info">Screening for completeness</h3>
                    </div>
                </div>
                <hr class="soften" style="margin: 10px 0px;">
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <br>
                    <div class="amend-form">
                        <!-- Tab Navigation -->
                        <?php

                        $var = Hash::extract($application, 'ApplicationStage.{n}[stage=Screening]');
                        $eid = null;
                        if (!empty($var)) $eid = min($var);
                        ?>
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="active"><a href="#home" data-toggle="tab">FEEDBACK/QUERIES</a></li>
                            <li><a href="#about" data-toggle="tab">Add Comment</a></li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <?php if (!empty($eid)) echo $this->element('comments/list_expandable', ['comments' => $eid['Comment'], 'category' => true]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="about">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <?php
                                        if (!empty($eid))   echo $this->element('comments/add_plain', [
                                            'model' => [
                                                'model_id' => $application['Application']['id'],
                                                'foreign_key' => $eid['id'],
                                                'model' => 'ApplicationStage',
                                                'category' => 'external',
                                                'message_type' => 'screening_feedback',
                                                'url' => 'add_screening_query',
                                                'type' => 50
                                            ]
                                        ])
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="outsourcing">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('application/outsourcing'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <div class="marketing">
                <div class="row-fluid">
                    <div class="span12">
                        <h2 class="text-info">The Expert Committee on Clinical Trials</h2>
                        <h3 class="text-info" style="text-decoration: underline;">Reviewer's Comments</h3>
                    </div>
                </div>
                <hr class="soften" style="margin: 10px 0px;">
            </div>
            <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
            <p><strong>2. Protocol title: </strong><?php echo $application['Application']['study_title']; ?></p>
            <div class="row-fluid">
                <div class="span12">
                    <h4 class="text-success">Reviewer's Comments
                        <?php
                        echo $this->Html->link(
                            __('<i class="icon-download-alt"></i> Download Comments <small>(PDF)</small>'),
                            array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'view', $application['Application']['id']),
                            array('escape' => false, 'class' => 'btn pull-right', 'style' => 'margin-right: 10px;')
                        );
                        ?>
                    </h4>
                    <?php
                    $counter = 0;
                    foreach ($application['Review'] as $review) {
                        $counter++;
                        echo "<hr><span class=\"badge badge-success\">" . $counter . "</span> <small class='muted'>created on: " . date('d-m-Y H:i:s', strtotime($review['created'])) . "</small>";
                        echo "<div style='padding-left: 29px;' class='morecontent'>" . $review['text'] . "</div>";
                        // echo "<br>";
                        echo "<div style='padding-left: 29px;' class='morecontent'>" . $review['recommendation'] . "</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <br>
                    <div class="amend-form">
                        <h5 class="text-center text-info"><u>FEEDBACK</u></h5>
                        <div class="row-fluid">
                            <div class="span8">
                                <?php
                                //Reviews limited to ppb_comment already
                                $var = Hash::extract($application, 'Review.{n}[type=ppb_comment]');
                                $rid = null;
                                if (!empty($var)) $rid = min($var);
                                // debug($rid);
                                if (!empty($rid)) echo $this->element('comments/list', ['comments' => $rid['ExternalComment'], 'show' => false]);
                                ?>
                            </div>
                            <div class="span4 lefty">
                                <?php
                                if (!empty($rid))  echo $this->element('comments/add', [
                                    'model' => [
                                        'model_id' => $application['Application']['id'],
                                        'foreign_key' => $rid['id'],
                                        'model' => 'Review',
                                        'category' => 'external',
                                        'url' => 'add_review_response'
                                    ]
                                ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane" id="tab6">
            <div class="row-fluid">
                <div class="span12">

                    <?php
                    echo $this->element('/application/inspection_edit');
                    ?>

                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab7">
            <div class="row-fluid">

                <?php echo $this->element('application/safety'); ?>

            </div>
        </div>

        <div class="tab-pane" id="tab15">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('application/ciom'); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab13">
            <div class="row-fluid">
                <div class="span12">

                    <?php echo $this->element('application/deviation'); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab8">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/approval'); ?>
                </div>
            </div>
        </div>


        <div class="tab-pane" id="amendments">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/amendments'); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab9">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/final'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="termination">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/termination'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab10">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/approval_participants'); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab14">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/annual_manufacturers'); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab11">
            <?php echo $this->element('multi/approval_budget'); ?>
        </div>

        <div class="tab-pane" id="tab12">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('multi/annual_letters'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="multicenter">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->element('application/multicenter'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="status">
            <div class="marketing">
                <div class="row-fluid">
                    <div class="span12">
                        <h4 class="text-info">Modify Application Status</h4>
                    </div>
                </div>
                <hr class="soften" style="margin: 10px 0px;">
            </div>

            <div class="row-fluid">

                <!-- Start -->
                <div class="amend-form">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#statuses" data-toggle="tab">Application Status</a></li>
                        <li><a href="#letter" data-toggle="tab">Letters</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="statuses">
                            <div class="row-fluid">
                                <div class="span4">
                                    <?php


                                    echo $this->Form->create('Application', array(
                                        'url' => array('controller' => 'applications', 'action' => 'suspend', $application['Application']['id']),
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

                                    echo $this->Form->input('status', array(
                                        'type' => 'select',
                                        'options' => array(
                                            '1' => 'Recruiting',
                                            '2' => 'Not yet recruiting',
                                            '3' => 'Suspended',
                                            '4' => 'Stopped',
                                            '5' => 'Completed',
                                            '6' => 'In follow-up',
                                            '7' => 'Analysing',
                                            '8' => 'Writing-up',
                                            '9' => 'Application withdrawn'
                                        ),
                                        'empty' => true,
                                        'label' => array('class' => 'control-nolabel required', 'text' => '<h5> Trial Status  <span class="sterix">*</span></h5>'),
                                        'placeholder' => ' ',
                                        'class' => 'input-xxlarge',
                                        'between' => '<div class="nocontrols">',
                                        'escape' => false,
                                    ));
                                    echo $this->Form->input('admin_stopped_reason', array(
                                        'label' => array('class' => 'control-nolabel required', 'text' => '<h5> Reason <span class="sterix">*</span></h5>'),
                                        'placeholder' => ' ',
                                        'class' => 'input-xxlarge',
                                        'between' => '<div class="nocontrols">',
                                        'escape' => false,
                                    ));

                                    echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                        'name' => 'submitReport',
                                        'formnovalidate' => 'formnovalidate',
                                        'onclick' => "return confirm('Are you sure you wish to stop/suspend the protocol?');",
                                        'class' => 'btn btn-info btn-block mapop',
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
                            </div>
                        </div>
                        <div class="tab-pane" id="letter">
                            <div class="row-fluid">
                                <div class="span12">

                                    <!-- button to create new letter -->
                                    <div class="well">
                                        <?php
                                        echo $this->Html->link(
                                            __('<i class="icon-plus"></i> New Letter'),
                                            array('action' => 'letter', $application['Application']['id']),
                                            array('escape' => false, 'class' => 'btn btn-success')
                                        );
                                        ?>
                                    </div>


                                    <table class="table  table-bordered" style="margin-bottom: 1px;">

                                        <thead>
                                            <tr>
                                                <th style="width:3%">ID</th>
                                                <th style="width:3%">Protocol No</th>
                                                <th style="width:3%">Status</th>
                                                <th style="width:3%">User</th>
                                                <th style="width:3%">Created</th>
                                                <th style="width:3%"><?php echo __('Actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($application['Termination'] as $akey => $dd) {
                                            ?>
                                                <tr>

                                                    <td><?php echo $akey + 1; ?></td>
                                                    <td><?php echo $dd['reference_no']; ?></td>
                                                    <td><?php echo ($dd['submitted'] == 0) ? 'Unsubmitted' : 'Submitted'; ?></td>
                                                    <td><?php echo $dd['User']['name']; ?></td>
                                                    <td><?php echo $dd['created']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($dd['submitted'] == 0) {
                                                            echo $this->Html->link(
                                                                '<span class="label label-success"> Edit </span>',
                                                                array('action' => 'view', $application['Application']['id'], 'eterm' => $dd['id']),
                                                                array('escape' => false)
                                                            );
                                                            echo "&nbsp;";
                                                            echo $this->Form->postLink(
                                                                __('<span class="label label-warning"> Delete </span>'),
                                                                array('action' => 'delete_letter', $dd['id']),
                                                                array('escape' => false),
                                                                __('Are you sure you want to delete Application # %s? You will not be able to recover it later.', $dd['id'])
                                                            );
                                                        } else {
                                                            echo "&nbsp;";
                                                            echo $this->Html->link(
                                                                '<span class="label label-info"> View </span>',
                                                                array('action' => 'view', $application['Application']['id'], 'vterm' => $dd['id']),
                                                                array('escape' => false)
                                                            );
                                                            echo "&nbsp;";
                                                            echo $this->Html->link(
                                                                __('<span class="label label-success"> <i class="icon-download-alt"></i>  Download PDF </span>'),
                                                                array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'download_termination', $dd['id']),
                                                                array('escape' => false)
                                                            );
                                                        }
                                                        echo "&nbsp;";

                                                        ?>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <hr>

                            <!-- View Letter -->

                            <?php
                            if (isset($this->params['named']['vterm']))  $cid = $this->params['named']['vterm'];

                            if (isset($this->params['named']['vterm'])) {
                                foreach ($application['Termination'] as $akey => $kk) {
                                    if ($kk['id'] == $cid) {
                            ?>


                                        <div class="span12">
                                            <h4 class="text-info">View Letter</h4>
                                            <hr class="soften" style="margin: 10px 0px;">
                                        </div>
                                        <div class="span12">
                                            <div class="well">
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <p><strong>Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
                                                        <p><strong>Study Title: </strong><?php echo $application['Application']['study_title']; ?></p>
                                                        <p><strong>Letter Reference: </strong><?php echo $kk['reference_no']; ?></p>
                                                        <p><strong>Created on: </strong><?php echo date('d-m-Y h:i:s a', strtotime($kk['created'])); ?></p>
                                                        <hr>
                                                        <p><strong>Letter Content</strong></p>
                                                        <div class="well">
                                                            <?php echo $kk['content']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                            <?php }
                                }
                            } ?>

                            <!-- View Letter -->





                            <?php



                            if (isset($this->params['named']['eterm']))  $cid = $this->params['named']['eterm'];

                            if (isset($this->params['named']['eterm'])) {
                                foreach ($application['Termination'] as $akey => $kk) {
                                    if ($kk['id'] == $cid) {
                            ?>
                                        <div class="row-fluid">
                                            <div class="bs-example">

                                                <?php
                                                $content = $this->requestAction('/pockets/view/51');
                                                echo $this->Form->create('Termination', array(
                                                    'url' => array('controller' => 'applications', 'action' => 'terminate', $application['Application']['id']),
                                                    'type' => 'file',
                                                    'class' => false,
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
                                                echo $this->Form->input('id', ['type' => 'hidden', 'value' => $kk['id']]);
                                                echo $this->Form->input('reference_no', ['type' => 'hidden', 'value' => $application['Application']['protocol_no']]);
                                                echo $this->Form->input('application_id', ['type' => 'hidden', 'value' => $application['Application']['id']]);
                                                echo $this->Form->input('user_id', ['type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')]);
                                                $uniqueId = 'content_' . uniqid();
                                                echo $this->Form->input('content', array(
                                                    'label' => false,
                                                    'value' => $kk['content'],
                                                    // 'value' => $content['Pocket']['content'],
                                                    'between' => '<div class="span12">',
                                                    'class' => 'input-large editor',
                                                    'id' => $uniqueId,
                                                ));
                                                ?>
                                                <div class="form-group">

                                                    <div class="well controls">
                                                        <?php
                                                        echo $this->Form->button('<i class="icon-save"></i> Save Changes', array(
                                                            'name' => 'saveChanges',
                                                            'class' => 'btn btn-success mapop',
                                                            'id' => 'rreviewSaveChanges',
                                                            'title' => 'Save & continue editing',
                                                            'data-content' => 'Save changes to form without submitting it.
                                          The form will still be available for further editing.',
                                                            'div' => false,
                                                        ));
                                                        ?>
                                                        <?php
                                                        echo $this->Form->button('<i class="icon-rocket"></i> Submit', array(
                                                            'name' => 'submitReport',
                                                            'onclick' => "return confirm('Are you sure you wish to submit this letter?');",
                                                            'class' => 'btn btn-primary mapop',
                                                            'id' => 'rreviewSubmitReport',
                                                            'title' => 'Save and Submit Report',
                                                            'data-content' => 'Submit report for peer review and approval.',
                                                            'div' => false,
                                                        ));

                                                        ?>
                                                    </div>
                                                </div>
                                                <?php echo $this->Form->end() ?>

                                                <script type="text/javascript">
                                                    // Ensure CKEditor is initialized on the textarea
                                                    if (typeof CKEDITOR !== 'undefined') {
                                                        CKEDITOR.replace('<?php echo $uniqueId; ?>', {});
                                                    }
                                                </script>
                                            </div> <!-- /bs-example -->
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>

        <!-- Invoice Details -->

        <div class="tab-pane" id="invoice">
            <div class="marketing">
                <div class="row-fluid">
                    <div class="span12">
                        <h4 class="text-info">
                            Invoice Generation : (
                            <span class="xeditable iseditable" id="data[Application][protocol_no]" data-type="text" data-pk="<?php echo $application['Application']['id']; ?>" data-original-title="Update protocol no">
                                <?php echo $application['Application']['protocol_no']; ?></span>
                            ) &mdash;
                            <small>Additional sites</small>
                        </h4>
                    </div>
                </div>
                <hr class="soften" style="margin: 10px 0px;">
            </div>

            <div class="row-fluid">
                <div class="span4">
                    <?php


                    echo $this->Form->create('Application', array(
                        'url' => array('controller' => 'applications', 'action' => 'extra', $application['Application']['id']),
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

                    echo $this->Form->input('total_sites', array(
                        'type' => 'number',
                        'min' => 1,
                        'label' => array('class' => 'control-nolabel required', 'text' => '<h5> Extra Site  <span class="sterix">*</span></h5>'),
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                        'between' => '<div class="nocontrols">',
                        'escape' => false,
                    ));
                    echo $this->Form->input('admin_stopped_reason', array(
                        'label' => array('class' => 'control-nolabel required', 'text' => '<h5> Reason <span class="sterix">*</span></h5>'),
                        'placeholder' => ' ',
                        'class' => 'input-xxlarge',
                        'between' => '<div class="nocontrols">',
                        'escape' => false,
                    ));

                    echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                        'name' => 'submitReport',
                        'formnovalidate' => 'formnovalidate',
                        'onclick' => "return confirm('Are you sure you wish to generate an extra invoice to this protocol?');",
                        'class' => 'btn btn-info btn-block mapop',
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
            </div>
        </div>

        <!-- End of Invoice -->

        <div class="tab-pane" id="tab5">
            <p><strong>1. Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
            <p><strong>2. Study Title: </strong><?php echo $application['Application']['study_title']; ?></p>
            <hr class="soften" style="margin: 10px 0px;">
            <div class="row-fluid">
                <div class="span12">
                    <?php
                    if ($application['Application']['approved'] == 2) {
                        echo "<h2> Approved <h2>";
                    } elseif ($application['Application']['approved'] == 1) {
                        echo "<h2>Rejected</h2>";
                    } else {
                        echo "<h4>Not yet set!</h4>";
                    }
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
        $('#data\\[Application\\]\\[approval_date\\]').editable({
            url: '/admin/applications/view/<?php echo $application["Application"]["id"]; ?>',
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },
            params: function(params) {
                var data = {};
                data['_method'] = 'POST';
                data['data[Application][id]'] = params.pk;
                data[params.name] = params.value;
                return data;
            },
            format: 'dd-mm-yyyy',
            viewformat: 'dd-mm-yyyy',
            datepicker: {
                firstDay: 1
            }
        });

        function traverse_it(obj, enda) {
            for (var prop in obj) {
                if (typeof obj[prop] == 'object') {
                    traverse_it(obj[prop], enda);
                } else {
                    enda.push(obj[prop]);
                }
            }
            return enda;
        }
        $('.iseditable').editable({
            url: '/admin/applications/view/<?php echo $application["Application"]["id"]; ?>',
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },
            params: function(params) {
                var data = {};
                data['_method'] = 'POST';
                // data['data[Application][id]'] = params.pk;
                fieldName = params.name.replace(/\[[\w]*\]$/g, '[id]');
                data[fieldName] = params.pk;
                data[params.name] = params.value;
                return data;
            },
            success: function(response, newValue) {
                if (response.message.message == 'Success') { //record created, response like {"id": 2}
                    //proceed success...
                } else if (response.errors) {
                    //server-side validation error, response like {"errors": {"username": "username already exist"} }
                    //call error
                    /*This if not nested error message*/
                    /*for(var key in response.errors) {
                        if(response.errors.hasOwnProperty(key)) {
                             return response.errors[key].join('<br>');
                        }
                    }*/
                    return traverse_it(response.errors, []).join('\n');
                    // return response.errors.investigator1_email;
                    // config.error.call(this, data.errors);
                }
            },
            validate: function(value) {
                if ($.trim(value) == '') {
                    return 'This field is required';
                }
            }
        });
        // $('.xeditable').editable();
        $("#tabs").tabs({
            cookie: {
                expires: 1
            }
        });
        $(".morecontent").expander();
        $('#ReviewText').ckeditor();
        $('#ReviewRecommendation').ckeditor();

        CKEDITOR.replace('data[Amend][cover_letter]');
        CKEDITOR.replace('data[Amend][summary]');
        CKEDITOR.replace('data[Amend][reason]');
        CKEDITOR.replace('data[Amend][objectives_impacts]');
        CKEDITOR.replace('data[Amend][endpoints_impacts]');
        CKEDITOR.replace('data[Amend][safety_impacts]');
    });
</script>
<?php $this->end(); ?>