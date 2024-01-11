<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Budgets Controller
 *
 * @property Budget $Budget
 */
class BudgetsController extends AppController {
	public $paginate = array();
    public $presetVars = true; // using the model configuration
    public $components = array('Search.Prg');
/**
 * index method
 *
 * @return void
 */
	// public function index() {
	// 	$this->Budget->recursive = 0;
	// 	$this->set('budgets', $this->paginate());
	// }
	public function index() {
        // $this->Budget->recursive = 0;
        // $this->set('budgets', $this->paginate());

        $this->Prg->commonProcess();
        $page_options = array('25' => '25', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

        $criteria = $this->Budget->parseCriteria($this->passedArgs);
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Budget.created' => 'desc');
        $this->paginate['contain'] = array('Application');
        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
          $this->csv_export($this->Budget->find('all', 
                  array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->paginate['contain'])
              ));
        }
        //end pdf export

        $this->set('page_options', $page_options);
        $this->set('budgets', Sanitize::clean($this->paginate(), array('encode' => false)));
    }

    public function manager_index() {
        $this->index();
    }
    public function inspector_index() {
        $this->index();
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	// public function view($id = null) {
	// 	$this->Budget->id = $id;
	// 	if (!$this->Budget->exists()) {
	// 		throw new NotFoundException(__('Invalid budget'));
	// 	}
	// 	$this->set('budget', $this->Budget->read(null, $id));
	// }
	public function view($id = null) {
        $this->Budget->id = $id;
        if (!$this->Budget->exists()) {
            throw new NotFoundException(__('Invalid budget'));
        }
        $budget = $this->Budget->read(null, $id);
        $this->set('budget', $this->Budget->find('first', array(
            'contain' => array('Application'),
            'conditions' => array('Budget.id' => $id)
            )
        ));
        if (strpos($this->request->url, 'pdf') !== false) {
            $this->pdfConfig = array('filename' => 'DEV_' . $id,  'orientation' => 'portrait');
        }
    }
    public function manager_view($id = null) {
      $this->view($id);
    }
    public function inspector_view($id = null) {
      $this->view($id);
    }
/**
 * add method
 *
 * @return void
 */
	public function applicant_add() {
		if ($this->request->is('post')) {
			$this->Budget->create();
			if ($this->Budget->save($this->request->data)) {
				$this->Session->setFlash(__('The budget has been saved'), 'alerts/flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.'), 'alerts/flash_error');
			}
		}
		$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Budget->id = $id;
		if (!$this->Budget->exists()) {
			throw new NotFoundException(__('Invalid budget'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Budget->save($this->request->data)) {
				$this->Session->setFlash(__('The budget has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Budget->read(null, $id);
		}
		$applications = $this->Budget->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Budget->id = $id;
		if (!$this->Budget->exists()) {
			throw new NotFoundException(__('Invalid budget'));
		}
		if ($this->Budget->delete()) {
			$this->Session->setFlash(__('Budget deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Budget was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
