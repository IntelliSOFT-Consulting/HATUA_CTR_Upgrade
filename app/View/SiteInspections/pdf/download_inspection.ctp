<?php
  echo $this->Html->css('bootstrap', null,array('fullBase' => true));
  echo $this->Html->css('ctr-fix', null,array('fullBase' => true));
  echo $this->element('/application/inspection_summary');
  echo $this->element('/application/inspection_edit_form');
?>