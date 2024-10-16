  
<div class="row-fluid">
  <div class="span12">
    <div class="page-header">
      <div class="styled_title"><h3>BUDGET AND JUSTIFICATION</h3></div>
    </div>
        
      <?php
        $num = 1;
        $curr = ['KES' => 'KES', 'USD' => 'USD', 'EUR' => 'EUR'];
      ?>

      <table  class="table table-bordered  table-condensed table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th style="width: 40%;">Budget Categories  </th>
            <th style="width: 9%;">Currency</th>
            <th>Total Cost</th>
            <th>Total Cost (Kshs) <small class="muted">(conversion)</small></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $num++; echo $this->Form->input('Budget.0.id');?></td>
            <td> <p>Personnel</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.personnel_currency', array('label' => false, 'type' => 'select', 'between' => '<div>', 'options' => $curr));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.personnel', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.personnel_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Transport</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.transport_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.transport', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.transport_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Field</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.field_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.field', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.field_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Clinical Supplies</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.supplies_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.supplies', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.supplies_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Pharmacy</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.pharmacy_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.pharmacy', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.pharmacy_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Travel</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.travel_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.travel', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.travel_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Regulatory</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.regulatory_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.regulatory', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.regulatory_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>IT</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.it_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.it', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.it_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Others</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.others_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.others', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.others_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Grand Total</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.grand_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.grand_total', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.grand_total_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
          <tr>
            <td><?php echo $num++; ?></td>
            <td> <p>Per Subject</p> </td>
            <td> <?php  echo $this->Form->input('Budget.0.subject_currency', array('label' => false, 'type' => 'select', 'options' => $curr, 'between' => '<div>'));  ?>  </td>
            <td> <?php  echo $this->Form->input('Budget.0.subject', array('label' => false, 'between' => '<div>')); ?> </td>
            <td> <?php  echo $this->Form->input('Budget.0.subject_kshs', array('label' => false, 'between' => '<div>')); ?> </td>
          </tr>
        </tbody>
      </table>
       <hr>
      
      <?php
            echo $this->Form->input('Budget.0.study_information', array(
              'type' => 'textarea',
              'label' => array('class' => 'control-label', 'text' => 'Study Center Information'),       
                'after'=>'<p class="help-block">  </p></div>',
            ));
      ?>

    <hr>

    </div>
  </div>




