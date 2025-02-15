<?php
$this->Html->css('comments', null, array('inline' => false));
$this->Html->script('comments/comments', array('inline' => false));
$this->Html->script('ckeditor/ckeditor', array('inline' => false));
$this->Html->script('ckeditor/adapters/jquery', array('inline' => false)); 
?>

<div class="bs-example">
    <?php

    echo $this->Form->create('Comment', array(
        'url' => array('controller' => 'comments', 'action' => $model['url'], (isset($model['param'])) ? $model['param'] : ''),
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
    <div class="row-fluid">
        <div class="span11">
            <?php
            echo $this->Form->input('model_id', ['type' => 'hidden', 'value' => $model['model_id'], 'escape' => false]);
            echo $this->Form->input('foreign_key', ['type' => 'hidden', 'value' => $model['foreign_key']]);
            echo $this->Form->input('model', ['type' => 'hidden', 'value' => $model['model']]);
            echo $this->Form->input('message_type', ['type' => 'hidden', 'value' => $model['message_type']]);
            echo $this->Form->input('category', ['type' => 'hidden', 'value' => $model['category']]);
            echo $this->Form->input('user_id', ['type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')]);
            if (strpos($model['url'], 'committee') !== false) {
                echo $this->Form->input('sender', ['label' => array('class' => 'required'), 'escape' => false]);
            } else {
                echo $this->Form->input('sender', ['type' => 'hidden', 'value' => $this->Session->read('Auth.User.name')]);
            }
            echo $this->Form->input('subject', ['label' => array('class' => 'required')]);
 
            $uniqueId = isset($uniqueId) ? $uniqueId : 'content_' . uniqid();
            $class = ($model['message_type'] == 'annual_checklist_feedback') ? 'input-large annual_checklist_feedback' : 'input-large editor';
            echo $this->Form->input('content', array(
                'label' => false,
                'between' => '<div class="span12">',
                'class' => $class,
                'id' => $uniqueId,
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
    <div class="form-group">
        <div class="span12">

            <?php
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
        </div>
    </div>
    <?php echo $this->Form->end() ?>
    <script type="text/javascript">
    // Ensure CKEditor is initialized on the textarea
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('<?php echo $uniqueId; ?>', { 
        });
    }
</script>
</div>