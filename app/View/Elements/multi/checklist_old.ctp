<?php
    $this->Html->script('multi/checklist', array('inline' => false));
  $add_checklist = '<p><button class="btn btn-mini tiptip add-checklist" data-original-title="Add a file"
                                style="margin-left:10px;" type="button">&nbsp;<i class="icon-plus-sign"></i>&nbsp; </button>';
    $num = 1;
?>
<h5>CHECKLIST <span class="sterix">*</span></h5>
<h5>All submitted documents should be version referenced and dated.</h5>
<hr>
<?php

    echo $this->Form->input('applicant_covering_letter', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantCoveringLetter_" name="data[Application][applicant_covering_letter]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Cover Letter <span class="sterix">*</span></label>'.$add_checklist,));
?>
<div id="CoverLetter" class="checkcontrols" title="cover_letter">
<?php
 if(isset($this->request->data['CoverLetter'])){
   foreach ($this->request->data['CoverLetter'] as $aKey => $cover_letter) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('CoverLetter.'.$aKey.'.id');
    echo $this->Form->input('CoverLetter.'.$aKey.'.basename', array('type'=>'hidden'));
    if (!empty($cover_letter['id']) && !empty($cover_letter['basename'])) {
        echo $this->Html->link(__($cover_letter['basename']),
            array('controller' => 'attachments',  'action' => 'download', $cover_letter['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$cover_letter['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('CoverLetter.'.$aKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('CoverLetter.'.$aKey.'.group', array('type'=>'hidden', 'value'=>'cover_letter'));
        echo $this->Form->input('CoverLetter.'.$aKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('CoverLetter.'.$aKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('CoverLetter.'.$aKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="CoverLetterHelp'.$aKey.'" class="help-inline">  Upload! </span>'
        ));
    }
    echo "</div>";
   }
 }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_complete_form', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_complete_form]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Completed application form <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_complete_form">
<?php
 if(isset($this->request->data['Checklist'])){
   foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
   	if ($protocol['group'] == 'applicant_complete_form') {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Checklist.'.$bKey.'.id');
    echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
    if (!empty($protocol['id']) && !empty($protocol['basename'])) {
        echo $this->Html->link(__($protocol['basename']),
            array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
        echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_complete_form'));
        echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ProtocolHelp'.$bKey.'" class="help-inline"> Upload! </span>'
    ));
    }
    echo "</div>";
   }
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_protocol', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_protocol]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'The Study Protocol <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Protocol" class="checkcontrols" title="protocol">
<?php
 if(isset($this->request->data['Protocol'])){
   foreach ($this->request->data['Protocol'] as $bKey => $protocol) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Protocol.'.$bKey.'.id');
    echo $this->Form->input('Protocol.'.$bKey.'.basename', array('type'=>'hidden'));
    if (!empty($protocol['id']) && !empty($protocol['basename'])) {
        echo $this->Html->link(__($protocol['basename']),
            array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Protocol.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Protocol.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'protocol'));
        echo $this->Form->input('Protocol.'.$bKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Protocol.'.$bKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Protocol.'.$bKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ProtocolHelp'.$bKey.'" class="help-inline"> Upload! </span>'
    ));
    }
    echo "</div>";
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_pan_african', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_pan_african]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Registration of the study at Pan African Clinical Trials Registry https://pactr.samrc.ac.za  <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_pan_african">
<?php
 if(isset($this->request->data['Checklist'])){
    foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
        if ($protocol['group'] == 'applicant_pan_african') {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_pan_african'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_pan_african-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_patient_information', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantPatientInformation_" name="data[Application][applicant_patient_information]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Patient Information leaflet and Informed consent form <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="PatientLeaflet" class="checkcontrols" title="patient_leaflet">
<?php
if(isset($this->request->data['PatientLeaflet'])){
  foreach ($this->request->data['PatientLeaflet'] as $cKey => $patient_leaflet) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('PatientLeaflet.'.$cKey.'.id');
    echo $this->Form->input('PatientLeaflet.'.$cKey.'.basename', array('type'=>'hidden'));
    if (!empty($patient_leaflet['id']) && !empty($patient_leaflet['basename'])) {
        echo $this->Html->link(__($patient_leaflet['basename']),
            array('controller' => 'attachments',  'action' => 'download', $patient_leaflet['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$patient_leaflet['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.id');
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.group', array('type'=>'hidden', 'value'=>'patient_leaflet'));
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.basename', array('type'=>'hidden'));
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('PatientLeaflet.'.$cKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="PatientLeafletHelp'.$cKey.'" class="help-inline">   Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_investigators_brochure', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantInvestigatorsBrochure_" name="data[Application][applicant_investigators_brochure]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Investigators Brochure/Package inserts
                                        <span class="sterix">*</span></label>'.$add_checklist,));
?>
<div id="Brochure" class="checkcontrols" title="brochure">
<?php
 if(isset($this->request->data['Brochure'])){
   foreach ($this->request->data['Brochure'] as $dKey => $brochure) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Brochure.'.$dKey.'.id');
    echo $this->Form->input('Brochure.'.$dKey.'.basename', array('type'=>'hidden'));
    if (!empty($brochure['id']) && !empty($brochure['basename'])) {
        echo $this->Html->link(__($brochure['basename']),
            array('controller' => 'attachments',  'action' => 'download', $brochure['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$brochure['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Brochure.'.$dKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Brochure.'.$dKey.'.group', array('type'=>'hidden', 'value'=>'brochure'));
        echo $this->Form->input('Brochure.'.$dKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Brochure.'.$dKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Brochure.'.$dKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="BrochureHelp'.$dKey.'" class="help-inline"> Upload! </span>'
        ));
    }
    echo "</div>";
   }
 }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_impd', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_impd]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Investigational Medicinal Product Dossier (IMPD) <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_impd">
<?php
 if(isset($this->request->data['Checklist'])){
   foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
   	if ($protocol['group'] == 'applicant_impd') {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Checklist.'.$bKey.'.id');
    echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
    if (!empty($protocol['id']) && !empty($protocol['basename'])) {
        echo $this->Html->link(__($protocol['basename']),
            array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
        echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_impd'));
        echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ProtocolHelp'.$bKey.'" class="help-inline"> Upload! </span>'
    ));
    }
    echo "</div>";
   }
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_prev_data', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_prev_data]">
                                            <label class="checkbox pull-left">',
                            'after' => 'Adequate data and information on previous studies and phases'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_prev_data">
<?php
 if(isset($this->request->data['Checklist'])){
   foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
   	if ($protocol['group'] == 'applicant_prev_data') {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Checklist.'.$bKey.'.id');
    echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
    if (!empty($protocol['id']) && !empty($protocol['basename'])) {
        echo $this->Html->link(__($protocol['basename']),
            array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
        echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_prev_data'));
        echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ProtocolHelp'.$bKey.'" class="help-inline"> Upload! </span>'
    ));
    }
    echo "</div>";
   }
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_stability_data', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_stability_data]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Stability data of the investigational product <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_stability_data">
<?php
 if(isset($this->request->data['Checklist'])){
   foreach ($this->request->data['Checklist'] as $bKey => $protocol) {   	
   	if ($protocol['group'] == 'applicant_stability_data') {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Checklist.'.$bKey.'.id');
    echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
    if (!empty($protocol['id']) && !empty($protocol['basename'])) {
        echo $this->Html->link(__($protocol['basename']),
            array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
        echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_stability_data'));
        echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ProtocolHelp'.$bKey.'" class="help-inline"> Upload! </span>'
    ));
    }
    echo "</div>";
   }
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_gmp_certificate', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantGmpCertificate_" name="data[Application][applicant_gmp_certificate]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'GMP certificate of the investigational product from the site of manufacture <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="GmpCertificate" class="checkcontrols" title="gmp_certificate">
<?php
if(isset($this->request->data['GmpCertificate'])){
   foreach ($this->request->data['GmpCertificate'] as $eKey => $gmp_certificate) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('GmpCertificate.'.$eKey.'.id');
        echo $this->Form->input('GmpCertificate.'.$eKey.'.basename', array('type'=>'hidden'));
    if (!empty($gmp_certificate['id']) && !empty($gmp_certificate['basename'])) {
        echo $this->Html->link(__($gmp_certificate['basename']),
            array('controller' => 'attachments',  'action' => 'download', $gmp_certificate['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$gmp_certificate['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('GmpCertificate.'.$eKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('GmpCertificate.'.$eKey.'.group', array('type'=>'hidden', 'value'=>'gmp_certificate'));
        echo $this->Form->input('GmpCertificate.'.$eKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('GmpCertificate.'.$eKey.'.basename', array('type'=>'hidden'));
        echo $this->Form->input('GmpCertificate.'.$eKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('GmpCertificate.'.$eKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="GmpCertificateHelp'.$eKey.'" class="help-inline">   Upload! </span>'
        ));
    }
    echo "</div>";
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_analysis_cert', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_analysis_cert]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Certificate of Analysis of the investigational product <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_analysis_cert">
<?php
 if(isset($this->request->data['Checklist'])){
   foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
   	if ($protocol['group'] == 'applicant_analysis_cert') {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
    echo $this->Form->input('Checklist.'.$bKey.'.id');
    echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
    if (!empty($protocol['id']) && !empty($protocol['basename'])) {
        echo $this->Html->link(__($protocol['basename']),
            array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
        echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_analysis_cert'));
        echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Checklist.'.$bKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ProtocolHelp'.$bKey.'" class="help-inline"> Upload! </span>'
    ));
    }
    echo "</div>";
   }
   }
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_pictorial_sample', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_pictorial_sample]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Pictorial Sample of the investigational products. This sample should include the text of the labeling to be used <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_pictorial_sample">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_pictorial_sample') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_pictorial_sample'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_pictorial_sample-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_investigators_cv', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),  'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantInvestigatorsCv_" name="data[Application][applicant_investigators_cv]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Signed investigator(s) CV(s) including that of study Pharmacist <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Cv" class="checkcontrols" title="cv">
<?php
 if(isset($this->request->data['Cv'])){
   foreach ($this->request->data['Cv'] as $fKey => $cv) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('Cv.'.$fKey.'.id');
        echo $this->Form->input('Cv.'.$fKey.'.basename', array('type'=>'hidden'));
    if (!empty($cv['id']) && !empty($cv['basename'])) {
        echo $this->Html->link(__($cv['basename']),
            array('controller' => 'attachments',  'action' => 'download', $cv['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$cv['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Cv.'.$fKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Cv.'.$fKey.'.group', array('type'=>'hidden', 'value'=>'cv'));
        echo $this->Form->input('Cv.'.$fKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Cv.'.$fKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Cv.'.$fKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="CvHelp'.$fKey.'" class="help-inline">   Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_gcp_training', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_gcp_training]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Evidence of recent GCP training of the core study staff <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_gcp_training">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_gcp_training') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_gcp_training'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_gcp_training-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_dsmb_charter', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_dsmb_charter]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'DSMB Charter including the composition and meeting schedule <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_dsmb_charter">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_dsmb_charter') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_dsmb_charter'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_dsmb_charter-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_detailed_budget', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_detailed_budget]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Detailed budget of the study <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_detailed_budget">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_detailed_budget') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_detailed_budget'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_detailed_budget-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_financial_declaration', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantFinancialDeclaration_" name="data[Application][applicant_financial_declaration]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Financial declaration by Sponsor and/or PI <span class="sterix">*</span></label>'.$add_checklist,));
?>
<div id="Finance" class="checkcontrols" title="finance">
<?php
if(isset($this->request->data['Finance'])){
  foreach ($this->request->data['Finance'] as $gKey => $finance) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('Finance.'.$gKey.'.id');
        echo $this->Form->input('Finance.'.$gKey.'.basename', array('type'=>'hidden'));
    if (!empty($finance['id']) && !empty($finance['basename'])) {
        echo $this->Html->link(__($finance['basename']),
            array('controller' => 'attachments',  'action' => 'download', $finance['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$finance['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Finance.'.$gKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Finance.'.$gKey.'.group', array('type'=>'hidden', 'value'=>'finance'));
        echo $this->Form->input('Finance.'.$gKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Finance.'.$gKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Finance.'.$gKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="FinanceHelp'.$gKey.'" class="help-inline">  Upload! </span>'
        ));
    }
    echo "</div>";
   }
 }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_signed_declaration', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantSignedDeclaration_" name="data[Application][applicant_signed_declaration]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Signed Declaration by Sponsor or Principal investigator that the study will be carried out according to protocol and applicable laws and regulations. <span class="sterix">*</span></label>'.$add_checklist,));
?>
<div id="Declaration" class="checkcontrols" title="declaration">
<?php
if(isset($this->request->data['Declaration'])){
  foreach ($this->request->data['Declaration'] as $hKey => $declaration) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('Declaration.'.$hKey.'.id');
        echo $this->Form->input('Declaration.'.$hKey.'.basename', array('type'=>'hidden'));
    if (!empty($declaration['id']) && !empty($declaration['basename'])) {
        echo $this->Html->link(__($declaration['basename']),
            array('controller' => 'attachments',  'action' => 'download', $declaration['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$declaration['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Declaration.'.$hKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Declaration.'.$hKey.'.group', array('type'=>'hidden', 'value'=>'declaration'));
        echo $this->Form->input('Declaration.'.$hKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Declaration.'.$hKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Declaration.'.$hKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="DeclarationHelp'.$hKey.'" class="help-inline">  Upload! </span>'
        ));
    }
    echo "</div>";
   }
 }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_indemnity_pi', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_indemnity_pi]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Indemnity cover for PI and investigators <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_indemnity_pi">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_indemnity_pi') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_indemnity_pi'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_indemnity_pi-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_indemnity_cover', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantIndemnityCover_" name="data[Application][applicant_indemnity_cover]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Indemnity cover and Insurance Certificate for the study participants <span class="sterix">*</span></label>'.$add_checklist,));
?>
<div id="IndemnityCover" class="checkcontrols" title="indemnity_cover">
<?php
if(isset($this->request->data['IndemnityCover'])){
  foreach ($this->request->data['IndemnityCover'] as $iKey => $indemnity_cover) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('IndemnityCover.'.$iKey.'.id');
        echo $this->Form->input('IndemnityCover.'.$iKey.'.basename', array('type'=>'hidden'));
    if (!empty($indemnity_cover['id']) && !empty($indemnity_cover['basename'])) {
        echo $this->Html->link(__($indemnity_cover['basename']),
            array('controller' => 'attachments',  'action' => 'download', $indemnity_cover['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$indemnity_cover['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('IndemnityCover.'.$iKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('IndemnityCover.'.$iKey.'.group', array('type'=>'hidden', 'value'=>'indemnity_cover'));
        echo $this->Form->input('IndemnityCover.'.$iKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('IndemnityCover.'.$iKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('IndemnityCover.'.$iKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="IndemnityCoverHelp'.$iKey.'" class="help-inline">   Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_opinion_letter', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantOpinionLetter_" name="data[Application][applicant_opinion_letter]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Copy of favorable opinion letter from the local Ethics Review Committee (ERC). <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="OpinionLetter" class="checkcontrols" title="opinion_letter">
<?php
if(isset($this->request->data['OpinionLetter'])){
  foreach ($this->request->data['OpinionLetter'] as $jKey => $opinion_letter) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('OpinionLetter.'.$jKey.'.id');
        echo $this->Form->input('OpinionLetter.'.$jKey.'.basename', array('type'=>'hidden'));
    if (!empty($opinion_letter['id']) && !empty($opinion_letter['basename'])) {
        echo $this->Html->link(__($opinion_letter['basename']),
            array('controller' => 'attachments',  'action' => 'download', $opinion_letter['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$opinion_letter['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('OpinionLetter.'.$jKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('OpinionLetter.'.$jKey.'.group', array('type'=>'hidden', 'value'=>'opinion_letter'));
        echo $this->Form->input('OpinionLetter.'.$jKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('OpinionLetter.'.$jKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('OpinionLetter.'.$jKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="OpinionLetterHelp'.$jKey.'" class="help-inline">    Upload! </span>'
        ));
    }
    echo "</div>";
   }
 }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_practice_license', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_practice_license]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Copy of current Practice Licenses for the Investigators and study Pharmacist <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_practice_license">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_practice_license') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_practice_license'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_practice_license-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_approval_letter', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),  'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantApprovalLetter_" name="data[Application][applicant_approval_letter]">
                                            <label class="checkbox pull-left">',
                            'after' => 'Copy of approval letter(s) from collaborating institutions or other regulatory authorities, if applicable</label>'.$add_checklist,));
?>
<div id="ApprovalLetter" class="checkcontrols" title="approval_letter">
<?php
 if(isset($this->request->data['ApprovalLetter'])){
   foreach ($this->request->data['ApprovalLetter'] as $kKey => $approval_letter) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.id');
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.basename', array('type'=>'hidden'));
    if (!empty($approval_letter['id']) && !empty($approval_letter['basename'])) {
        echo $this->Html->link(__($approval_letter['basename']),
            array('controller' => 'attachments',  'action' => 'download', $approval_letter['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$approval_letter['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.group', array('type'=>'hidden', 'value'=>'approval_letter'));
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('ApprovalLetter.'.$kKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ApprovalLetterHelp'.$kKey.'" class="help-inline">   Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php
$num++;
echo $this->Form->input('applicant_participating_countries', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantParticipatingCountries_" name="data[Application][applicant_participating_countries]">
                                            <label class="checkbox pull-left">',
                            'after' => 'Where the trial is part of an international study, sufficient information regarding the other participating countries and the scope of the study in these countries. </label>'.$add_checklist,));
?>
<div id="ParticipatingStudy" class="checkcontrols" title="participating_study">
<?php
if(isset($this->request->data['ParticipatingStudy'])){
   foreach ($this->request->data['ParticipatingStudy'] as $mKey => $participating_study) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.id');
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.basename', array('type'=>'hidden'));
    if (!empty($participating_study['id']) && !empty($participating_study['basename'])) {
        echo $this->Html->link(__($participating_study['basename']),
            array('controller' => 'attachments',  'action' => 'download', $participating_study['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$participating_study['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.group', array('type'=>'hidden', 'value'=>'participating_study'));
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('ParticipatingStudy.'.$mKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="ParticipatingStudyHelp'.$mKey.'" class="help-inline">   Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php
	$num++;
  echo $this->Form->input('applicant_addendum', array(
            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantAddendum_" name="data[Application][applicant_addendum]">
                                <label class="checkbox pull-left">',
            'after' => 'For multicentre/multi-site studies, a site specific addendum for each of the proposed sites including among other things the sites’ capacity to carry out the study i.e personnel, equipment, laboratory etc </label>'.$add_checklist,));
?>
<div id="Addendum" class="checkcontrols" title="addendum">
<?php
 if(isset($this->request->data['Addendum'])){
   foreach ($this->request->data['Addendum'] as $nKey => $addendum) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('Addendum.'.$nKey.'.id');
        echo $this->Form->input('Addendum.'.$nKey.'.basename', array('type'=>'hidden'));
    if (!empty($addendum['id']) && !empty($addendum['basename'])) {
        echo $this->Html->link(__($addendum['basename']),
            array('controller' => 'attachments',  'action' => 'download', $addendum['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$addendum['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Addendum.'.$nKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Addendum.'.$nKey.'.group', array('type'=>'hidden', 'value'=>'addendum'));
        echo $this->Form->input('Addendum.'.$nKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Addendum.'.$nKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Addendum.'.$nKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="AddendumHelp'.$nKey.'" class="help-inline"> Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php /* ?>
<?php
$num++;
echo $this->Form->input('applicant_registration_ctr', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_registration_ctr]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Registration at the clinical trial registry at www.ctr.pharmacyboardkenya.org <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_registration_ctr">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_registration_ctr') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_registration_ctr'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_registration_ctr-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php */ ?>

<?php
$num++;
echo $this->Form->input('applicant_statement', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantStatement_" name="data[Application][applicant_statement]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'A signed statement by the applicant indicating that all information contained in, or referenced by, the application is complete and accurate and is not false or misleading.
                                        <span class="sterix">*</span></label>'.$add_checklist,));

?>
<div id="Statement" class="checkcontrols" title="statement">
<?php
 if(isset($this->request->data['Statement'])){
   foreach ($this->request->data['Statement'] as $lKey => $statement) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('Statement.'.$lKey.'.id');
        echo $this->Form->input('Statement.'.$lKey.'.basename', array('type'=>'hidden'));
    if (!empty($statement['id']) && !empty($statement['basename'])) {
        echo $this->Html->link(__($statement['basename']),
            array('controller' => 'attachments',  'action' => 'download', $statement['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$statement['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Statement.'.$lKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Statement.'.$lKey.'.group', array('type'=>'hidden', 'value'=>'statement'));
        echo $this->Form->input('Statement.'.$lKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Statement.'.$lKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Statement.'.$lKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="StatementHelp'.$lKey.'" class="help-inline">    Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php
	$num++;
    echo $this->Form->input('applicant_fees', array(
            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'), 'class' => false, 'hiddenField' => false,
            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantFees_" name="data[Application][applicant_fees]">
                            <label class="checkbox required pull-left">',
            'after' => 'Payment of fees <span class="sterix">*</span></label>'.$add_checklist,));
?>
<div id="Fee" class="checkcontrols" title="fee">
<?php
 if(isset($this->request->data['Fee'])){
   foreach ($this->request->data['Fee'] as $oKey => $fee) {
    echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
        echo $this->Form->input('Fee.'.$oKey.'.id');
        echo $this->Form->input('Fee.'.$oKey.'.basename', array('type'=>'hidden'));
    if (!empty($fee['id']) && !empty($fee['basename'])) {
        echo $this->Html->link(__($fee['basename']),
            array('controller' => 'attachments',  'action' => 'download', $fee['id']),
            array('class' => 'btn btn-info')
            );

        echo '<button value="'.$fee['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
    } else {
        echo $this->Form->input('Fee.'.$oKey.'.model', array('type'=>'hidden', 'value'=>'Application'));
        echo $this->Form->input('Fee.'.$oKey.'.group', array('type'=>'hidden', 'value'=>'fee'));
        echo $this->Form->input('Fee.'.$oKey.'.dirname', array('type'=>'hidden'));
        echo $this->Form->input('Fee.'.$oKey.'.checksum', array('type'=>'hidden'));
        echo $this->Form->input('Fee.'.$oKey.'.file', array(
            'type' => 'file', 'label' => false, 'div' => false,
            'error' => array('attributes' => array( 'class' => 'error help-block')),
            'between' => false,
            'after'=>'<span id="FeeHelp'.$oKey.'" class="help-inline">  Upload! </span>'
        ));
    }
    echo "</div>";
   }
}
?>
</div></div>
<?php /* ?>
<?php
$num++;
echo $this->Form->input('applicant_hard_copies', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_hard_copies]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Four bound hard copies of all the above documents <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_hard_copies">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_hard_copies') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_hard_copies'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_hard_copies-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
<?php */ ?>
<?php
$num++;
echo $this->Form->input('applicant_signed_checklist', array(
                            'label' => array('class' => 'control-checklabel', 'text' => $num.'.'),
                            'error' => array('attributes' => array( 'class' => 'checkcontrols help-block')),
                            'class' => false, 'hiddenField' => false,
                            'between' => '<div class="checkcontrols"><input type="hidden" value="0" id="ApplicationApplicantProtocol_" name="data[Application][applicant_signed_checklist]">
                                            <label class="checkbox required pull-left">',
                            'after' => 'Signed checklist <span class="sterix">*</span> </label>'.$add_checklist,));
?>
<div id="Checklist" class="checkcontrols" title="applicant_signed_checklist">
<?php
 if(isset($this->request->data['Checklist'])){
    if ($protocol['group'] == 'applicant_signed_checklist') {
        foreach ($this->request->data['Checklist'] as $bKey => $protocol) {
            echo '<div style="margin-top: 5px; margin-bottom: 5px;">';
            echo $this->Form->input('Checklist.'.$bKey.'.id');
            echo $this->Form->input('Checklist.'.$bKey.'.basename', array('type'=>'hidden'));
            if (!empty($protocol['id']) && !empty($protocol['basename'])) {
                echo $this->Html->link(__($protocol['basename']),
                    array('controller' => 'attachments',   'action' => 'download', $protocol['id']),
                    array('class' => 'btn btn-info')
                    );

                echo '<button value="'.$protocol['id'].'" type="button" class="btn btn-mini btn-danger delete_file_link">
                        &nbsp;<i class="icon-trash"></i>&nbsp;</button>';
            } else {
                echo $this->Form->input('Checklist.'.$bKey.'.model', array('type'=>'hidden', 'value'=>'Checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.group', array('type'=>'hidden', 'value'=>'applicant_signed_checklist'));
                echo $this->Form->input('Checklist.'.$bKey.'.dirname', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.checksum', array('type'=>'hidden'));
                echo $this->Form->input('Checklist.'.$bKey.'.file', array(
                    'type' => 'file', 'label' => false, 'div' => false,
                    'error' => array('attributes' => array( 'class' => 'error help-block')),
                    'between' => false,
                    'after'=>'<span id="applicant_signed_checklist-Help'.$bKey.'" class="help-inline"> Upload! </span>'
            ));
            }
            echo "</div>";
       }
    }   
  }
?>
</div></div>
