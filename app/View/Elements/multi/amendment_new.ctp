<!-- Annual Approval Checklists -->
<?php

$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false));
// $this->Html->script('multi/amendment_attachment', array('inline' => false));
$this->Html->script('summary/sum', array('inline' => false));
if ($redir === 'applicant') {
    // $this->Html->script('multi/amends', array('inline' => false));
    // $this->Html->script('multi/amendment_new', array('inline' => false));
}
?> 

<?php

if ($redir == 'applicant') {
    App::uses('Hash', 'Utility');
    $former = $this->requestAction('/pockets/checklist/amendment');
    $years = array_unique(Hash::extract($application['AmendmentChecklist'], '{n}.year'));
    rsort($years);
?>




    <h5>Checklist Form  </h5>
    <ul id="amendment_tab" class="nav nav-tabs">
        <li class="active"><a href="#checkdata">Checklist</a></li>
        <li><a href="#checkfiles">Additional Files</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="checkdata">
            <div class="well">
                <table id="pastyears" class="table table-bordered  table-condensed table-striped">
                    <thead>
                        <tr id="amendsTableHeader">
                            <th>#</th>
                            <th style="width: 10%;">
                                <small class="muted">Amnd No.</small>
                                <?php
                                $options = array(); 
                                    $options['amd-' . $count] = $count;
                                
                                echo $this->Form->input('Fake.year', array(
                                    'type' => 'select', // Change the input type to select
                                    'label' => false,
                                    'between' => false,
                                    'after' => false,
                                    'div' => false,
                                    'options' => $options, // Use the manually created options array
                                    'default' => date('Y'), // Set default value to current year
                                    'data-original-title' => "Click here to change years",
                                    'class' => 'span12 amendmentdatasampleyear tiptip'
                                ));
                                ?>
                            </th>
                            <th style="width: 40%;">Description</th> 
                            <th>File <span class="sterix">*</span></th>
                            <th style="width: 7%">Submit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $key = 0;
                        foreach ($former as $pos => $value) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php $key++;
                                    echo $i; ?></td>
                                <td>
                                    <?php
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.model', array('type' => 'hidden', 'value' => 'AmendmentChecklist'));
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.group', array('type' => 'hidden', 'value' => $pos));
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.filesize', array('type' => 'hidden'));
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.basename', array('type' => 'hidden'));
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.checksum', array('type' => 'hidden'));

                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.year', array(
                                        'type' => 'text',
                                        'label' => false,
                                        'between' => false,
                                        'after' => false,
                                        'div' => false,
                                        'readonly' => 'readonly',
                                        'class' => 'span11 approvalyear'
                                    ));
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.description', array('type' => 'hidden', 'value' => $value));
                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.pocket_name', array('type' => 'hidden', 'value' => $pos));
                                    echo '<p>' . $value . '</p>';
                                    ?>
                                </td>
                                <td class="files"><?php
                                                    echo $this->Form->input('AmendmentChecklist.' . $key . '.file', array(
                                                        'label' => false,
                                                        'between' => false,
                                                        'after' => false,
                                                        'div' => false,
                                                        'class' => 'span12 input-file',
                                                        'error' => array('escape' => false, 'attributes' => array('class' => 'help-block')),
                                                        'type' => 'file',
                                                    ));
                                                    ?>
                                </td> 
                            
                                <td>
                                    <?php
                                    echo $this->Form->button('<i class="icon-save"></i> ', array(
                                        'name' => 'addApproval',
                                        'type' => 'button',
                                        'class' => 'btn btn-primary add-approval tiptip',
                                        'data-original-title' => "Add a file",
                                        'div' => false,
                                    ));
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="checkfiles">
            <div class="span12">

                <p class="selected-year-name"></p>
                <h5><i class="icon-file"></i> Add additional files:
                    <button type="button" class="btn-mini" id="addAttachmentA">&nbsp;<i class="icon-plus"></i>&nbsp;</button>
                </h5>
                <table id="buildamendmentform" class="table table-bordered  table-condensed table-striped">
                    <thead>
                        <tr id="amendmentsTableHeader">
                            <th>#</th>
                            <th width="30%">File</th>
                            <th width="40%">Description</th>
                            <th width="5%">Version</th>
                            <th width="10%">Date</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($this->request->data['AmendmentChecklistOther'])) {
                            for ($i = 0; $i <= count($this->request->data['AmendmentChecklistOther']) - 1; $i++) {
                        ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>
                                        <div class="control-group"><?php
                                                                    echo $this->Form->input('AmendmentChecklistOther.' . $i . '.id');
                                                                    echo $this->Form->input('AmendmentChecklistOther.' . $i . '.model', array('type' => 'hidden', 'value' => 'Application'));
                                                                    echo $this->Form->input('AmendmentChecklistOther.' . $i . '.group', array('type' => 'hidden', 'value' => 'attachment'));
                                                                    echo $this->Form->input('AmendmentChecklistOther.' . $i . '.filesize', array('type' => 'hidden'));
                                                                    echo $this->Form->input('AmendmentChecklistOther.' . $i . '.basename', array('type' => 'hidden'));
                                                                    echo $this->Form->input('AmendmentChecklistOther.' . $i . '.checksum', array('type' => 'hidden'));
                                                                    if (
                                                                        !empty($this->request->data['AmendmentChecklistOther'][$i]['id']) &&
                                                                        !empty($this->request->data['AmendmentChecklistOther'][$i]['basename'])
                                                                    ) {
                                                                        echo $this->Html->link(
                                                                            __($this->request->data['AmendmentChecklistOther'][$i]['basename']),
                                                                            array(
                                                                                'controller' => 'attachments',
                                                                                'action' => 'download',
                                                                                $this->request->data['AmendmentChecklistOther'][$i]['id'],
                                                                                'full_base' => true
                                                                            ),
                                                                            array('class' => 'btn btn-info')
                                                                        );
                                                                    } else {
                                                                        echo $this->Form->input('AmendmentChecklistOther.' . $i . '.file', array(
                                                                            'label' => false,
                                                                            'between' => false,
                                                                            'after' => false,
                                                                            'class' => 'span12 input-file',
                                                                            'error' => array('escape' => false, 'attributes' => array('class' => 'help-block')),
                                                                            'type' => 'file',
                                                                        ));
                                                                    }
                                                                    ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if (
                                            !empty($this->request->data['AmendmentChecklistOther'][$i]['id']) &&
                                            !empty($this->request->data['AmendmentChecklistOther'][$i]['basename'])
                                        ) {
                                            echo $this->request->data['AmendmentChecklistOther'][$i]['description'];
                                            echo $this->Form->input('AmendmentChecklistOther.' . $i . '.description', array('type' => 'hidden'));
                                        } else {
                                            echo $this->Form->input('AmendmentChecklistOther.' . $i . '.description', array(
                                                'label' => false,
                                                'between' => false,
                                                'rows' => '1',
                                                'after' => false,
                                                'class' => 'span11',
                                            ));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $this->Form->input('AmendmentChecklistOther.' . $i . '.version_no', array(
                                            'label' => false,
                                            'between' => false,
                                            'rows' => '1',
                                            'after' => false,
                                            'class' => 'span11',
                                        )); ?>
                                    </td>
                                    <td>
                                        <?php echo $this->Form->input('AmendmentChecklistOther.' . $i . '.file_date', array(
                                            'label' => false,
                                            'between' => false,
                                            'rows' => '1',
                                            'after' => false,
                                            'class' => 'span11',
                                        )); ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn-mini remove-row" value="<?php if (isset($this->request->data['AmendmentChecklistOther'][$i]['id'])) {
                                                                                                        echo $this->request->data['AmendmentChecklistOther'][$i]['id'];
                                                                                                    } ?>">
                                            &nbsp;<i class="icon-minus"></i>&nbsp;
                                        </button>
                                    </td>
                                </tr>
                        <?php }
                        }; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
 

<?php }  ?>

