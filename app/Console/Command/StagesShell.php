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
            'conditions' => array('Application.submitted' => 1),
            'contain' => array('Review', 'ApplicationStage')
        ));

        foreach ($applications as $application) {
            if ($application) {
            
                //**********************  Create new Screening,ScreeningSubmission,Assign,Review,ReviewSubmission,Final,AnnualApproval stages if not exists
                $stages = $application['ApplicationStage'];
                $scr = $ssb = $asn = $rev = $rsb = $fin = $ann = null;

                //Screening
                if(!Hash::check($stages, '{n}[stage=Screening].id')) {
                    $scr = array('ApplicationStage' => array(
                       'application_id' => $application['Application']['id'], 
                       'stage' => 'Screening', 
                       'status' => 'Current', 
                       'comment' => 'Derived', 
                       'start_date' => date('Y-m-d', strtotime($application['Application']['date_submitted'])), 
                    ));
                }

                //ScreeningSubmission and Assign
                if(Hash::check($application['Review'], '{n}.id')) {
                    //close screening
                    $scr['ApplicationStage']['status'] = 'Complete';
                    $scr['ApplicationStage']['comment'] = 'Derived close';
                    $scr['ApplicationStage']['end_date'] = min(Hash::extract($application['Review'], '{n}.created'));

                    //create ScreeningSubmission
                    $ssb = array('ApplicationStage' => array(
                       'application_id' => $application['Application']['id'], 
                       'stage' => 'ScreeningSubmission', 
                       'status' => 'Complete', 
                       'comment' => 'Derived', 
                       'start_date' => min(Hash::extract($application['Review'], '{n}.created')), 
                       'end_date' => min(Hash::extract($application['Review'], '{n}.created')), 
                    ));

                    //Assign
                    $asn = array('ApplicationStage' => array(
                       'application_id' => $application['Application']['id'], 
                       'stage' => 'Assign', 
                       'status' => 'Current', 
                       'comment' => 'Derived', 
                       'start_date' => min(Hash::extract($application['Review'], '{n}.created')), 
                    ));

                    //if exists ppb_comment or reviewer_comment create review stage and end Assign stage
                    if(Hash::check($application['Review'], '{n}[type=ppb_comment].id') or Hash::check($application['Review'], '{n}[type=reviewer_comment].id')) {
                        $var = Hash::extract($application['Review'], '{n}[type=ppb_comment].created');
                        if (!empty($var)) {
                            //end Assign
                            $asn['ApplicationStage']['status'] = 'Complete';
                            $asn['ApplicationStage']['comment'] = 'Derived close';
                            $asn['ApplicationStage']['end_date'] = min($var);

                            //create Review
                            $rev = array('ApplicationStage' => array(
                               'application_id' => $application['Application']['id'], 
                               'stage' => 'Review', 
                               'status' => 'Current', 
                               'comment' => 'Derived', 
                               'start_date' => min($var), 
                            ));
                        } 

                        $var2 = Hash::extract($application['Review'], '{n}[type=reviewer_comment].created');
                        if(!empty($var2)) {
                            //end Review stage
                            if(!empty($rev)) {
                                $rev['ApplicationStage']['status'] = 'Complete';
                                $rev['ApplicationStage']['comment'] = 'Derived close';
                                $rev['ApplicationStage']['end_date'] = max($var2);
                            }

                            //create and close ReviewSubmission
                            $rsb = array('ApplicationStage' => array(
                               'application_id' => $application['Application']['id'], 
                               'stage' => 'ReviewSubmission', 
                               'status' => 'Complete', 
                               'comment' => 'Derived', 
                               'start_date' => max($var2), 
                               'end_date' => max($var2), 
                            ));
                        }

                        //Create final decision
                        $fin = array('ApplicationStage' => array(
                           'application_id' => $application['Application']['id'], 
                           'stage' => 'FinalDecision', 
                           'status' => 'Current', 
                           'comment' => 'Derived', 
                           'start_date' => ((!empty($var2)) ? max($var2) : min($var)), 
                        ));
                        
                    }

                    //if approved > 0, create final
                    if ($application['Application']['approved'] > 0) {
                        if (!empty($fin)) {
                            $fin['ApplicationStage']['status'] = 'Complete';
                            $fin['ApplicationStage']['comment'] = 'Derived complete';
                            $fin['ApplicationStage']['end_date'] = date('Y-m-d', strtotime($application['Application']['approval_date']));

                            //Create AnnualApproval stage if approved
                            if ($application['Application']['approved'] == 2) {
                                $ann = array('ApplicationStage' => array(
                                   'application_id' => $application['Application']['id'], 
                                   'stage' => 'AnnualApproval', 
                                   'status' => 'Complete', 
                                   'comment' => 'Derived', 
                                   'start_date' => date('Y-m-d', strtotime($application['Application']['approval_date'])), 
                                   'end_date' => date('Y-m-d', strtotime($application['Application']['approval_date'])), 
                                ));
                            }
                            
                        }
                    }
                }
                //Completion

                $sarray = array($scr , $ssb , $asn , $rev , $rsb , $fin , $ann);
                $this->ApplicationStage->saveMany(array_filter($sarray));        
                $this->out('Created stages for .'.$application['Application']['id']);
            } 
        }
        
    }
}
