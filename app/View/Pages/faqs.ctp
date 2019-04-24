<?php
	// $this->Html->script('jqprint.0.3', array('inline' => false));
	$this->assign('FAQ', 'active');
 ?>
<div class="row-fluid">
  <div class="span12">
	  <div class="page-header">
		 <h3 class="text-success">Frequently Asked Questions (FAQ) <?php  echo $this->element('google-recommend');?></h3>
	  </div>
    <dl>
    	<dt>I have registered but I have not received an activation email?</dt>
    	<dd>The activation email may be in your email spam box. </dd>
    	<dd>Make sure you add the address to the list of trusted emails to ensure you get all your future mails in your inbox. <br></dd><br>
    	<dt>I am not able to upload files?</dt>
    	<dd>This problem has been reported by users on Mac using Safari internet browser. </dd>
    	<dd>Please use an alternative browser like Mozilla Firfefox or Google's Chrome for the moment.</dd>
    </dl>

  </div>
</div>
