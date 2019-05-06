<?php
App::uses('AppController', 'Controller');
/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 */
class AttachmentsController extends AppController {

    public $paginate = array();

/**
 * view method
 *
 * @param string $id
 * @return void
 */
    public function view($id = null) {
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

    public function applicant_download($id = null) {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'alerts/flash_error');
            $this->redirect($this->referer());
        } else if (!$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
            $this->Session->setFlash(__('You do not have permission to access this resource
                                            id = '.$id.' and user = '.$this->Auth->user('id')), 'alerts/flash_error');
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
    }

    public function reviewer_download($id = null) {
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
    }

    public function manager_download($id = null) {
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
    }

    public function inspector_download($id = null) {
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
    }

    public function admin_download($id = null) {
        $this->viewClass = 'Media';
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            $this->Session->setFlash(__('The requested file does not exist!.'), 'flash_error');
            $this->redirect($this->referer());
        } else {
            try{
                $attachment = $this->Attachment->read(null, $id);
                $params = array(
                    'id'        => $attachment['Attachment']['basename'],
                    'download'  => true,
                    'path'      => 'media'. DS .'transfer'. DS .$attachment['Attachment']['dirname'] . DS
                );
                $this->set($params);
            } catch(Exception $e) {
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
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid Attachment'));
        }
        // if(!$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
        if(!$this->Attachment->isOwnedBy($id, $this->Auth->user('id'))) {
            $this->set('message', 'You do not have permission to access this resource id = '.$id.' and user = '.$this->Auth->user('id'));
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
