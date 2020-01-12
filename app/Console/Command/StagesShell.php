<?php
App::uses('Router', 'Routing');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');

class StagesShell extends AppShell {
    public $uses = array('User', 'Application', 'ApplicationStage');
    
    public function main() {
        $this->out('Hello world.');
        $stages = [];
        $applications = $this->Application->find('all', array(
            //'conditions' => array('Application.submitted' => 1),
            'fields' => array('Application.id','Application.user_id', 'Application.created', 'Application.protocol_no', 'Application.study_drug', 'Application.submitted', 'Application.short_title'),
            'contain' => array('Review', 'ApplicationStage')
        ));

        foreach ($applications as $application) {
            # code...
            if ($application) {
            
                //creation

                if (!in_array('Creation', Hash::extract($application, 'ApplicationStage.{n}.stage'))) {
                    $stages[20]['stage'] = 'Creation';
                    $stages[20]['start_date'] = $application['Application']['created'];
                } else {
                    for ($i=0; $i < count($application['ApplicationStage']); $i++) { 
                        if($application['ApplicationStage'][$i]['stage'] == 'Creation' && empty($application['ApplicationStage'][$i]['end_date'])) {
                            $application['ApplicationStage'][$i]['end_date'] = $application['Application']['date_submitted'];
                        }
                    }
                }

                //Applicant submit
                if (!in_array('Submit', Hash::extract($application, 'ApplicationStage.{n}.stage'))) {
                    $stages[30]['stage'] = 'Submit';
                    $stages[30]['start_date'] = $application['Application']['date_submitted'];
                    #creation end date
                    $stages[20]['end_date'] = $stages[30]['start_date'];
                } else {
                    for ($i=0; $i < count($application['ApplicationStage']); $i++) { 
                        if($application['ApplicationStage'][$i]['stage'] == 'Review' && empty($application['ApplicationStage'][$i]['end_date'])) {
                            $application['ApplicationStage'][$i]['end_date'] = min(Hash::extract($application, 'Review.{n}.created'));
                        }
                    }
                }

                //Review
                // debug(Hash::extract($application, 'Review.{n}[id=2].id'));
                if (!in_array('Review', Hash::extract($application, 'ApplicationStage.{n}.stage'))) {
                    $stages[40]['stage'] = 'Review';
                    $rsd = ;
                    $stages[40]['start_date'] = min(Hash::extract($application, 'Review.{n}.created'));
                    #crstageeation end date
                    $stages[30]['end_date'] = $stages[40]['start_date'];
                } else {

                }

                //Feedback
                if (!in_array('Feedback', Hash::extract($application, 'ApplicationStage.{n}.stage'))) {
                    $stages[40]['stage'] = 'Feedback';
                    $rsd = ;
                    $stages[40]['start_date'] = min(Hash::extract($application, 'Review.{n}[type=ppb_comment].created'));
                    #crstageeation end date
                    $stages[30]['end_date'] = $stages[40]['start_date'];
                } else {
                    
                }

                $stages['Feedback'] = ['label' => 'Feedback', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
                if (in_array('ppb_comment', Hash::extract($application, 'Review.{n}.type'))) {
                    // debug(Hash::extract($application, 'Review.{n}[type=ppb_comment].id'));
                    $fsd = new DateTime(min(Hash::extract($application, 'Review.{n}[type=ppb_comment].created')));
                    $stages['Review']['end_date'] = $fsd->format('d-M-Y');
                    $stages['Review']['days'] = $fsd->diff($rsd)->format('%a');

                    $stages['Feedback']['start_date'] = $fsd->format('d-M-Y');
                    $stages['Feedback']['color'] = 'success';
                } 

                //Approval
                $stages['Approval'] = ['label' => 'Approval', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
                if ($application['Application']['approved']) {
                    $asd = new DateTime($application['Application']['approval_date']);
                    $stages['Feedback']['end_date'] = $asd->format('d-M-Y');
                    if(!isset($fsd)) $fsd = new DateTime($application['Application']['approval_date']);
                    $stages['Feedback']['days'] = $asd->diff($fsd)->format('%a');

                    $stages['Approval']['start_date'] = $asd->format('d-M-Y');
                    $stages['Approval']['color'] = ($application['Application']['approved'] == '2') ? 'success' : 'warning';
                } 
                //Completion
            } else {            
                $stages['Creation'] = ['application_name' => '<< protocol no. >>', 'label' => 'Start', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
                $stages['Submit'] = ['label' => 'Submit', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
                $stages['Review'] = ['label' => 'Review', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
                $stages['Feedback'] = ['label' => 'Feedback', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
                $stages['Approval'] = ['label' => 'Approval', 'start_date' => '', 'end_date' => '', 'days' => '', 'color' => 'default', 'state' => 'default'];
            }
        }
        $this->set('stages', $stages);
        $this->set('_serialize', 'stages');
        if ($this->request->is('requested')) {
            return $stages;
        }        
    }
}
