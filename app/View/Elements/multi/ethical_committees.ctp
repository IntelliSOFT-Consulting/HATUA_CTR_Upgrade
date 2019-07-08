<h5>ETHICAL COMMITTEE(S) (<small>Click button to add - 
                          <button type="button" class="btn btn-mini btn-primary" id="addEthicalCommittees" >&nbsp;<i class="icon-plus"></i>&nbsp;</button> Approvals</small>)</h5>
<div class="ctr-groups">
    <div id="ethical_committee_group">
    <?php
        $this->Html->script('multi/ethical_committees?v2', array('inline' => false));
        echo $this->Form->input('EthicalCommittee.0.id');
        echo $this->Form->input('EthicalCommittee.0.ethical_committee', array(
          'label' => array('class' => 'control-label required', 'text' => 'Ethical Committee'),
          'placeholder' => ' ' , 'class' => 'input-xxlarge',
        ));
        echo $this->Form->input('EthicalCommittee.0.submission_date', array(
          'type' => 'text',
          'label' => array('class' => 'control-label required', 'text' => 'Submission Date'),
          'placeholder' => ' ' , 'class' => 'datepickers',
        ));
        echo $this->Form->input('EthicalCommittee.0.erc_number', array(
          'label' => array('class' => 'control-label required', 'text' => 'ERC Number'),
          'placeholder' => ' ' , 'class' => 'input-xxlarge',
        ));
        echo $this->Form->input('EthicalCommittee.0.initial_approval', array(
                'div' => array('class' => 'control-group', 'id' => 'EthicalCommittee0'),    'type' => 'text', 'class' => 'datepickers',
                'label' => array('class' => 'control-label', 'text' => 'Approval date'),
                'after'=>'<span class="help-inline"> format (dd-mm-yyyy)
                            </span>
                        </div>',
        ));
        echo $this->Html->tag('hr', '', array('id' => 'EthicalCommitteeHr0'));
    ?>
    </div>
    <div id="EthicalCommittees">
        <?php
            if (!empty($this->request->data['EthicalCommittee'])) {
                for ($i = 1; $i <= count($this->request->data['EthicalCommittee'])-1; $i++) {
                  ?>
                  <div class="ethical-group">
                  <?php
                    echo $this->Form->input('EthicalCommittee.'.$i.'.id');
                    echo $this->Form->input('EthicalCommittee.'.$i.'.ethical_committee', array(
                      'label' => array('class' => 'control-label required', 'text' => 'Ethical Committee'),
                      'placeholder' => ' ' , 'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('EthicalCommittee.0.submission_date', array(
                      'type' => 'text',
                      'label' => array('class' => 'control-label required', 'text' => 'Submission Date'),
                      'placeholder' => ' ' , 'class' => 'datepickers',
                    ));
                    echo $this->Form->input('EthicalCommittee.0.erc_number', array(
                      'label' => array('class' => 'control-label required', 'text' => 'ERC Number'),
                      'placeholder' => ' ' , 'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('EthicalCommittee.'.$i.'.initial_approval', array(
                        'div' => array('class' => 'control-group'), 'type' => 'text', 'class' => 'datepickers',
                        'label' => array('class' => 'control-label required', 'text' => ''),
                        'after'=>'
                                </div>',
                  ));

                    echo $this->Html->tag('div', '<button id="removeEthical'.$i.'" class="btn btn-mini btn-danger removeEthicalCommittee" type="button"> &nbsp;<i class="icon-trash"></i>&nbsp; Remove Ethical Committee</button>', array(
                      'class' => 'controls', 'escape' => false));
                  echo $this->Html->tag('hr', '', array('id' => 'EthicalCommitteeHr'.$i));
                  ?>
                  </div>
                  <?php
                }
            }
        ?>
    </div>
</div>
