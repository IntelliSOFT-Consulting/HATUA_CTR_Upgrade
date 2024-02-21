<?php
App::uses('AppController', 'Controller');
/**
 * AmendmentLetters Controller
 *
 * @property AmendmentLetter $AmendmentLetter
 */

class AmendmentLettersController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function beforeFilter()
    {
        parent::beforeFilter();
        // $this->Auth->allow();
        $this->Auth->allow('verify','download');
    }

    public function download($id=null){
      
        if (strpos($this->request->url, 'pdf') !== false) {

            $this->pdfConfig = array(
                'filename' => 'ApprovalLetter_' . $id,
                'orientation' => 'portrait',
            );
        } 

        $data = $this->AmendmentLetter->find('first',array(
                'contain' => array(),
                'conditions' => array('AmendmentLetter.status' => $id)
            )
        ); 
        $this->set('AmendmentLetter', $data);
        $this->render('download');

    }

	public function verify($id = null)
    {
       $id =base64_decode($id);
        $this->AmendmentLetter->id = $id;
        if (!$this->AmendmentLetter->exists()) {
            throw new NotFoundException(__('Invalid amendment approval letter'));
        }

        $data = $this->AmendmentLetter->read(null, $id);
        $this->pdfConfig = array(
            'filename' => 'ApprovalLetter_' . $id,
            'orientation' => 'portrait',
        );
        $this->set('AmendmentLetter', $data);

        $this->render('pdf/download');
    }

}
