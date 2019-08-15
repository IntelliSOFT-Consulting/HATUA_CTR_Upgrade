<?php
 	$this->Html->script('multi/study_routes', array('inline' => false));
 	$study_routes = $this->requestAction('/study_routes/routeslist');
	echo $this->Form->input('StudyRoute.0.id');
		echo $this->Form->input('StudyRoute.0.study_route', array(
			'type' => 'select', 'div' => array('class' => 'control-group', 'id' => 'StudyRoute0'), 'class' => 'input-xlarge', 'options' => $study_routes,
			'label' => array('class' => 'control-label required', 'text' => 'Route(s) of Administration <span class="sterix">*</span>'),
			'escape' => false,
			'after'=>'<span class="help-inline"> 
						<button type="button" class="btn btn-mini btn-primary" id="addStudyRoutes" >&nbsp;<i class="icon-plus"></i>&nbsp;</button> Add More Routes
						</span>
					</div>',
		));
?>
<div id="StudyRoutes">
<?php
	if (!empty($this->request->data['StudyRoute'])) {
		for ($i = 1; $i <= count($this->request->data['StudyRoute'])-1; $i++) {
			echo $this->Form->input('StudyRoute.'.$i.'.id');

			echo $this->Form->input('StudyRoute.'.$i.'.study_route', array(
				'type' => 'select', 'div' => array('class' => 'control-group', 'id' => 'StudyRoute0'), 'class' => 'input-xlarge', 'options' => $study_routes,
				'label' => array('class' => 'control-label', 'text' => ''),
				'after'=>'<span class="help-inline"> 
							<button type="button" id="removeRoute'.$i.'"
							class="btn btn-mini btn-danger removeStudyRoute"
							title="click to remove route">&nbsp;<i class="icon-trash"></i>&nbsp;</button> 
							</span>
						</div>',
			));
		}
	}
?>
</div>
