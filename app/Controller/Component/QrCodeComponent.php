<?php

App::uses('Component', 'Controller');
App::uses('QrEncoder', 'Lib/QrCode');

/**
 * Generates verification QR codes locally (replaces the smp.imeja.co.ke/api/qr/generate call).
 *
 * The stored `qrcode` value keeps the format SMP returned and the views expect:
 * a base64-encoded 150px inline <svg> that is base64_decode()d and echoed.
 */
class QrCodeComponent extends Component {

/**
 * Returns the base64-encoded inline SVG for a QR code pointing at $url.
 *
 * @param string $url Verification URL to encode.
 * @param array $options Passed to QrEncoder::svg() (ecc, scale, size, border, dark, light).
 * @return string
 */
	public function generate($url, $options = array()) {
		// Fixed 150px like SMP; a 2-module margin keeps modules large enough to scan, the page supplies the rest.
		return base64_encode(QrEncoder::svg($url, $options + array('size' => 150, 'border' => 2)));
	}

/**
 * Generates a QR code for $url and saves it on the record's `qrcode` field.
 *
 * @param Model $model Model holding the letter (AnnualLetter, AmendmentLetter, Comment...).
 * @param int $id Record id.
 * @param string $url Verification URL to encode.
 * @return bool Whether the record was saved.
 * @throws NotFoundException When the record does not exist.
 */
	public function attach(Model $model, $id, $url) {
		$model->id = $id;
		if (!$model->exists()) {
			throw new NotFoundException(__('Invalid %s', Inflector::humanize(Inflector::underscore($model->alias))));
		}
		return (bool)$model->saveField('qrcode', $this->generate($url), array('callbacks' => false));
	}
}
