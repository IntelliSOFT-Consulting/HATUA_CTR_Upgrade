<?php
    $this->Html->script('multi/suspected_drugs', array('inline' => false));
?>
<h5>Suspected Drug(s) (<small>where necessary, Click button to add more -
<button type="button" class="btn btn-small btn-primary" id="addSuspectedDrug">Add Suspected Drug</button></small>) </h5>

<div class="ctr-groups sae-group">
  <div id="primary_suspected_drug">
    <div class="row-fluid">
        <div class="span6">
          <?php
            echo $this->Form->input('SuspectedDrug.0.id');
            echo $this->Form->input('SuspectedDrug.0.generic_name',
                        array('label' => array('class' => 'control-label required', 'text' => 'Generic Name <span class="sterix">*</span>'),));
            echo $this->Form->input('SuspectedDrug.0.dose',
                        array('label' => array('class' => 'control-label required', 'text' => 'Dose <span class="sterix">*</span>'),));
            echo $this->Form->input('SuspectedDrug.0.route_id', 
                        array('empty' => true, 'label' => array('class' => 'control-label required', 'text' => 'Administration Route <span class="sterix">*</span>'),));
            echo $this->Form->input('SuspectedDrug.0.indication',
                        array('label' => array('class' => 'control-label required', 'text' => 'Indication for use <span class="sterix">*</span>'),));
            echo '<div class="control-group">';
            echo '<label class="control-label required">Did reaction abate after stopping drug? <span class="sterix">*</span> </label>';
            echo $this->Form->input('SuspectedDrug.0.reaction_abate', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                      'class' => 'answer0',
                      'before' => '
                        <input type="hidden" value="" id="SuspectedDrug0reaction_abate" name="data[SuspectedDrug][0][reaction_abate]"> <label class="radio inline">',
                      'after' => '</label>',
                      'options' => array('Yes' => 'Yes'),
                    ));                                
            echo $this->Form->input('SuspectedDrug.0.reaction_abate', array(
              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
              'class' => 'answer0',
              'before' => '<label class="radio inline">', 'after' => '</label>',
              'options' => array('No' => 'No')
            ));     
            echo $this->Form->input('SuspectedDrug.0.reaction_abate', array(
              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 
              'class' => 'answer0',
              'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
              'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
              'before' => '<label class="radio inline">',
              'after' => '</label>
                    <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                    onclick="$(\'.answer0'.'\').removeAttr(\'checked disabled\')">
                    <em class="accordion-toggle"><i class="icon-remove-circle"></i> </em></a> </span>
                   ',
              'options' => array('N/A' => 'N/A'),
            ));
            echo '</div>';

          ?>
        </div>
        <div class="span6">          
          <?php
            echo $this->Form->input('SuspectedDrug.0.date_from',
                        array('type' => 'text', 'class' => 'datepickers', 'label' => array('class' => 'control-label required', 'text' => 'Therapy Date <small class="muted">(from)</small>  <span class="sterix">*</span>'),));
            echo $this->Form->input('SuspectedDrug.0.date_to',
                        array('type' => 'text', 'class' => 'datepickers', 'label' => array('class' => 'control-label required', 'text' => 'Therapy Date <small class="muted">(to)</small> '),));
            echo $this->Form->input('SuspectedDrug.0.therapy_duration',
                        array('label' => array('class' => 'control-label required', 'text' => 'Therapy duration'),));
            echo '<div class="control-group">';
            echo '<label class="control-label required">Did reaction reappear after reintroduction? <span class="sterix">*</span> </label>';
            echo $this->Form->input('SuspectedDrug.0.reaction_reappear', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                      'class' => 'reappear0',
                      'before' => '
                        <input type="hidden" value="" id="SuspectedDrug0reappear" name="data[SuspectedDrug][0][reaction_reappear]"> <label class="radio inline">',
                      'after' => '</label>',
                      'options' => array('Yes' => 'Yes'),
                    ));                                
            echo $this->Form->input('SuspectedDrug.0.reaction_reappear', array(
              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
              'class' => 'reappear0',
              'before' => '<label class="radio inline">', 'after' => '</label>',
              'options' => array('No' => 'No')
            ));     
            echo $this->Form->input('SuspectedDrug.0.reaction_reappear', array(
              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 
              'class' => 'reappear0',
              'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
              'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
              'before' => '<label class="radio inline">',
              'after' => '</label>
                    <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                    onclick="$(\'.reappear0'.'\').removeAttr(\'checked disabled\')">
                    <em class="accordion-toggle"><i class="icon-remove-circle"></i> </em></a> </span>
                   ',
              'options' => array('N/A' => 'N/A'),
            ));
            echo '</div>';
          ?>
        </div>
        <div class="row-fluid">
          <div class="span12">
            <?php echo $this->Html->tag('hr', '', array('id' => 'SuspectedDrugHr0')); ?>
          </div>
        </div>
    </div>
  </div>
  <div id="suspected-drugs">
    <?php
      if (!empty($sae['SuspectedDrug'])) {
          for ($i = 1; $i <= count($sae['SuspectedDrug'])-1; $i++) {
          ?>
          <div class="suspected-group">
            <div class="row-fluid">
                <div class="span6">
                <?php
                    echo $this->Form->input('SuspectedDrug.'.$i.'.id', ['templates' => 'table_form']);
                    echo $this->Form->input('SuspectedDrug.'.$i.'.id');
                    echo $this->Form->input('SuspectedDrug.'.$i.'.generic_name',
                                array('label' => array('class' => 'control-label required', 'text' => 'Generic Name <span class="sterix">*</span>'),));
                    echo $this->Form->input('SuspectedDrug.'.$i.'.dose',
                                array('label' => array('class' => 'control-label required', 'text' => 'Dose <span class="sterix">*</span>'),));
                    echo $this->Form->input('SuspectedDrug.'.$i.'.route_id',
                                array('label' => array('class' => 'control-label required', 'text' => 'Administration Route <span class="sterix">*</span>'),));
                    echo $this->Form->input('SuspectedDrug.'.$i.'.indication',
                                array('label' => array('class' => 'control-label required', 'text' => 'Indication for use <span class="sterix">*</span>'),));
                  
                  echo '<div class="control-group">';
                    echo '<label class="control-label required">Did reaction abate after stopping drug? <span class="sterix">*</span> </label>';
                    echo $this->Form->input('SuspectedDrug.'.$i.'.reaction_abate', array(
                              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                              'class' => 'answer0',
                              'before' => '
                                <input type="hidden" value="" id="SuspectedDrug'.$i.'reaction_abate" name="data[SuspectedDrug]['.$i.'][reaction_abate]"> <label class="radio inline">',
                              'after' => '</label>',
                              'options' => array('Yes' => 'Yes'),
                            ));                                
                    echo $this->Form->input('SuspectedDrug.'.$i.'.reaction_abate', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                      'class' => 'answer0',
                      'before' => '<label class="radio inline">', 'after' => '</label>',
                      'options' => array('No' => 'No')
                    ));     
                    echo $this->Form->input('SuspectedDrug.'.$i.'.reaction_abate', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 
                      'class' => 'answer0',
                      'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                      'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                      'before' => '<label class="radio inline">',
                      'after' => '</label>
                            <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                            onclick="$(\'.answer0'.'\').removeAttr(\'checked disabled\')">
                            <em class="accordion-toggle"><i class="icon-remove-circle"></i> </em></a> </span>
                           ',
                      'options' => array('N/A' => 'N/A'),
                    ));
                  echo '</div>';

                ?>
              
                </div>
                <div class="span6">          
                  <?php
                    echo $this->Form->input('SuspectedDrug.'.$i.'.date_from',
                                array( 'type' => 'text', 'class' => 'datepickers',  'label' => array('class' => 'control-label required', 'text' => 'Therapy Date <small class="muted">(from)</small>  <span class="sterix">*</span>'),));
                    echo $this->Form->input('SuspectedDrug.'.$i.'.date_to',
                                array( 'type' => 'text', 'class' => 'datepickers',  'label' => array('class' => 'control-label required', 'text' => 'Therapy Date <small class="muted">(to)</small> '),));
                    echo $this->Form->input('SuspectedDrug.'.$i.'.therapy_duration',
                                array('label' => array('class' => 'control-label required', 'text' => 'Therapy duration'),));

                  echo '<div class="control-group">';
                    echo '<label class="control-label required">Did reaction reappear after reintroduction? <span class="sterix">*</span> </label>';
                    echo $this->Form->input('SuspectedDrug.'.$i.'.reaction_reappear', array(
                              'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                              'class' => 'reappear'.$i,
                              'before' => '
                                <input type="hidden" value="" id="SuspectedDrug'.$i.'reappear_" name="data[SuspectedDrug]['.$i.'][reaction_reappear]"> <label class="radio inline">',
                              'after' => '</label>',
                              'options' => array('Yes' => 'Yes'),
                            ));                                
                    echo $this->Form->input('SuspectedDrug.'.$i.'.reaction_reappear', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 'error' => false,
                      'class' => 'reappear'.$i,
                      'before' => '<label class="radio inline">', 'after' => '</label>',
                      'options' => array('No' => 'No')
                    ));     
                    echo $this->Form->input('SuspectedDrug.'.$i.'.reaction_reappear', array(
                      'type' => 'radio',  'label' => false, 'legend' => false, 'div' => false, 'hiddenField' => false, 
                      'class' => 'reappear'.$i,
                      'format' => array('before', 'label', 'between', 'input', 'after', 'error'),
                      'error' => array('attributes' => array('wrap' => 'p', 'class' => 'controls required error')),
                      'before' => '<label class="radio inline">',
                      'after' => '</label>
                            <span class="help-inline" style="padding-top: 5px;"><a class="tooltipper" data-original-title="Clear selection"
                            onclick="$(\'.reappear'.$i.'\').removeAttr(\'checked disabled\')">
                            <em class="accordion-toggle"><i class="icon-remove-circle"></i> </em></a> </span>
                           ',
                      'options' => array('N/A' => 'N/A'),
                    ));
                  echo '</div>';
                  ?>
                </div> 
              <div class="row-fluid">
                <div class="span12">
                  <?php 
                    echo $this->Html->tag('div', '<button id="suspected_drugsButton'.$i.'" class="btn btn-small btn-danger removeSuspectedDrug" type="button">Remove Suspected Drug</button>', array(
                        'class' => 'controls', 'escape' => false));
                    echo $this->Html->tag('hr', '', array('id' => 'SuspectedDrugHr'.$i)); 
                  ?>
                </div>
              </div>
            </div>
          </div>
                <?php
                }
            }
        ?>
  </div>
</div>
