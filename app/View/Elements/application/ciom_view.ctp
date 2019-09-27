
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

    $serious = array('1' => 'Yes', '2' => 'No');
    $drugcharacterization = array('1' => 'Suspect', '2' => 'Concomitant', '3' => 'Interacting');
    // debug($e2b);

    $drugadministrationroute = ['001' => 'Auricular (otic)', '002' => 'Buccal', '003' => 'Cutaneous', '004' => 'Dental', '005' => 'Endocervical',
'006' => 'Endosinusial', '007' => 'Endotracheal', '008' => 'Epidural', '009' => 'Extra-amniotic', '010' => 'Hemodialysis', '011' => 'Intra corpus cavernosum',
'012' => 'Intra-amniotic', '013' => 'Intra-arterial', '014' => 'Intra-articular', '015' => 'Intra-uterine', '016' => 'Intracardiac', '017' => 'Intracavernous',
'018' => 'Intracerebral', '019' => 'Intracervical', '020' => 'Intracisternal', '021' => 'Intracorneal', '022' => 'Intracoronary', '023' => 'Intradermal',
'024' => 'Intradiscal (intraspinal)', '025' => 'Intrahepatic', '026' => 'Intralesional', '027' => 'Intralymphatic', '028' => 'Intramedullar (bone marrow)', '029' => 'Intrameningeal',
'030' => 'Intramuscular', '031' => 'Intraocular', '032' => 'Intrapericardial', '033' => 'Intraperitoneal', '034' => 'Intrapleural', '035' => 'Intrasynovial',
'036' => 'Intratumor', '037' => 'Intrathecal', '038' => 'Intrathoracic', '039' => 'Intratracheal', '040' => 'Intravenous bolus', '041' => 'Intravenous drip',
'042' => 'Intravenous (not otherwise specified)', '043' => 'Intravesical', '044' => 'Iontophoresis',
'045' => 'Nasal',
'046' => 'Occlusive dressing technique',
'047' => 'Ophthalmic',
'048' => 'Oral',
'049' => 'Oropharingeal',
'050' => 'Other',
'051' => 'Parenteral',
'052' => 'Periarticular',
'053' => 'Perineural',
'054' => 'Rectal',
'055' => 'Respiratory (inhalation)',
'056' => 'Retrobulbar',
'057' => 'Sunconjunctival',
'058' => 'Subcutaneous',
'059' => 'Subdermal',
'060' => 'Sublingual',
'061' => 'Topical',
'062' => 'Transdermal',
'063' => 'Transmammary',
'064' => 'Transplacental',
'065' => 'Unknown',
'066' => 'Urethral',
'067' => 'Vaginal'];

$time_unit = ['801' => 'Year', '802' => 'Month', '803' => 'Week', '804' => 'Day', '805' => 'Hour', '806' => 'Minute'];

$actions = [
'1'=>'Drug withdrawn',
'2'=>'Dose reduced',
'3'=>'Dose increased',
'4'=>'Dose not changed',
'5'=>'Unknown',
'6'=>'Not applicable'
];

$drugrecurreadministration = ['1' => 'Yes', '2' => 'No', '3' => 'Unknown'];
$reporttype = ['1' => 'Spontaneous', '2' => 'Report from study', '3' => 'Other', '4' => 'Not available to sender (unknown)'];
$qualification = ['1' => 'Physician', '2' => 'Pharmacist', '3' => 'Other Health Professional', '4' => 'Lawyer', '5' => 'Consumer or other non-health professional'];
?>

