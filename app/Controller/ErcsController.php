<?php
App::uses('AppController', 'Controller');
/**
 * Ercs Controller
 *
 * @property Erc $Erc
 */
class ErcsController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('*');
        $this->Auth->allow('checklist');
    }

    public function checklist() {
        $formdata = $this->Erc->find('list', array(
            'fields' => array('Erc.name', 'Erc.name'),
            'recursive' => 0
        ));
        if ($this->request->is('requested')) {
            return $formdata;
        }
    }

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Erc->recursive = 0;
		$this->set('ercs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Erc->id = $id;
		if (!$this->Erc->exists()) {
			throw new NotFoundException(__('Invalid erc'));
		}
		$this->set('erc', $this->Erc->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Erc->create();
			if ($this->Erc->save($this->request->data)) {
				$this->Session->setFlash(__('The erc has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The erc could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Erc->id = $id;
		if (!$this->Erc->exists()) {
			throw new NotFoundException(__('Invalid erc'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Erc->save($this->request->data)) {
				$this->Session->setFlash(__('The erc has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The erc could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Erc->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Erc->id = $id;
		if (!$this->Erc->exists()) {
			throw new NotFoundException(__('Invalid erc'));
		}
		if ($this->Erc->delete()) {
			$this->Session->setFlash(__('Erc deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Erc was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
