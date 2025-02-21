<!-- Annual Approval Checklists -->
<?php

$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
$this->Html->script('multi/amendment_attachment', array('inline' => false));
$this->Html->script('summary/sum', array('inline' => false));
if ($redir === 'applicant') {
    $this->Html->script('multi/amendment_checklist', array('inline' => false));
    $this->Html->script('multi/extrask', array('inline' => false));
}
?>

<h4 style="background-color: #37732c; color: #fff; text-align: center;">Amendments Checklist </h4>
<p><small>All submitted documents should be version referenced and dated.</small></p>
<table class="table table-bordered table-condensed table-striped">
    <thead>
        <tr>
            <th>Number</th>
            <th class="actions"><?php echo __('Files'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        App::uses('Hash', 'Utility');
        $former = $this->requestAction('/pockets/checklist/amendment');
        $years = array_unique(Hash::extract($application['AmendmentChecklist'], '{n}.year'));
        rsort($years);
        foreach ($years as $year) : ?>
            <tr class="">
                <td><b><?php echo h($year); ?></b></td>
                <td>
                    <?php
                    $f = 0;
                    foreach ($former as $rem => $mer) {
                        $f++;
                        echo "<div id='$rem$year'>";
                        echo "$f. ";
                        echo "$mer<br/>";
                        foreach ($application['AmendmentChecklist'] as $anc) {
                            if ($anc['year'] == $year && $anc['pocket_name'] == $rem) {
                                $id = $anc['id'];
                                echo "&nbsp;&nbsp; <span id='$rem$id'> &nbsp;<i class='icon-file-text-alt'></i> ";
                                echo $this->Html->link(
                                    __($anc['basename']),
                                    array('controller' => 'attachments', 'action' => 'download', $anc['id'], 'full_base' => true),
                                    array('class' => '')
                                );
                                $version_no = $anc['version_no'];
                                $file_date = $anc['file_date'];
                                echo "</span>&nbsp;
                          <span id='version$id' style='margin-left:10px;'>Version: $version_no</span>
                          <span id='fileDate$id' style='margin-left:10px;'>Dated: $file_date</span>
                          <span id='AmendmentChecklist$id' style='margin-left:10px;' class='btn btn-mini'><i class='icon-remove'></i></span>
                          <br>";
                            }
                        }
                        echo "</div>";
                    }
                    echo "<h5>Additional Files</h5>";

                    $ccloop = 0;
                    foreach ($application['AmendmentChecklist'] as $anc) {

                        if ($anc['year'] == $year && $anc['pocket_name'] == '') {
                            $ccloop++;
                            $id = $anc['id'];
                            $version_no = $anc['version_no'];
                            $file_date = $anc['file_date'];
                            $description = $anc['description'];
                            echo "<br>" . $ccloop . ". " . $description . "<br>";
                            echo "&nbsp;&nbsp; <span id='$rem$id'> &nbsp;<i class='icon-file-text-alt'></i> ";
                            echo $this->Html->link(
                                __($anc['basename']),
                                array('controller' => 'attachments', 'action' => 'download', $anc['id'], 'full_base' => true),
                                array('class' => '')
                            );

                            echo "</span>&nbsp;
                      <span id='version$id' style='margin-left:10px;'>Version: $version_no</span>
                      <span id='fileDate$id' style='margin-left:10px;'>Dated: $file_date</span>
                      <span id='AmendmentChecklist$id' style='margin-left:10px;' class='btn btn-mini'><i class='icon-remove'></i></span>
                      <br>";
                        }
                    }

                    echo "<h5>Approval Letters</h5>";
                    if (!empty($year)) {
                        if ($redir === 'manager') { ?>

                            <a class="btn btn-link btn-comment" role="button" data-toggle="collapse" href="#amendment-summary" aria-controls="amendment-summary">Review & Approve</a>

                            <div id="amendment-summary" class="collapse show">
                                <div class="amend-form">
                                    <ul id="rreview_tab" class="nav nav-tabs">
                                        <li class="active"><a href="#amendment_approval">Approval</a></li>
                                        <li><a href="#amendment_summary">Summary Report</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="amendment_approval">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <h4 class="text-success">Approve or Reject Amendment <span class="muted"></span></h4>
                                                    <hr>
                                                    <?php
                                                    echo $this->Form->create('AmendmentApproval', array(
                                                        'url' => array('action' => 'approve', $application['Application']['id']),
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
                                                    echo $this->Form->input('application_id', array('value' => $application['Application']['id'], 'type' => 'hidden'));
                                                    echo $this->Form->input('approval_date', array('value' => date('d-m-Y'), 'type' => 'hidden'));
                                                    echo $this->Form->input('amendment', array('value' =>  $year, 'type' => 'hidden'));
                                                    echo $this->Form->input('status', array(
                                                        'type' => 'radio',
                                                        'label' => false,
                                                        'legend' => false,
                                                        'div' => false,
                                                        'hiddenField' => false,
                                                        'error' => false,
                                                        'class' => 'approved',
                                                        'before' => '<div class="control-group">   <label class="control-label required">
                        Approve? <span class="sterix">*</span></label>  <div class="controls">
                        <input type="hidden" value="" id="ApplicationApproved_" name="data[AmendmentApproval][approved]"> <label class="radio inline">',
                                                        'after' => '</label>',
                                                        'options' => array('approved' => 'Yes'),
                                                    ));
                                                    echo $this->Form->input('status', array(
                                                        'type' => 'radio',
                                                        'label' => false,
                                                        'legend' => false,
                                                        'div' => false,
                                                        'hiddenField' => false,
                                                        'class' => 'approved',
                                                        'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                                                        'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                                                        'before' => '<label class="radio inline">',
                                                        'after' => '</label>
                            <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                            onclick="$(\'.approved\').removeAttr(\'checked disabled\')">
                            <em class="accordion-toggle">clear!</em></a> </span>
                            </div> </div>',
                                                        'options' => array('rejected' => 'No'),
                                                    ));

                                                   
                                                    echo $this->Form->input('password', array(
                                                        'label' => array('class' => 'control-label', 'text' => 'Your Password <span class="sterix">*</span>'),
                                                        'placeholder' => 'password',
                                                        'class' => 'input-large',
                                                    ));
                                                    ?> 
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                                            'name' => 'submit',
                                                            'class' => 'btn btn-primary',
                                                            'id' => 'ApproveProtocol',
                                                        ));
                                                        ?>
                                                    </div>
                                                    <?php
                                                    echo $this->Form->end();

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="amendment_summary">
                                            <div class="row-fluid">
                                                <div class="span12">


                                                    <!-- Start of the Form -->
                                                    <?php
                                                    echo $this->Form->create('AmendmentApproval', array(
                                                        'url' => array('action' => 'approve_amendment', $application['Application']['id']),
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
                                                    echo $this->Form->input('application_id', array('value' => $application['Application']['id'], 'type' => 'hidden'));
                                                    echo $this->Form->input('approval_date', array('value' => date('d-m-Y'), 'type' => 'hidden'));
                                                    echo $this->Form->input('amendment', array('value' =>  $year, 'type' => 'hidden'));
                                                    echo $this->Form->input('status', array('value' =>  'summary', 'type' => 'hidden'));
                                                    echo $this->Form->input('password', array('value' =>    $this->Session->read('Auth.User.confirm_password'), 'type' => 'hidden'));
                                                    ?>

                                                    <div class="row-fluid">
                                                        <div class="span11">
                                                            <div class="uploadsTable">
                                                                <h6 class="muted"><b>Attach File(s) </b>
                                                                    <button type="button" class="btn btn-primary btn-small addUploadAmendmentApproval">&nbsp;<i class="icon-plus"></i>&nbsp;</button>
                                                                </h6>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->button('<i class="icon-thumbs-up"></i> Submit', array(
                                                            'name' => 'submit',
                                                            'class' => 'btn btn-primary',
                                                            'id' => 'ApproveProtocol',
                                                        ));
                                                        ?>
                                                    </div>
                                                    <?php
                                                    echo $this->Form->end();

                                                    ?>
                                                    <!-- End of the Form -->

                                                    <hr>

                                                    <?php
                                                    foreach ($application['AmendmentApprovalSummary'] as $key => $comment) { ?>
                                                        <table class="table table-condensed">
                                                            <tbody>

                                                                <!-- <tr>
                                                                    <th>
                                                                        <p><strong>Message</strong></p>
                                                                    </th>
                                                                    <td>
                                                                        <div>
                                                                            <p class="form-control-static">
                                                                                <?php
                                                                                debug($comment);
                                                                                // exit;
                                                                                echo $comment['content']
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        <p><strong>Status</strong></p>
                                                                    </th>
                                                                    <td>
                                                                        <div>
                                                                            <p class="form-control-static">
                                                                                <?php
                                                                                echo $comment['status']
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr> -->
                                                                <tr>
                                                                    <th>
                                                                        <p> <strong>Attached File(s) </strong> </p>
                                                                    </th>
                                                                    <td>
                                                                        <?php

                                                                        if (isset($comment['AmendmentChecklist'])) {
                                                                            foreach ($comment['AmendmentChecklist'] as $key => $value) {
                                                                                echo '<p>';
                                                                                echo $this->Html->link(
                                                                                    __($value['basename']),
                                                                                    array(
                                                                                        'controller' => 'amendment_approvals',
                                                                                        'action' => 'file_download',
                                                                                        $value['id'],
                                                                                        'admin' => false
                                                                                    ),
                                                                                    array('class' => 'btn btn-link')
                                                                                );
                                                                                echo '</p>';
                                                                            }
                                                                        }

                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php  }
                    }

                    ?>
                    <hr>
                    <table class="table  table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Approval No.</th>
                                <th>Approval date</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $aml = 0;
                            foreach ($application['AmendmentLetter'] as $anl) {
                                $aml++;
                                if ($anl['status'] == $year) {
                            ?>
                                    <tr class="">
                                        <td><?php echo h($anl['id']); ?>&nbsp;</td>
                                        <td><?php echo h($anl['approval_no']); ?>&nbsp;</td>
                                        <td><?php echo h($anl['approval_date']); ?>&nbsp;</td>
                                        <td><?php echo h($anl['expiry_date']); ?>&nbsp;</td>
                                        <td><?php echo h($anl['created']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php
                                            if ($anl['submitted'] == '0') {
                                                if ($redir == 'manager') {
                                                    echo $this->Html->link('<span class="label label-success"> Edit </span>', array('action' => 'view', $application['Application']['id'], 'ame' => $anl['id']), array('escape' => false));
                                                }
                                            } else {
                                                echo $this->Html->link('<span class="label label-info"> View </span>', array('action' => 'view', $application['Application']['id'], 'aml' => $anl['id']), array('escape' => false));
                                            }

                                            echo "&nbsp;";
                                            if ($anl['submitted'] == '0') {
                                                if ($redir == 'manager') {
                                                    echo $this->Html->link('<span class="label label-warning"> Approve </span>', array('controller' => 'amendment_letters', 'action' => 'capprove', $anl['id']), array('escape' => false));
                                                }
                                            }
                                            echo "&nbsp;";
                                            echo $this->Html->link('<span class="label label-inverse"> Download PDF </span>', array('controller' => 'amendment_letters', 'action' => 'download', $anl['id'], 'ext' => 'pdf',), array('escape' => false));

                                            ?>
                                        </td>
                                    </tr>

                            <?php }
                            } ?>
                        </tbody>
                    </table>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr>

<!--  -->
<!-- View approval letter -->
<?php
if (isset($this->params['named']['aml'])) {
    foreach ($application['AmendmentLetter'] as $akey => $annual_letter) {
        if ($annual_letter['id'] == $this->params['named']['aml']) {
?>
            <div class="ctr-groups">
                <?php echo $anl["content"]; ?> &nbsp;

                <?php
                if (!empty($anl['qrcode'])) {
                    $decodedImage = base64_decode($anl['qrcode']);
                    echo $decodedImage;
                }
                ?>
            </div>
<?php }
    }
} ?>

<!-- Edit approval letter -->

<?php
if (isset($this->params['named']['ame'])) {
    $annual_letter = array('id' => null, 'application_id' => $application['Application']['id'], 'approval_no' => null, 'content' => null, 'approver' => null, 'approval_date' => null, 'expiry_date' => null, 'submitted' => '1');
    if (isset($this->params['named']['ame']) && $this->params['named']['ame'] !== 'new') {
        $annual_letter = min(Hash::extract($application['AmendmentLetter'], '{n}[id=' . $this->params['named']['ame'] . ']'));
    }

?>
    <div class="ctr-groups">
        <?php echo $this->Form->create('AmendmentLetter', array(
            'url' => array('controller' => 'amendment_letters', 'action' => 'approve', $annual_letter['id']),
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
        echo $this->Form->input('id'); ?>
        <fieldset>
            <legend>Approve</strong></legend>
            <?php
            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $annual_letter['id']));
            echo $this->Form->input('submitted', array('type' => 'hidden', 'value' => '1'));
            echo $this->Form->input('content', array(
                'label' => false,
                'value' => $annual_letter['content'],
                'between' => '<div class="controle">',
                'class' => 'input-large',
            ));
            ?>
        </fieldset>
        <?php echo  $this->Form->end(array(
            'label' => 'Approve',
            'value' => 'Approve',
            'class' => 'btn btn-success',
            'div' => array(
                'class' => 'form-actions',
            )
        ));
        ?>
        <script type="text/javascript">
            (function($) {

                $(".datepickers").datepicker({
                    minDate: "-5Y",
                    maxDate: "+999D",
                    dateFormat: 'dd-mm-yy',
                    showButtonPanel: true,
                    changeMonth: true,
                    changeYear: true,
                    //yearRange: "-100Y:+0",
                    buttonImageOnly: true,
                    showAnim: 'show',
                    showOn: 'both',
                    buttonImage: '/img/calendar.gif'
                });
            })(jQuery);

            CKEDITOR.replace('data[AmendmentLetter][content]');
        </script>
    </div>


 
<?php
}?>