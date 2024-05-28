<?php
    $this->assign('CIOM', 'active');        
    echo $this->Session->flash();
?>
<?php 
    echo $this->Html->link(__('<i class="icon-download-alt"></i> Download PDF'),
                  array('controller' => 'cioms', 'ext' => 'pdf', 'action' => 'view', $ciom['Ciom']['id']),
                  array('escape' => false, 'class' => 'btn btn-primary'));
    echo $this->element('application/ciom_view'); 
?>


