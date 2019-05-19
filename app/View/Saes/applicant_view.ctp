<?php
    $this->assign('SAE', 'active');        
    echo $this->Session->flash();
?>
<?php 
    echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                  array('controller' => 'saes', 'ext' => 'pdf', 'action' => 'view', $sae['Sae']['id']),
                  array('escape' => false, 'class' => 'btn btn-primary'));
	echo $this->element('application/sae_view'); 
?>