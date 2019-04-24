<?php
 	$this->Html->script('multi/previous_dates', array('inline' => false));
	echo $this->Form->input('PreviousDate.0.id');
		echo $this->Form->input('PreviousDate.0.date_of_previous_protocol', array(
			'div' => array('class' => 'control-group', 'id' => 'previousdate0'),	'type' => 'text', 'class' => 'datepickers',
			'label' => array('class' => 'control-label', 'text' => 'Date(s) ECCT approval of previous protocol(s)'),
			'after'=>'<span class="help-inline"> format (dd-mm-yyyy)
						<button type="button" class="btn btn-mini btn-primary" id="addPreviousDates" >&nbsp;<i class="icon-plus"></i>&nbsp;</button> Add More Dates
						</span>
					</div>',
		));
?>
<div id="previousDates">
<?php
	if (!empty($this->request->data['PreviousDate'])) {
		for ($i = 1; $i <= count($this->request->data['PreviousDate'])-1; $i++) {
			echo $this->Form->input('PreviousDate.'.$i.'.id');
			echo $this->Form->input('PreviousDate.'.$i.'.date_of_previous_protocol', array(
				'div' => array('class' => 'control-group'),	'type' => 'text', 'class' => 'datepickers',
				'label' => array('class' => 'control-label', 'text' => ''),
				'after'=>'<span class="help-inline"> format (dd-mm-yyyy)
							<button type="button" id="removeDate'.$i.'"
							class="btn btn-mini btn-danger removePreviousDate"
							title="click to remove date">&nbsp;<i class="icon-trash"></i>&nbsp;</button> Remove Date
							</span>
						</div>',
			));
		}
	}
?>
</div>
