<?php
    $this->assign('SAE', 'active');        
    echo $this->Session->flash();
?>
<?php echo $this->element('application/sae_view'); ?>