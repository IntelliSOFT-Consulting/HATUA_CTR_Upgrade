<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 * @property Sadr $Sadr
 * @property Pqmp $Pqmp
 */
class Attachment extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    var $name = 'Attachment';
	var $actsAs = array('Containable', 'Media.Transfer', 'Media.Coupler', 'Media.Meta');

	public $belongsTo = array(
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'foreign_key',
			'conditions' => array('Attachment.model' => 'Application', 'Attachment.group' => 'attachment'),
			'fields' => '',
			'order' => ''
		)
	);

	var $validate = array(
		'file' => array(
			// 'resource'   => array('rule' => 'checkResource'),
			'resource'   => array(
				'rule' => 'checkResource',
				'allowEmpty' => false,
				'message' => 'Please attach a file!'
			),
			'access'     => array('rule' => 'checkAccess'),
			// 'location'   => array('rule' => array('checkLocation', array(
				// MEDIA_TRANSFER, '/tmp/'
			// ))),
			'permission' => array('rule' => array('checkPermission', '*')),
			'size'       => array('rule' => array('checkSize', '5M')),
			'pixels'     => array('rule' => array('checkPixels', '1600x1600')),
			// 'extension'  => array('rule' => array('checkExtension', false, array(
				// 'jpg', 'jpeg', 'png', 'tif', 'tiff', 'gif', 'pdf', 'tmp'
			// ))),
			// 'mimeType'   => array('rule' => array('checkMimeType', false, array(
			// 	'image/jpeg', 'image/png', 'image/tiff', 'image/gif', 'application/pdf'	)))
		),
		'alternative' => array(
			'rule'       => 'checkRepresent',
			'on'         => 'create',
			'required'   => false,
			'allowEmpty' => true,
		));

	// var $validate = array(
		// 'file' => array(
			// 'resource'   => array(
				// 'rule' => 'checkResource',
				// 'allowEmpty' => false,
				// 'message' => 'Please upload a file!'
			// ),
			// 'access'     => array('rule' => 'checkAccess'),
			// 'permission' => array('rule' => array('checkPermission', '*')),
			// 'size'       => array('rule' => array('checkSize', '5M')),
			// 'pixels'     => array(
				// 'rule' => array('checkPixels', '640x480'),
				// 'message' => 'The photo you have uploaded is too large. Resize the photo to within 640x480 pixels. Refer to the help section below on how to resize.'
			// )
		// )
	// );

/**
 * Supply a fancy Path field
 *
 * @var array
 * @access public
 */
	var $virtualFields = array(
		'path' => "CONCAT_WS('/', dirname, basename)"
	);


	// UTILITY METHODS
	public function isOwnedBy($attachment, $user) {
		// $application = $this->field('foreign_key', array('id' => $attachment));
		$ndata = $this->find('first',  array('conditions' => array('Attachment.id' => $attachment), 'Contain' => array()));
		if($ndata['Attachment']['model'] == 'Application') {
			// return $this->Application->field('id', array('id' => $application, 'user_id' => $user)) === $application;
			return $this->Application->field('user_id',	array('id' => $ndata['Attachment']['foreign_key'])) === $user;
		} elseif ($ndata['Attachment']['model'] == 'Amendment') {
			$application_id = $this->Application->Amendment->field('application_id', array('id' => $ndata['Attachment']['foreign_key']));
			return $this->Application->field('user_id', array('id' => $application_id)) === $user;
		}
	}
}
