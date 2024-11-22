<!-- <div class="row"> -->
<!-- <div class="col-xs-12"> -->
<?php
   $this->Html->script('ckeditor/ckeditor', array('inline' => false));
   $this->Html->script('ckeditor/adapters/jquery', array('inline' => false));

foreach ($comments as $key => $comment) {
?>
    <a class="btn btn-link btn-comment" role="button" data-toggle="collapse" href="#comment<?php echo $comment['id'] ?>" aria-controls="comment<?php echo $comment['id'] ?>">
        <?php
        if ($redir != 'applicant') {
            echo ($key + 1) . ' ' . $comment['sender'] .   ' <small><em>' . $comment['created'] . '
        </em></small> <br><small class="muted">' . $comment['category'] . '</small>';
        } else {
            echo ($key + 1) . ' <small><em>' . $comment['created'] . '
            </em></small> <br><small class="muted">' . $comment['category'] . '</small>';
        } ?>

    </a>

    <div id="comment<?php echo $comment['id'] ?>" class="bs-example collapse show">
        <table class="table table-condensed">
            <tbody>

                <!-- Hide the identity -->
                <?php if ($redir != 'applicant') { ?>
                    <tr>
                        <th>
                            <p><strong>Sender</strong></p>
                        </th>
                        <td>
                            <div>
                                <p class="form-control-static">
                                    <?php
                                    echo $comment['sender']
                                    ?>
                                </p>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <th>
                        <p><strong>Subject</strong>
                    </th>
                    <td>
                        <p class="form-control-static"><?php echo $comment['subject'] ?></p>

                    </td>
                </tr>
                <tr>
                    <th>
                        <p><strong> Content </strong>

                    </th>
                    <td>
                        <p class="form-control-static"><?php echo $comment['content'] ?></p>
                        <p>
                            <?php

                            if ($category) {
                                if (!empty($comment['qrcode'])) {
                                    $decodedImage = base64_decode($comment['qrcode']);
                                    echo $decodedImage;
                                }
                            }
                            ?>


                        </p>
                    </td>
    </div>
    <tr>
        <th>
            <p> <strong> File(s) </strong> </p>
        </th>
        <td>
            <?php
            if (isset($comment['Attachment'])) {
                foreach ($comment['Attachment'] as $key => $value) {
                    echo '<p>';
                    echo $this->Html->link(
                        __($value['basename']),
                        array(
                            'controller' => 'comments',
                            'action' => 'comment_file_download',
                            $value['id'],
                            'admin' => false
                        ),
                        array('class' => 'btn btn-link')
                    );
                    // echo $this->Html->link($value['basename'], substr($value['file'], 24), ['fullBase' => true]);
                    echo '</p>';
                }
            }

            ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php
            if ($category) {

                echo $this->Html->link(
                    __('<i class="icon-download-alt"></i> Download <small>(PDF)</small>'),
                    array('controller' => 'comments', 'ext' => 'pdf', 'action' => 'comment_content_download', $comment['id']),
                    array('escape' => false, 'class' => 'btn pull-right', 'style' => 'margin-right: 10px;')
                );
            }

            // IF sender and not summitted. allow editing:
            if ($comment['submitted'] != '2' && $comment['user_id'] == $this->Session->read('Auth.User.id')) {
            ?>

                <button type="button" class="btn btn-small btn-info" data-toggle="modal" data-target="#myModal_<?php echo $comment['id']; ?>">
                    <i class="icon-edit"></i>Edit
                </button>
            <?php } ?>
            <!-- Start -->
            <div class="modal fade" id="myModal_<?php echo $comment['id']; ?>">
                <div class="modal-dialog"> 
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Comment</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        </div>
                        <?php

                        echo $this->Form->create('Comment', array(
                            'url' => array(
                                'controller' => 'comments',
                                'action' => 'update_comment_details',
                                $comment['id']
                            ),
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
                        ?>
                        <!-- Modal Body -->
                        <div class="modal-body">

                            <div class="row-fluid">
                                <div class="span11">
                                    <?php

                                    echo $this->Form->input('subject', ['label' => array('class' => 'required'), 'value' => $comment['subject']]);
                                    echo $this->Form->input('id', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['id']]);
                                    echo $this->Form->input('foreign_key', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['foreign_key']]);
                                    echo $this->Form->input('user_id', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['user_id']]);
                                    echo $this->Form->input('model_id', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['model_id']]);
                                    echo $this->Form->input('model', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['model']]);
                                    echo $this->Form->input('category', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['category']]);
                                    echo $this->Form->input('sender', ['label' => array('class' => 'required'), 'type' => 'hidden', 'value' => $comment['sender']]);
                                    echo $this->Form->input('content', array(
                                        'label' => false,
                                        'value' => $comment['content'],
                                        'between' => '<div class="span12">',
                                        'class' => 'input-large editor1',
                                        'id' => 'editor1'
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span11">
                                    <div class="uploadsTable">
                                        <h6 class="muted"><b>Attach File(s) </b>
                                            <button type="button" class="btn btn-primary btn-small addUpload">&nbsp;<i class="icon-plus"></i>&nbsp;</button>
                                        </h6>
                                        <hr>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">

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
                            echo $this->Form->button('<i class="icon-rocket"></i> Submit', array(
                                'name' => 'submitReport',
                                'onclick' => "return confirm('Are you sure you wish to submit the query to this report?');",
                                'class' => 'btn btn-primary mapop',
                                'id' => 'rreviewSubmitReport',
                                'title' => 'Save and Submit Report',
                                'data-content' => 'Submit report for peer review and approval.',
                                'div' => false,
                            ));

                            ?>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        <?php echo $this->Form->end() ?>
                        <script type="text/javascript">
                            $('#editor1').ckeditor();
                            // (function($) {
                            //     $('#editor1').ckeditor();
                            // });
                        </script>
                    </div>
                </div>
            </div>

            <!-- End -->
        </th>
    </tr>
    </tbody>
    </table>
    </div><br>
<?php } ?>