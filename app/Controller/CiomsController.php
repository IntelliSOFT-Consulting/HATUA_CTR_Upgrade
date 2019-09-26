<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('Xml', 'Utility');
App::uses('Sanitize', 'Utility');
/**
 * Cioms Controller
 *
 * @property Ciom $Ciom
 */
class CiomsController extends AppController {

    public $paginate = array();
    public $components = array('Search.Prg');
    public $presetVars = true; // using the model configuration
/**
 * index method
 *
 * @return void
 */
	public function applicant_index() {
		$this->Prg->commonProcess();
        $page_options = array('25' => '25', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

        $criteria = $this->Ciom->parseCriteria($this->passedArgs);
        $criteria['Ciom.user_id'] = $this->Auth->User('id');
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Ciom.created' => 'desc');
        $this->paginate['contain'] = array('Application');

        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
          $this->csv_export($this->Ciom->find('all', 
                  array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->paginate['contain'])
              ));
        }
        //end pdf export
        $this->set('page_options', $page_options);
        $this->set('cioms', Sanitize::clean($this->paginate(), array('encode' => false)));
	}
	public function index() {
		$this->Prg->commonProcess();
        $page_options = array('25' => '25', '20' => '20');
        if (!empty($this->passedArgs['start_date']) || !empty($this->passedArgs['end_date'])) $this->passedArgs['range'] = true;
        if (isset($this->passedArgs['pages']) && !empty($this->passedArgs['pages'])) $this->paginate['limit'] = $this->passedArgs['pages'];
            else $this->paginate['limit'] = reset($page_options);

        $criteria = $this->Ciom->parseCriteria($this->passedArgs);
        $this->paginate['conditions'] = $criteria;
        $this->paginate['order'] = array('Ciom.created' => 'desc');
        $this->paginate['contain'] = array('Application');

        //in case of csv export
        if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'csv') {
          $this->csv_export($this->Ciom->find('all', 
                  array('conditions' => $this->paginate['conditions'], 'order' => $this->paginate['order'], 'contain' => $this->paginate['contain'])
              ));
        }
        //end pdf export
        $this->set('page_options', $page_options);
        $this->set('cioms', Sanitize::clean($this->paginate(), array('encode' => false)));
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
	public function applicant_view($id = null) {
		$this->Ciom->id = $id;
		if (!$this->Ciom->exists()) {
			throw new NotFoundException(__('Invalid ciom'));
		}
		$ciom = $this->Ciom->read(null, $id);
		$e2b = Xml::toArray(Xml::build($ciom['Ciom']['e2b_content']));
		$this->set(compact('ciom', 'e2b'));
	}
	public function aview($id = null) {
        $this->Ciom->id = $id;
		if (!$this->Ciom->exists()) {
			throw new NotFoundException(__('Invalid ciom'));
		}
		$ciom = $this->Ciom->read(null, $id);
		$e2b = Xml::toArray(Xml::build($ciom['Ciom']['e2b_content']));
		$this->set(compact('ciom', 'e2b'));
    }
    public function manager_view($id = null) {
      $this->aview($id);
    }
    public function inspector_view($id = null) {
      $this->aview($id);
    }
/**
 * add method
 *
 * @return void
 */
	public function applicant_add($id = null) {
		if ($this->request->is('post')) {
			$this->Ciom->create();
			
			// debug($this->request->data);

			$file = new File($this->request->data['Ciom']['file']['tmp_name']);
            $this->request->data['Ciom']['e2b_content'] = $file->read();

			if ($this->Ciom->save($this->request->data)) {
				$this->Session->setFlash(__('The ciom has been saved'));
				$this->redirect(array('action' => 'view', $this->Ciom->id));
			} else {
				$this->Session->setFlash(__('The ciom could not be saved. Please, try again.'));
			}
		}
		// $applications = $this->Ciom->Application->find('list');
		// $users = $this->Ciom->User->find('list');
		$application_id = $id;
		$this->set(compact('application_id'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Ciom->id = $id;
		if (!$this->Ciom->exists()) {
			throw new NotFoundException(__('Invalid ciom'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ciom->save($this->request->data)) {
				$this->Session->setFlash(__('The ciom has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ciom could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Ciom->read(null, $id);
		}
		$applications = $this->Ciom->Application->find('list');
		$users = $this->Ciom->User->find('list');
		$this->set(compact('applications', 'users'));
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
		$this->Ciom->id = $id;
		if (!$this->Ciom->exists()) {
			throw new NotFoundException(__('Invalid ciom'));
		}
		if ($this->Ciom->delete()) {
			$this->Session->setFlash(__('Ciom deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ciom was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
