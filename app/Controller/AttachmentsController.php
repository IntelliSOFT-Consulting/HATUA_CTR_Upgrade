<?php
App::uses('AppController', 'Controller');
/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 */
class AttachmentsController extends AppController
{

    public $paginate = array();



    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('applicant_upload','approve');
    }


    public function approve($id=null) {
        $this->loadModel('Pocket');
        $approval_letter = $this->Pocket->find('first', array('conditions' => array('Pocket.name' => 'initial_approval_letter')));

      

	}
    public function applicant_upload()
    {
        if ($this->request->is('post')) {

             
            $data = $this->request->data;

            // debug($data);
            // exit;

            $audit = array(
                'Attachment' => array(
                    'file'=>$data['file']
                )
            );
            $this->loadModel('Attachment');
            if ($this->Attachment->save($audit)) {
                $this->set('response', array(
                    'message' => 'Success',
                    'content' => array(
                        'message' => 'File upload successfull',
                        'payload' => $data
                    )
                ));
                $this->set('_serialize', 'response');
            } else {
                $this->set('response', array(
                    'message' => 'Error',
                    'content' => array(
                        'message' => 'Error uploading File',
                        'payload' => $data
                    )
                ));
                $this->set('_serialize', 'response');
            }
        }
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        $this->set('attachment', $this->Attachment->read(null, $id));
    }

    /*public function download($id = null) {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media'. DS .'transfer'. DS .$attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }*/

    public function download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else if ($this->Session->read('Auth.User.group_id') == '5' && !$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
            $this->Session->setFlash(__('You do not have permission to access this resource
                                            id = ' . $id . ' and user = ' . $this->Auth->user('id')), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else if ($this->Session->read('Auth.User.group_id') == '5' && $this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        } else if ($this->Session->read('Auth.User.group_id') == 1 || $this->Session->read('Auth.User.group_id') == 2 || $this->Session->read('Auth.User.group_id') == 3) {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }

    public function applicant_download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else if (!$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
            $this->Session->setFlash(__('You do not have permission to access this resource
                                            id = ' . $id . ' and user = ' . $this->Auth->user('id')), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }

    public function monitor_download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else if (!$this->Attachment->isOwnedBy($id, $this->Auth->user('sponsor'))) {
            $this->Session->setFlash(__('You do not have permission to access this resource
                                            id = ' . $id . ' and user = ' . $this->Auth->user('sponsor')), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }

    public function reviewer_download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }

    public function manager_download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }

    public function inspector_download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else {
            $attachment = $this->Attachment->read(null, $id);
            $params = array(
                'id'        => $attachment['Attachment']['basename'],
                'download'  => true,
                'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
            );
            $this->set($params);
        }
    }

    public function admin_download($id = null)
    {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'flash_error');
            $this->redirect($this->referer());
        } else {
            try {
                $attachment = $this->Attachment->read(null, $id);
                $params = array(
                    'id'        => $attachment['Attachment']['basename'],
                    'download'  => true,
                    'path'      => 'media' . DS . 'transfer' . DS . $attachment['Attachment']['dirname'] . DS
                );
                $this->set($params);
            } catch (Exception $e) {
                $this->Session->setFlash(__('The requested file does not exist!.'), 'flash_error');
                $this->redirect($this->referer());
            }
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
    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid Attachment'));
        }
        // if(!$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
        if (!$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
            $this->set('message', 'You do not have permission to access this resource id = ' . $id . ' and user = ' . $this->Auth->user('id'));
            $this->set('_serialize', 'message');
        } else {
            if ($this->Attachment->delete()) {
                $this->set('message', 'Attachment deleted');
                $this->set('_serialize', 'message');
            } else {
                $this->set('message', 'Attachment was not deleted');
                $this->set('_serialize', 'message');
            }
        }
    }
}
