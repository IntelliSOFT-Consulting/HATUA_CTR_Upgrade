<?php
// TEMPORARY - QR/PDF verification only, delete after use.
App::uses('CakePdf', 'CakePdf.Pdf');
class TmpQrPdfCheckShell extends AppShell {
	public $uses = array('AnnualLetter');
	public function main() {
		$data = $this->AnnualLetter->find('first', array('contain' => array(), 'conditions' => array('AnnualLetter.id' => $this->args[0])));
		$pdf = new CakePdf(Configure::read('CakePdf'));
		$pdf->viewVars(array('AnnualLetter' => $data));
		$pdf->viewPath('AnnualLetters');
		$pdf->template('download', 'default');
		try { $pdf->output(); } catch (Exception $e) { $this->out('engine: ' . $e->getMessage()); }
	}
}