<script text="type/javascript">
    $.expander.defaults.slicePoint = 170;
    $(function() {
        //https://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
        //from mcaz
        $('#amendment_tab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('#amendment_tab a').on("shown", function(e) {
            var id = $(e.target).attr("href");
            localStorage.setItem('assessmentTab', id)
        });

        var assessmentTab = localStorage.getItem('assessmentTab');
        if (assessmentTab != null) {
            $('#amendment_tab a[href="' + assessmentTab + '"]').tab('show');
        }

        var hashTab = $('#amendment_tab a[href="' + location.hash + '"]');
        hashTab && hashTab.tab('show');
        //end mcaz
    });
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Get the button element
        var submitButton = document.getElementById('submit-all-button');

        // Attach a click event listener to the button
        submitButton.addEventListener('click', function(event) {
            // Prevent the default action (stopping the link from navigating immediately)
            event.preventDefault();

            // Get the protocol ID (this value comes from PHP)
            var protocolId = '<?php echo $application['Application']['id']; ?>'; // Example: '77'

            // Get the value from the <p> element (the selected year)
            var selectedYear = document.querySelector('.selected-year-name').textContent.trim();

            // Confirm the submission
            var confirmation = confirm("Are you sure you want to submit all?\nPlease be sure to have uploaded the individual file");

            // Ensure both protocolId and selectedYear are present and confirmed by the user
            if (confirmation && selectedYear) {
                // Construct the correct URL format: /submitall/{protocolId}/{selectedYear}
                var newHref = '/applicant/applications/submitall/' + protocolId + '/' + encodeURIComponent(selectedYear);

                // Navigate to the constructed URL
                window.location.href = newHref;
            } else if (!selectedYear) {
                alert('Please select a year before submitting.');
            }
        });
    });
</script>