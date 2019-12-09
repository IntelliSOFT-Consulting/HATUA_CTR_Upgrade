<?php
    echo $this->Session->flash();
    $this->assign('MEETINGS', 'active');        
    $this->Html->script('jquery.datetimepicker.full', array('inline' => false));
    $this->Html->css('jquery.datetimepicker', null, array('inline' => false));
?>
<div class="sae-form">
  <div class="row-fluid">
    <div class="span12">
        <div class="row-fluid">

            <h4 class="text-center"  style="text-align: center; text-decoration: underline;">PRE-SUBMISSION MEETING REQUEST</h4>
        </div>
        <hr>
    <?php
        echo $this->Form->create('MeetingDate', array(
            'class' => 'form-horizontal',
             'inputDefaults' => array(
                'div' => array('class' => 'control-group'),
                'label' => array('class' => 'control-label'),
                'between' => '<div class="controls">',
                'after' => '</div>',
                'class' => '',
                'format' => array('before', 'label', 'between', 'input', 'after','error'),
                'error' => array('attributes' => array('class' => 'controls help-block')),
             ),
        ));
    ?>

    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span6">
        <?php
            echo $this->Form->input('id');
        ?>
        </div>
        <div class="span4"></div>
    </div>
    <div class="row-fluid">
        <div class="span6">
            <?php
               
                echo $this->Form->input('proposed_date1', array('type' => 'text', 'class' => 'datepickers',
                        'label' => array('class' => 'control-label required', 'text' => 'First proposed date <span class="sterix">*</span>'), ));
            	echo $this->Form->input('email', array('label' => array('class' => 'control-label required', 'text' => 'Email')));    
                
                ?>
        </div><!--/span-->
        <div class="span6">            
            <?php                
                echo $this->Form->input('proposed_date2', array('type' => 'text', 'class' => 'datepickers',
                    'label' => array('class' => 'control-label required', 'text' => 'Second proposed date <span class="sterix">*</span>')
                ));
            	echo $this->Form->input('address', array('label' => array('class' => 'control-label required', 'text' => 'Address')));    
            ?>
        </div><!--/span-->
    </div><!--/row-->
    <h5 class="text-center"  style="text-align: center; text-decoration: underline;">BACKGROUND INFORMATION</h5>
    <div class="row-fluid">
        <div class="span12">
            <?php            
                echo $this->Form->input('disease_background',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Background information on the disease to be treated <span class="sterix">*</span>'),));
                echo $this->Form->input('product_background',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Background information on the product <span class="sterix">*</span>'),));
                echo $this->Form->input('quality_development',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Quality development <span class="sterix">*</span>'),));
                echo $this->Form->input('non_clinical_development',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Non-clinical development <span class="sterix">*</span>'),));
                echo $this->Form->input('regulatory_status',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Regulatory status <span class="sterix">*</span>'),));
                echo $this->Form->input('advice_rationale',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Rationale for seeking advice <span class="sterix">*</span>'),));
                echo $this->Form->input('proposed_questions',
                    array('class' => 'span9',
                        'label' => array('class' => 'control-label required', 'text' => 'Proposed Questions and Applicant\'s positions <span class="sterix">*</span>'),));
            ?>
        </div>
    </div>

     <hr>

    <div class="controls">
      <?php
        echo $this->Form->button('<i class="icon-list-alt"></i> Save Changes', array(
            'name' => 'saveChanges',
            'class' => 'btn btn-success mapop',
            'id' => 'MeetingDateSaveChanges', 'title'=>'Save & continue editing',
            'data-content' => 'Save changes to form without submitting it.
                                        The form will still be available for further editing.',
            'div' => false,
          ));
      ?>
      <?php
        echo $this->Form->button('<i class="icon-credit-card"></i> Submit', array(
            'name' => 'submitReport',
            'onclick'=>"return confirm('Are you sure you wish to submit the report? It will not be editable.');",
            'class' => 'btn btn-primary mapop',
            'id' => 'MeetingDateSubmitReport', 'title'=>'Save and Submit Report',
            'data-content' => 'Submit report to PPB for review.',
            'div' => false,
          ));

      ?>
     </div>

    <?php
        echo $this->Form->end();
        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MeetingDate.id')), 
            array('class' => 'btn btn-danger'), 
            __('Are you sure you want to delete # %s?', $this->Form->value('MeetingDate.id')));
    ?>

    </div>
  </div>
</div>

<script>
    (function( $ ) {

        // $( ".datepickers" ).datepicker({
        //     minDate:"-100Y", minDate:"+21D", dateFormat:'dd-mm-yy', showButtonPanel:true, changeMonth:true, changeYear:true,
        //     yearRange: "+21D:+365D",
        //     buttonImageOnly:true, showAnim:'show', showOn:'both', buttonImage:'/img/calendar.gif'
        // });
        $.datetimepicker.setLocale('en');
        $( ".datepickers" ).datetimepicker({
            minDate:"-1969/12/12", format:'d-m-Y H:i', minTime:'8:00', maxTime:'20:00', step: 15
        });
        // $( ".datepickers" ).datetimepicker({
        //   startDate:'+2020/01/01'//or 1986/12/08
        // });
        // $( ".datepickers" ).datetimepicker();

        
    })( jQuery );

</script>
