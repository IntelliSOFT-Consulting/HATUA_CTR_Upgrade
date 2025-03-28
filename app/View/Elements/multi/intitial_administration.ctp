<?php
$this->Html->script('multi/multi_date', array('inline' => false));
?>
<h5> Date of subsequent additional administration<br>(<small>where necessary, Click button to add more -
        <button type="button" class="btn btn-small btn-primary" id="addDate">Add</button></small>) </h5>

<div class="ctr-groups sae-group">

    <div id="suspected-drug-date">
        <?php
        if (!empty($sae['SaeDate'])) {
            for ($i = 0; $i <= count($sae['SaeDate']) - 1; $i++) {
        ?>
                <div class="suspected-group">
                    <div class="row-fluid">

                        <div class="span6">
                            <?php
                            echo $this->Form->input(
                                'SaeDate.' . $i . '.date',
                                array('type' => 'text', 'class' => 'datepickers',  'label' => array('class' => 'control-label required', 'text' => 'Date of initial administration of investigational product  <small class="muted">(from)</small>  <span class="sterix">*</span>'),)
                            );
                            ?>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <?php
                                echo $this->Html->tag('div', '<button id="suspected_drugsButton' . $i . '" class="btn btn-small btn-danger removeSuspectedDrug" type="button"></button>', array(
                                    'class' => 'controls',
                                    'escape' => false
                                ));
                                echo $this->Html->tag('hr', '', array('id' => 'SuspectedDrugHr' . $i));
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