<?php
    $this->Html->script('multi/concomittant_drugs', array('inline' => false));
?>
<h5>Concomittant Drug(s) (<small>where necessary, Click button to add more -
<button type="button" class="btn btn-small btn-primary" id="addConcomittantDrug">Add Concomittant Drug</button></small>) </h5>

<div class="ctr-groups sae-group">
  <div id="primary_concomittant_drug">

  </div>
  <div id="concomittant-drugs">
    <?php
      if (!empty($sae['ConcomittantDrug'])) {
          for ($i = 0; $i <= count($sae['ConcomittantDrug'])-1; $i++) {
          ?>
          <div class="concomittant-group">
            <div class="row-fluid">
                <div class="span6">
                <?php
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.id', ['templates' => 'table_form']);
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.id');
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.generic_name',
                                array('label' => array('class' => 'control-label required', 'text' => 'Generic Name <span class="sterix">*</span>'),));
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.dose',
                                array('label' => array('class' => 'control-label required', 'text' => 'Dose <span class="sterix">*</span>'),));
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.route_id',
                                array('label' => array('class' => 'control-label required', 'text' => 'Administration Route <span class="sterix">*</span>'),));
                  
                ?>
              
                </div>
                <div class="span6">          
                  <?php
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.date_from',
                                array('type' => 'text', 'class' => 'datepickers', 'label' => array('class' => 'control-label required', 'text' => 'Date <small class="muted">(from)</small>  <span class="sterix">*</span>'),));
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.date_to',
                                array('type' => 'text', 'class' => 'datepickers', 'label' => array('class' => 'control-label required', 'text' => 'date <small class="muted">(to)</small> '),));
                    
                    echo $this->Form->input('ConcomittantDrug.'.$i.'.indication',
                                array('label' => array('class' => 'control-label required', 'text' => 'Indication for use <span class="sterix">*</span>'),));
                  ?>
                </div> 
              <div class="row-fluid">
                <div class="span12">
                  <?php 
                    echo $this->Html->tag('div', '<button id="concomittant_drugsButton'.$i.'" class="btn btn-small btn-danger removeConcomittantDrug" type="button">Remove Concomittant Drug</button>', array(
                        'class' => 'controls', 'escape' => false));
                    echo $this->Html->tag('hr', '', array('id' => 'ConcomittantDrugHr'.$i)); 
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
    <div class="row-fluid">
      <div class="span12">
          <?php 
              echo $this->Form->input('relevant_history', array(
                'class' => 'span9',
                'label' => array('class' => 'control-label', 'text' => 'Relevant History'),
              ));
          ?>     
          
      </div>
    </div>
</div>
