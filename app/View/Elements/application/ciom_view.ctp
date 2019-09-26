
<?php
    $this->assign('CIOM', 'active');

    $outcomes = array(
    '1' => 'recovered/resolved',
    '2' => 'recovering/resolving',
    '3' => 'not recovered/not resolved',
    '4' => 'recovered/resolved with sequelae',
    '5' => 'fatal',
    '6' => 'unknown'
    );
    $actiondrug = array('1' => 'Drug withdrawn',
    '2' => 'Dose reduced',
    '3' => 'Dose increased',
    '4' => 'Dose not changed',
    '5' => 'Unknown',
    '6' => 'Not applicable');
?>

<div class="ciom-form">    

    <hr>
    <h4 style="text-decoration: underline;"> <?php echo $ciom['Application']['protocol_no']; ?> </h4>
    <?php
      echo $this->requestAction('/applications/study_title/'.$ciom['Ciom']['application_id']);
    ?>
    <h4 class="text-center"  style="text-align: center; text-decoration: underline;">CIOMS FORM</h4>
    <table class="table  table-condensed">
      <tbody>
        <tr colspan="3"> I. REACTION INFORMATION </tr>
        <tr>
          <td width="30%" class="table-label required"><p>1. Patient Initials <small class="muted">(first, last)</small> </p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientinitial'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientinitial'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientinitial'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientinitial'] : null; ?></td>          
        </tr>
        <tr>
          <td class="table-label required"><p>1.a Country</p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['occurcountry'])) ? $e2b['ichicsr']['safetyreport']['occurcountry'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['occurcountry'])) ? $e2b['ichicsr']['safetyreport']['occurcountry'] : null; ?></td>          
        </tr>
        <tr>
          <td class="table-label required"><p>2. Date of birth</p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientbirthdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientbirthdate'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientbirthdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientbirthdate'] : null; ?></td>          
        </tr>
        <tr>
          <td class="table-label required"><p>2.a Age <small class="muted">(years)</small> </p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientonsetage'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientonsetage'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientonsetage'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientonsetage'] : null; ?></td>          
        </tr>
        <tr>
          <td class="table-label required"><p>2. Sex </p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientsex'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientsex'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['patientsex'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientsex'] : null; ?></td>          
        </tr>
        <tr>
          <td class="table-label required"><p>4-6. Reaction onset </p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionstartdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionstartdate'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionstartdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionstartdate'] : null; ?></td>          
        </tr>
        <tr>
          <td class="table-label required"><p>7. Describe reaction(s) </p></td>
          <td>
            <?php
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['reaction']['primarysourcereaction'])) ? $e2b['ichicsr']['safetyreport']['patient']['reaction']['primarysourcereaction'] : null; 
              echo "<br/>";
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionoutcome'])) ? $outcomes[$e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionoutcome']] : null; 
              echo "<br/>";
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug'])) ? $actiondrug[$e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug']] : null; 
              echo "<br/>";
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['summary']['narrativeincludeclinical'])) ? $e2b['ichicsr']['safetyreport']['patient']['summary']['narrativeincludeclinical'] : null; 
            ?>
          </td>
          <td>
            <?php
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['reaction']['primarysourcereaction'])) ? $e2b['ichicsr']['safetyreport']['patient']['reaction']['primarysourcereaction'] : null; 
              echo "<br/>";
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionoutcome'])) ? $outcomes[$e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionoutcome']] : null; 
              echo "<br/>";
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug'])) ? $actiondrug[$e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug']] : null; 
              echo "<br/>";
              echo (isset($e2b['ichicsr']['safetyreport']['patient']['summary']['narrativeincludeclinical'])) ? $e2b['ichicsr']['safetyreport']['patient']['summary']['narrativeincludeclinical'] : null; 
            ?>
          </td>
        </tr>
        <tr>
          <td class="table-label required"><p>13. (including relevant test lab data) </p></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['resultstestsprocedures'])) ? $e2b['ichicsr']['safetyreport']['patient']['resultstestsprocedures'] : null; ?></td>
          <td><?php  echo (isset($e2b['ichicsr']['safetyreport']['patient']['resultstestsprocedures'])) ? $e2b['ichicsr']['safetyreport']['patient']['resultstestsprocedures'] : null; ?></td>          
        </tr>
      </tbody>
    </table>

</div>