  
<div class="row-fluid">
  <div class="span12">
      <?php 
        echo $this->Session->flash();
      ?>
    <div class="page-header">
      <div class="styled_title"><h3>BUDGET AND JUSTIFICATION</h3></div>
    </div>
    
  <?php foreach ($application['Budget'] as $Budget) { ?>
  <table class="table table-bordered table-condensed">
      <thead>
        <th colspan="6"><h4 class="text-danger">Budget (<?php echo $Budget['year']; ?>)</h4></th>
      </thead>
      <tbody>
          <tr>
            <td class="table-label required"><p>Personnel:</p></td>
            <td><?php echo $Budget['personnel_currency']; ?></td>
            <td><?php echo $Budget['personnel']; ?></td>
            <td class="table-label required"><p>Transport</p></td>
            <td><?php echo $Budget['transport_currency']; ?></td>
            <td><?php echo $Budget['transport']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Field:</p></td>
            <td><?php echo $Budget['field_currency']; ?></td>
            <td><?php echo $Budget['field']; ?></td>
            <td class="table-label required"><p>Clinical Supplies</p></td>
            <td><?php echo $Budget['supplies_currency']; ?></td>
            <td><?php echo $Budget['supplies']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Pharmacy:</p></td>
            <td><?php echo $Budget['pharmacy_currency']; ?></td>
            <td><?php echo $Budget['pharmacy']; ?></td>
            <td class="table-label required"><p>Travel</p></td>
            <td><?php echo $Budget['travel_currency']; ?></td>
            <td><?php echo $Budget['travel']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Regulatory:</p></td>
            <td><?php echo $Budget['regulatory_currency']; ?></td>
            <td><?php echo $Budget['regulatory']; ?></td>
            <td class="table-label required"><p>IT</p></td>
            <td><?php echo $Budget['it_currency']; ?></td>
            <td><?php echo $Budget['it']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>HDSS:</p></td>
            <td><?php echo $Budget['hdss_currency']; ?></td>
            <td><?php echo $Budget['hdss']; ?></td>
            <td class="table-label required"><p>KEMRI</p></td>
            <td><?php echo $Budget['kemri_currency']; ?></td>
            <td><?php echo $Budget['kemri']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>WRAIR:</p></td>
            <td><?php echo $Budget['wrair_currency']; ?></td>
            <td><?php echo $Budget['wrair']; ?></td>
            <td class="table-label required"><p></p></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2" class="table-label required"><p>Grand Total:</p></td>
            <td colspan="2"><?php echo $Budget['grand_currency']; ?></td>
            <td colspan="2"><?php echo $Budget['grand_total']; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="table-label required"><p>Per Subject:</p></td>
            <td colspan="2"><?php echo $Budget['subject_currency']; ?></td>
            <td colspan="2"><?php echo $Budget['subject']; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="table-label required"><p>Study Information:</p></td>
            <td colspan="4"><?php echo $Budget['study_information']; ?></td>
          </tr>
          
      </tbody>
  </table>
  <?php } ?>



  <?php if($redir == 'applicant') { ?>
  <h4>Budget Summary</h4>
  <div class="well">

  <div class="row-fluid">
      <div class="span12">

      <?php

        echo $this->Form->create('Budget', array(
            'url' => array('controller' => 'budgets', 'action' => 'add'),
           'class' => 'form-inline',
        ));
        $num = 1;
        $curr = ['KES' => 'KES', 'USD' => 'USD', 'EUR' => 'EUR'];
      ?>

      <div class="row-fluid">
        <div class="span6">
          <?php
            echo $this->Form->input('application_id', array('type' => 'hidden', 'value' => $application['Application']['id']));
            $years = [];
            foreach (range(1986, date('Y')) as $value) {
               $years[$value] = $value;
            }
            arsort($years);
            echo $this->Form->input('year', array('type' => 'select', 'options' => ($years),
                'label' => array('class' => 'control-label', 'text' => 'Year')
              ));

            ?>
        </div><!--/span-->
        <div class="span6">
          <?php
            echo $this->Form->input('budget_period',
              array(
                'label' => array('class' => 'control-label required', 'text' => 'Budget period'),                
                'after'=>'<p class="help-block"> (years) </p></div>',
                ));
            ?>
        </div><!--/span-->
      </div><!--/row-->


    
      

      <table  class="table table-bordered  table-condensed table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th style="width: 40%;">Budget Categories  </th>
            <th style="width: 9%;">Currency</th>
            <th>Total Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Personnel</p> </td>
            <td> <?php  echo $this->Form->input('personnel_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('personnel', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Transport</p> </td>
            <td> <?php  echo $this->Form->input('transport_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('transport', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Field</p> </td>
            <td> <?php  echo $this->Form->input('field_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('field', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Clinical Supplies</p> </td>
            <td> <?php  echo $this->Form->input('supplies_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('supplies', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Pharmacy</p> </td>
            <td> <?php  echo $this->Form->input('pharmacy_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('pharmacy', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Travel</p> </td>
            <td> <?php  echo $this->Form->input('travel_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('travel', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Regulatory</p> </td>
            <td> <?php  echo $this->Form->input('regulatory_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('regulatory', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>IT</p> </td>
            <td> <?php  echo $this->Form->input('it_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('it', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>HDSS</p> </td>
            <td> <?php  echo $this->Form->input('hdss_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('hdss', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>KEMRI</p> </td>
            <td> <?php  echo $this->Form->input('kemri_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('kemri', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>WRAIR</p> </td>
            <td> <?php  echo $this->Form->input('wrair_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('wrair', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Grand Total</p> </td>
            <td> <?php  echo $this->Form->input('grand_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('grand_total', array('label' => false)); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Per Subject</p> </td>
            <td> <?php  echo $this->Form->input('subject_currency', array('label' => false, 'type' => 'select', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('subject', array('label' => false)); ?> </td>
          </tr>
        </tbody>
      </table>
       <hr>

       <?php
            echo $this->Form->input('study_information', array(
              'type' => 'textarea',
              'label' => array('class' => 'control-label', 'text' => 'Study Center Informaiton'),       
                'after'=>'<p class="help-block">  </p></div>',
            ));

            ?>

     </div>  
    </div>

        <?php
          echo $this->Form->end(array(
            'label' => 'Submit',
            'value' => 'Save',
            'class' => 'btn btn-primary',
            'id' => 'BudgetSaveChanges',
            'div' => array(
              'class' => 'form-actions',
            )
          ));
        ?>

    </div>   <!-- ctr-groups -->
    <hr>
    <?php } ?>
    
    </div>
  </div>




