
<h3 style="text-align: center;"> Study budget</h3>   
<hr class="soften" style="margin: 10px 0px;">

    <table class="table table-bordered table-condensed">
      <thead>
        <th colspan="8"><h4 class="text-danger">budget</h4></th>
      </thead>
      <tbody>
          <tr>
            <td class="table-label required"><p>Personnel:</p></td>
            <td><?php echo $budget['personnel_currency']; ?></td>
            <td><?php echo $budget['personnel']; ?></td>
            <td>Kshs: <?php echo $budget['personnel_kshs']; ?></td>
            <td class="table-label required"><p>Transport</p></td>
            <td><?php echo $budget['transport_currency']; ?></td>
            <td><?php echo $budget['transport']; ?></td>
            <td>Kshs: <?php echo $budget['transport_kshs']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Field:</p></td>
            <td><?php echo $budget['field_currency']; ?></td>
            <td><?php echo $budget['field']; ?></td>
            <td>Kshs: <?php echo $budget['field_kshs']; ?></td>
            <td class="table-label required"><p>Clinical Supplies</p></td>
            <td><?php echo $budget['supplies_currency']; ?></td>
            <td><?php echo $budget['supplies']; ?></td>
            <td>Kshs: <?php echo $budget['supplies_kshs']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Pharmacy:</p></td>
            <td><?php echo $budget['pharmacy_currency']; ?></td>
            <td><?php echo $budget['pharmacy']; ?></td>
            <td>Kshs: <?php echo $budget['pharmacy_kshs']; ?></td>
            <td class="table-label required"><p>Travel</p></td>
            <td><?php echo $budget['travel_currency']; ?></td>
            <td><?php echo $budget['travel']; ?></td>
            <td>Kshs: <?php echo $budget['travel_kshs']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Regulatory:</p></td>
            <td><?php echo $budget['regulatory_currency']; ?></td>
            <td><?php echo $budget['regulatory']; ?></td>
            <td>Kshs: <?php echo $budget['regulatory_kshs']; ?></td>
            <td class="table-label required"><p>IT</p></td>
            <td><?php echo $budget['it_currency']; ?></td>
            <td><?php echo $budget['it']; ?></td>
            <td>Kshs: <?php echo $budget['it_kshs']; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>Others:</p></td>
            <td><?php echo $budget['others_currency']; ?></td>
            <td><?php echo $budget['others']; ?></td>
            <td>Kshs: <?php echo $budget['others_kshs']; ?></td>
            <td class="table-label required"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2" class="table-label required"><p>Grand Total:</p></td>
            <td colspan="2"><?php echo $budget['grand_currency']; ?></td>
            <td colspan="2"><?php echo $budget['grand_total']; ?></td>
            <td colspan="2">Kshs: <?php echo $budget['grand_total_kshs']; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="table-label required"><p>Per Subject:</p></td>
            <td colspan="2"><?php echo $budget['subject_currency']; ?></td>
            <td colspan="2"><?php echo $budget['subject']; ?></td>
            <td colspan="2">Kshs: <?php echo $budget['subject_kshs']; ?></td>
          </tr>
          <tr>
            <td colspan="2" class="table-label required"><p>Study Information:</p></td>
            <td colspan="6"><?php echo $budget['study_information']; ?></td>
          </tr>
          
      </tbody>
    </table>
