<?php
App::uses('Shell', 'Console');

/**
 * ScreeningBackfillShell
 *
 * Repairs Screening stages left as Current after a screening query was raised.
 * CommentsController::add_screening_query() used to call the external SMP QR
 * API before moving the stages forward; when that call threw, the comment was
 * saved but Screening never closed and ScreeningSubmission ("Response to
 * Queries") never opened, so the timeline kept counting screening days.
 *
 * For each stuck stage this closes Screening on the date of the first query
 * by someone other than the applicant, and opens ScreeningSubmission from that
 * date if the application has none.
 *
 * Dry run by default:
 *   Console/cake screening_backfill
 *   Console/cake screening_backfill --apply
 */
class ScreeningBackfillShell extends AppShell {
    public $uses = array('Application', 'ApplicationStage', 'Comment');

    public function getOptionParser() {
        $parser = parent::getOptionParser();
        $parser->description('Close Screening stages stuck as Current after a screening query was raised.');
        $parser->addOption('apply', array(
            'boolean' => true,
            'help' => 'Write the changes. Without it the shell only reports what it would do.'
        ));
        return $parser;
    }

    public function main() {
        $apply = !empty($this->params['apply']);
        $this->out($apply ? '<warning>Applying changes</warning>' : 'Dry run (pass --apply to write)');

        $stages = $this->ApplicationStage->find('all', array(
            'contain' => array('Application'),
            'conditions' => array(
                'ApplicationStage.stage' => 'Screening',
                'ApplicationStage.status' => 'Current',
                'ApplicationStage.end_date' => null,
            )
        ));

        $fixed = 0;
        foreach ($stages as $stage) {
            $s = $stage['ApplicationStage'];
            $applicant = $stage['Application']['user_id'];

            $first = $this->Comment->find('first', array(
                'contain' => array(),
                'fields' => array('Comment.id', 'Comment.created', 'Comment.sender'),
                'conditions' => array(
                    'Comment.model' => 'ApplicationStage',
                    'Comment.category' => 'external',
                    'Comment.foreign_key' => $s['id'],
                    'Comment.deleted' => null,
                    'OR' => array('Comment.user_id IS NULL', 'Comment.user_id !=' => $applicant),
                ),
                'order' => array('Comment.created' => 'ASC')
            ));
            if (empty($first)) {
                continue;
            }

            $queryDate = date('Y-m-d', strtotime($first['Comment']['created']));
            $ssb = $this->ApplicationStage->find('first', array(
                'contain' => array(),
                'conditions' => array('ApplicationStage.application_id' => $s['application_id'], 'ApplicationStage.stage' => 'ScreeningSubmission')
            ));

            $this->out(sprintf(
                '%s (app %d): close Screening #%d %s -> %s (first query by %s)%s',
                $stage['Application']['protocol_no'], $s['application_id'], $s['id'],
                $s['start_date'], $queryDate, $first['Comment']['sender'],
                empty($ssb) ? ', open Response to Queries from ' . $queryDate : ', Response to Queries already exists'
            ));
            $fixed++;

            if (!$apply) {
                continue;
            }

            $this->ApplicationStage->create();
            $this->ApplicationStage->save(array('ApplicationStage' => array(
                'id' => $s['id'],
                'status' => 'Complete',
                'comment' => 'Backfill: first screening query',
                'end_date' => $queryDate,
            )));

            if (empty($ssb)) {
                $this->ApplicationStage->create();
                $this->ApplicationStage->save(array('ApplicationStage' => array(
                    'application_id' => $s['application_id'],
                    'stage' => 'ScreeningSubmission',
                    'status' => 'Current',
                    'comment' => 'Backfill: first screening query',
                    'start_date' => $queryDate,
                )));
            }
        }

        $this->out(sprintf('%d stuck Screening stage(s) %s.', $fixed, $apply ? 'fixed' : 'found'));
    }
}
