<?php
    $this->assign('MEETINGS', 'active');        
    echo $this->Session->flash();
?>
<?php echo $this->element('pockets/meetingDates_view'); ?>