<div class="ciom-form">    

    <hr>
    <h4 style="text-decoration: underline;"> <?php echo $ciom['Application']['protocol_no']; ?> </h4>
    <?php
      echo $this->requestAction('/applications/study_title/'.$ciom['Ciom']['application_id']);
      echo $this->Html->link(
                $ciom['Ciom']['basename'],
                str_replace('/var/www/ctr/app/webroot', '', $ciom['Ciom']['file']),
                array('class' => 'button', 'target' => '_blank')
            );
    ?>
    <h4 class="text-center"  style="text-align: center; text-decoration: underline;">CIOMS FORM</h4>
    <table class="table  table-condensed">
      <thead>
      <tr style="background: #C5D9F0;">
        <th>CIOM Form</th>
        <th>ICH-E2B field (R2)</th>
      </tr>        
      </thead>
      <tbody>
        <tr style="background: #DAEDF3;"><td colspan="2"> I. REACTION INFORMATION </td> </tr>
        <tr>
          <td width="30%" class="table-label required"><p>1. Patient Initials <small class="muted">(first, last)</small> </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['patientinitial'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientinitial'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>1.a Country</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['occurcountry'])) ? $e2b['ichicsr']['safetyreport']['occurcountry'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>2. Date of birth</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['patientbirthdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientbirthdate'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>2.a Age <small class="muted">(years)</small> </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['patientonsetage'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientonsetage'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>2. Sex </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['patientsex'])) ? $e2b['ichicsr']['safetyreport']['patient']['patientsex'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>4-6. Reaction onset </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionstartdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionstartdate'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>7. Describe reaction(s) </p></td>
          <td>
            <?php
              echo (!empty($e2b['ichicsr']['safetyreport']['patient']['reaction']['primarysourcereaction'])) ? $e2b['ichicsr']['safetyreport']['patient']['reaction']['primarysourcereaction'] : null; 
              echo "<br/>";
              echo (!empty($e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionoutcome'])) ? $outcomes[$e2b['ichicsr']['safetyreport']['patient']['reaction']['reactionoutcome']] : null; 
              echo "<br/>";
              echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug'])) ? $actiondrug[$e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug']] : null; 
              echo "<br/>";
              echo (!empty($e2b['ichicsr']['safetyreport']['patient']['summary']['narrativeincludeclinical'])) ? $e2b['ichicsr']['safetyreport']['patient']['summary']['narrativeincludeclinical'] : null; 
            ?>
          </td>
        </tr>
        <tr>
          <td class="table-label required"><p>13. (including relevant test lab data) </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['resultstestsprocedures'])) ? $e2b['ichicsr']['safetyreport']['patient']['resultstestsprocedures'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>8-12. Check all appropriate to adverse reaction </p></td>
          <td><p>Serious - at case level</p><?php  echo (!empty($e2b['ichicsr']['safetyreport']['serious'])) ? $serious[$e2b['ichicsr']['safetyreport']['serious']] : null; ?></td>
        </tr>
        <tr>
          <td><p>Patient died </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['seriousnessdeath'])) ? $serious[$e2b['ichicsr']['safetyreport']['seriousnessdeath']] : null; ?></td>
        </tr>
        <tr>
          <td><p>Involved or prolonged inpatient hospitalization </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['seriousnesshospitalization'])) ? $serious[$e2b['ichicsr']['safetyreport']['seriousnesshospitalization']] : null; ?></td>
        </tr>
        <tr>
          <td><p>Involved persistence or significant disability or incapacity </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['seriousnessdisabling'])) ? $serious[$e2b['ichicsr']['safetyreport']['seriousnessdisabling']] : null; ?></td>
        </tr>
        <tr>
          <td><p>Life threatening </p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['seriousnesslifethreatening'])) ? $serious[$e2b['ichicsr']['safetyreport']['seriousnesslifethreatening']] : null; ?></td>
        </tr>
      </tbody>
    </table>

    <table class="table  table-condensed">
      <thead>
        <tr style="background: #DAEDF3;">
          <th class="table-label required"><p>SUSPECT/CONCOMITANT DRUG(S) INFORMATION</p></th>
          <th><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugcharacterization'])) ? $drugcharacterization[$e2b['ichicsr']['safetyreport']['patient']['drug']['drugcharacterization']] : null; ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="table-label required"><p>14. Suspect drug(s)</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['medicinalproduct'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['medicinalproduct'] : null; ?></td>
        </tr>
        <tr>
          <td><p>Batch/lot number</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugbatchnumb'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['drugbatchnumb'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>15. Daily dose(s)</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugdosagetext'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['drugdosagetext'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>16. Route(s) of administration</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugadministrationroute'])) ? $drugadministrationroute[$e2b['ichicsr']['safetyreport']['patient']['drug']['drugadministrationroute']] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>17. Indication(s) for use</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugindication'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['drugindication'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>18. Therapy dates</p></td>
          <td>
            <p>Date of start of drug</p>
            <?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugstartdate'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['drugstartdate'] : null; ?>
          </td>
        </tr>
        <tr>
          <td class="table-label required"><p></p></td>
          <td>
          <p>Date of last administration</p>
          <?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugenddate'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['drugenddate'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>19. Therapy duration</p></td>
          <td>
            <?php  
              echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugtreatmentduration'])) ? $e2b['ichicsr']['safetyreport']['patient']['drug']['drugtreatmentduration'] : null; 
              echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugtreatmentdurationunit'])) ? $time_unit[$e2b['ichicsr']['safetyreport']['patient']['drug']['drugtreatmentdurationunit']] : null; 
            ?>              
          </td>
        </tr>
          <tr>
            <td class="table-label required"><p>20. Did reaction abate after stopping drug?</p></td>
            <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug'])) ? $actiondrug[$e2b['ichicsr']['safetyreport']['patient']['drug']['actiondrug']] : null; ?></td>
          </tr>
          <tr>
            <td class="table-label required"><p>21. Did reaction reappear after reintroduction?</p></td>
            <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['patient']['drug']['drugrecurreadministration'])) ? $drugrecurreadministration[$e2b['ichicsr']['safetyreport']['patient']['drug']['drugrecurreadministration']] : null; ?></td>
          </tr>
      </tbody>
    </table>

    <table class="table  table-condensed">
      <thead>
        <tr style="background: #DAEDF3;"><th colspan="2" class="table-label required"><p>MANUFACTURER INFORMATION</p></th></tr>
      </thead>
      <tbody>
        <tr>
          <td class="table-label required"><p>Name and address of manufacturer</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['duplicatesource'])) ? $e2b['ichicsr']['safetyreport']['duplicatesource'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>MFR control no.</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['duplicate'])) ? $e2b['ichicsr']['safetyreport']['duplicate'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>Date received by manufacturer</p></td>
          <td><?php  echo (!empty($e2b['ichicsr']['safetyreport']['receiptdate'])) ? $e2b['ichicsr']['safetyreport']['receiptdate'] : null; ?></td>
        </tr>
        <tr>
          <td class="table-label required"><p>Report source</p></td>
          <td>
            <p>Type of report</p>
            <?php  echo (!empty($e2b['ichicsr']['safetyreport']['reporttype'])) ? $reporttype[$e2b['ichicsr']['safetyreport']['reporttype']] : null; ?>
            <p>Literature reference(s)</p>
            <?php  echo (!empty($e2b['ichicsr']['safetyreport']['primarysource']['literaturereference'])) ? $e2b['ichicsr']['safetyreport']['primarysource']['literaturereference'] : null; ?>
            <p>Qualification</p>
            <?php  echo (!empty($e2b['ichicsr']['safetyreport']['primarysource']['qualification'])) ? $qualification[$e2b['ichicsr']['safetyreport']['primarysource']['qualification']] : null; ?>
          </td>
        </tr>
      </tbody>
    </table>
</div>