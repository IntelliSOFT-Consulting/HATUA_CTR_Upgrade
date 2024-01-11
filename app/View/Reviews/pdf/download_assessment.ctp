<?php
  echo $this->Html->css('bootstrap', null,array('fullBase' => true));
  echo $this->Html->css('ctr-fix', null,array('fullBase' => true));
  echo $this->element('/application/rreview_view');
?>