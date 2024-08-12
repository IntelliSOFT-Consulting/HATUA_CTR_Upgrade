<?php
$this->Html->script('multi/amendment_attachment', array('inline' => false));
?>
<div class="row-fluid">
    <div class="span12">
        <hr>

        <h5><i class="icon-file"></i> Do you have files that you would like to send to PPB? click on the button to add them:
            <button type="button" class="btn-mini" id="addAmendment">&nbsp;<i class="icon-plus"></i>&nbsp;</button>
        </h5>
        <table id="buildamendmentform" class="table table-bordered  table-condensed table-striped">
            <thead>
                <tr id="amendmentTableHeader">
                    <th>#</th>
                    <th width="45%">File</th>
                    <th width="45%">Text Description</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($this->request->data['AmendmentChecklist'])) {
                    for ($i = 0; $i <= count($this->request->data['AmendmentChecklist']) - 1; $i++) {
                ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td>
                                <div class="control-group"><?php
                                                            echo $this->Form->input('AmendmentChecklist.' . $i . '.id');
                                                            echo $this->Form->input('AmendmentChecklist.' . $i . '.model', array('type' => 'hidden', 'value' => 'Application'));
                                                            echo $this->Form->input('AmendmentChecklist.' . $i . '.group', array('type' => 'hidden', 'value' => 'attachment'));
                                                            echo $this->Form->input('AmendmentChecklist.' . $i . '.filesize', array('type' => 'hidden'));
                                                            echo $this->Form->input('AmendmentChecklist.' . $i . '.basename', array('type' => 'hidden'));
                                                            echo $this->Form->input('AmendmentChecklist.' . $i . '.checksum', array('type' => 'hidden'));
                                                            if (
                                                                !empty($this->request->data['AmendmentChecklist'][$i]['id']) &&
                                                                !empty($this->request->data['AmendmentChecklist'][$i]['basename'])
                                                            ) {
                                                                echo $this->Html->link(
                                                                    __($this->request->data['AmendmentChecklist'][$i]['basename']),
                                                                    array(
                                                                        'controller' => 'amendment',  'action' => 'download',
                                                                        $this->request->data['AmendmentChecklist'][$i]['id'], 'full_base' => true
                                                                    ),
                                                                    array('class' => 'btn btn-info')
                                                                );
                                                                // echo $this->Form->input('AmendmentChecklist.'.$i.'.filename', array('type' => 'hidden'));
                                                            } else {
                                                                echo $this->Form->input('AmendmentChecklist.' . $i . '.file', array(
                                                                    'label' => false, 'between' => false, 'after' => false, 'class' => 'span12 input-file',
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
                                    !empty($this->request->data['AmendmentChecklist'][$i]['id']) &&
                                    !empty($this->request->data['AmendmentChecklist'][$i]['basename'])
                                ) {
                                    echo $this->request->data['AmendmentChecklist'][$i]['description'];
                                    echo $this->Form->input('AmendmentChecklist.' . $i . '.description', array('type' => 'hidden'));
                                } else {
                                    echo $this->Form->input('AmendmentChecklist.' . $i . '.description', array(
                                        'label' => false, 'between' => false, 'rows' => '1', 'after' => false, 'class' => 'span11',
                                    ));
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn-mini remove-row" value="<?php if (isset($this->request->data['AmendmentChecklist'][$i]['id'])) {
                                                                                                echo $this->request->data['AmendmentChecklist'][$i]['id'];
                                                                                            } ?>">
                                    &nbsp;<i class="icon-minus"></i>&nbsp;
                                </button>
                            </td>
                        </tr>
                <?php }
                }; ?>

            </tbody>
        </table>
    </div><!--/span-->
</div><!--/row-->