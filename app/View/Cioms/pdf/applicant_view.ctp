<?php
    $this->assign('CIOM', 'active');        
    echo $this->Session->flash();
?>
<?php echo $this->element('application/ciom_view'); ?>