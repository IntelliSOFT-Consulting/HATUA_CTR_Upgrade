<?php
$this->Html->script('multi/safety_dsmb', array('inline' => false));
?>
<div class="row-fluid">
    <div class="span12">
        
        <hr>

        <h5><i class="icon-file"></i> Click on the button to add the files:
            <button type="button" class="btn-mini" id="addDsbm">&nbsp;<i class="icon-plus"></i>&nbsp;</button>
        </h5>
        <table id="builddsmbform" class="table table-bordered  table-condensed table-striped">
            <thead>
                <tr id="attachmentsTableHeader">
                    <th>#</th>
                    <th width="45%">File</th>
                    <th width="45%">Text Description</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($this->request->data['Attachment'])) {
                    for ($i = 0; $i <= count($this->request->data['Attachment']) - 1; $i++) {
                ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td>
                                <div class="control-group">
                                    <?php
                                    echo $this->Form->input('Attachment.' . $i . '.id');
                                    echo $this->Form->input('Attachment.' . $i . '.model', array('type' => 'hidden', 'value' => 'Application'));
                                    echo $this->Form->input('Attachment.' . $i . '.group', array('type' => 'hidden', 'value' => 'attachment'));
                                    echo $this->Form->input('Attachment.' . $i . '.filesize', array('type' => 'hidden'));
                                    echo $this->Form->input('Attachment.' . $i . '.basename', array('type' => 'hidden'));
                                    echo $this->Form->input('Attachment.' . $i . '.checksum', array('type' => 'hidden'));
                                    if (
                                        !empty($this->request->data['Attachment'][$i]['id']) &&
                                        !empty($this->request->data['Attachment'][$i]['basename'])
                                    ) {
                                        echo $this->Html->link(
                                            __($this->request->data['Attachment'][$i]['basename']),
                                            array(
                                                'controller' => 'attachments',  'action' => 'download',
                                                $this->request->data['Attachment'][$i]['id'], 'full_base' => true
                                            ),
                                            array('class' => 'btn btn-info')
                                        );
                                        // echo $this->Form->input('Attachment.'.$i.'.filename', array('type' => 'hidden'));
                                    } else {
                                        echo $this->Form->input('Attachment.' . $i . '.file', array(
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
                                    !empty($this->request->data['Attachment'][$i]['id']) &&
                                    !empty($this->request->data['Attachment'][$i]['basename'])
                                ) {
                                    echo $this->request->data['Attachment'][$i]['description'];
                                    echo $this->Form->input('Attachment.' . $i . '.description', array('type' => 'hidden'));
                                } else {
                                    echo $this->Form->input('Attachment.' . $i . '.description', array(
                                        'label' => false, 'between' => false, 'rows' => '1', 'after' => false, 'class' => 'span11',
                                    ));
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn-mini remove-row" value="<?php if (isset($this->request->data['Attachment'][$i]['id'])) {
                                                                                                echo $this->request->data['Attachment'][$i]['id'];
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